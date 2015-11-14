<?php

/**
 * Do not use or reference this directly from your client-side code.
 * Instead, this should be required via the endpoint.php or endpoint-cors.php
 * file(s).
 */

class UploadHandler {

    public $allowedExtensions = array();
    public $sizeLimit = null;
    public $inputName = 'qqfile';
    public $chunksFolder = 'chunks';

    public $chunksCleanupProbability = 0.001; // Once in 1000 requests on avg
    public $chunksExpireIn = 604800; // One week

    protected $uploadName;

    function __construct(){
        $this->sizeLimit = $this->toBytes(ini_get('upload_max_filesize'));
    }

    /**
     * Get the original filename
     */
    public function getName(){
        if (isset($_REQUEST['qqfilename']))
            return $_REQUEST['qqfilename'];

        if (isset($_FILES[$this->inputName]))
            return $_FILES[$this->inputName]['name'];
    }

    /**
     * Get the name of the uploaded file
     */
    public function getUploadName(){
        return $this->uploadName;
    }

    /**
     * Process the upload.
     * @param string $uploadDirectory Target directory.
     * @param string $name Overwrites the name of the file.
     */
    public function handleUpload($uploadDirectory, $name = null){

        if (is_writable($this->chunksFolder) &&
            1 == mt_rand(1, 1/$this->chunksCleanupProbability)){

            // Run garbage collection
            $this->cleanupChunks();
        }

        // Check that the max upload size specified in class configuration does not
        // exceed size allowed by server config
        if ($this->toBytes(ini_get('post_max_size')) < $this->sizeLimit ||
            $this->toBytes(ini_get('upload_max_filesize')) < $this->sizeLimit){
            $size = max(1, $this->sizeLimit / 1024 / 1024) . 'M';
            return array('error'=>"Server error. Increase post_max_size and upload_max_filesize to ".$size);
        }

        if ($this->isInaccessible($uploadDirectory)){
            return array('error' => "Server error. Uploads directory isn't writable");
        }

        if(!isset($_SERVER['CONTENT_TYPE'])) {
            return array('error' => "No files were uploaded.");
        } else if (strpos(strtolower($_SERVER['CONTENT_TYPE']), 'multipart/') !== 0){
            return array('error' => "Server error. Not a multipart request. Please set forceMultipart to default value (true).");
        }

        // Get size and name
        $file = $_FILES[$this->inputName];
        $size = $file['size'];

        if ($name === null){
            $name = $this->getName();
        }

        // Validate name
        if ($name === null || $name === ''){
            return array('error' => 'File name empty.');
        }

        // Validate file size
        if ($size == 0){
            return array('error' => 'File is empty.');
        }

        if ($size > $this->sizeLimit){
            return array('error' => 'File is too large.');
        }

        // Validate file extension
        $pathinfo = pathinfo($name);
        $ext = isset($pathinfo['extension']) ? $pathinfo['extension'] : '';

        if($this->allowedExtensions && !in_array(strtolower($ext), array_map("strtolower", $this->allowedExtensions))){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'File has an invalid extension, it should be one of '. $these . '.');
        }

        // Save a chunk
        $totalParts = isset($_REQUEST['qqtotalparts']) ? (int)$_REQUEST['qqtotalparts'] : 1;

        $uuid = $_REQUEST['qquuid'];
        if ($totalParts > 1){
        # chunked upload

            $chunksFolder = $this->chunksFolder;
            $partIndex = (int)$_REQUEST['qqpartindex'];

            if (!is_writable($chunksFolder) && !is_executable($uploadDirectory)){
                return array('error' => "Server error. Chunks directory isn't writable or executable.");
            }

            $targetFolder = $this->chunksFolder.DIRECTORY_SEPARATOR.$uuid;

            if (!file_exists($targetFolder)){
                mkdir($targetFolder);
            }

            $target = $targetFolder.'/'.$partIndex;
			
            $success = move_uploaded_file($_FILES[$this->inputName]['tmp_name'], $target);
			

            // Last chunk saved successfully
            if ($success AND ($totalParts-1 == $partIndex)){

                $target = join(DIRECTORY_SEPARATOR, array($uploadDirectory, $uuid, $name));
                //$target = $this->getUniqueTargetPath($uploadDirectory, $name);
                $this->uploadName = $name;

                if (!file_exists($target)){
                    mkdir(dirname($target));
                }
                $target = fopen($target, 'wb');

				mysql_connect('localhost','root','')or die('unable to connect to database');
				mysql_select_db('thoughtbase')or die('database cannot be found');
				$query = "insert into survey_images (image,folder,token) values ('".$name."','".$uuid."','".$_REQUEST['param1']."')";
				mysql_query($query);
				
				
				
				
                for ($i=0; $i<$totalParts; $i++){
                    $chunk = fopen($targetFolder.DIRECTORY_SEPARATOR.$i, "rb");
                    stream_copy_to_stream($chunk, $target);
                    fclose($chunk);
                }

                // Success
                fclose($target);

                for ($i=0; $i<$totalParts; $i++){
                    unlink($targetFolder.DIRECTORY_SEPARATOR.$i);
                }

                rmdir($targetFolder);

                return array("success" => true, "uuid" => $uuid);
            }

            return array("success" => true, "uuid" => $uuid);

        }
        else {
        # non-chunked upload

            $target = join(DIRECTORY_SEPARATOR, array($uploadDirectory, $uuid, $name));
            //$target = $this->getUniqueTargetPath($uploadDirectory, $name);
				
				
				$imageDirectory = join(DIRECTORY_SEPARATOR, array($uploadDirectory, $uuid));
				$imageName = $file['name'];
				
				$image = explode('.', $imageName);
				
			if ($target){
                $this->uploadName = basename($target);

                if (!is_dir(dirname($target))){
                    mkdir(dirname($target));
                }
				
                if (move_uploaded_file($file['tmp_name'], $target)){
					$this->generatethumbnails($imageDirectory,$imageName,$target);
				      //inserting in to database
					  mysql_connect('localhost','root','')or die('unable to connect to database');
				      mysql_select_db('thoughtbase')or die('database cannot be found');
					  $query = "insert into survey_images (image,folder,token) values ('".$image[0]."','".$uuid."','".$_REQUEST['param1']."')";
				      mysql_query($query);
      				  return array('success'=> true, "uuid" => $uuid);
                }
				
            }

            return array('error'=> 'Could not save uploaded file.' .'The upload was cancelled, or server error encountered');
        }
    }
	
	
	public function generatethumbnails($imageDirectory, $imageName, $target) {
		$explode = explode(".", $imageName);
		$filetype = $explode[1];
		
		
		
		if($filetype == 'jpg' || $filetype == 'JPEG'){
			$exif = exif_read_data($imageDirectory."/".$imageName);
			if(!empty($exif['Orientation'])){
				$orientation = $exif['Orientation'];
			}
		}

		if (isset($orientation) && $orientation != 1){
			switch ($orientation) {
				case 3:
				$deg = 180;
				break;
				case 6:
				$deg = 270;
				break;
				case 8:
				$deg = 90;
				break;
			}
		if ($deg) {

				// If png
				if ($filetype == 'jpg' || $filetype == 'JPG')  {
					$srcImg = imagecreatefromjpeg("$imageDirectory/$imageName");
					$srcImg = imagerotate($srcImg, $deg, 0);
				}else
				if ($filetype == 'jpeg' || $filetype == 'JPEG') {
					$srcImg = imagecreatefromjpeg("$imageDirectory/$imageName");
					$srcImg = imagerotate($srcImg, $deg, 0);
				} else
				if ($filetype == 'png' || $filetype == 'PNG') {
					$srcImg = imagecreatefrompng("$imageDirectory/$imageName");
					$srcImg = imagerotate($srcImg, $deg, 0);
				} else
				if ($filetype == 'gif' || $filetype == 'GIF') {
					$srcImg = imagecreatefromgif("$imageDirectory/$imageName");
					$srcImg = imagerotate($srcImg, $deg, 0);
				}
			}
		}else{
		
			if ($filetype == 'jpg' || $filetype == 'JPG') {
				$srcImg = imagecreatefromjpeg("$imageDirectory/$imageName");
			} else
			if ($filetype == 'jpeg' || $filetype == 'JPEG') {
				$srcImg = imagecreatefromjpeg("$imageDirectory/$imageName");
			} else
			if ($filetype == 'png' || $filetype == 'PNG') {
				$srcImg = imagecreatefrompng("$imageDirectory/$imageName");
			} else
			if ($filetype == 'gif' || $filetype == 'GIF') {
				$srcImg = imagecreatefromgif("$imageDirectory/$imageName");
			}
		}
		
		$origWidth = imagesx($srcImg);
		$origHeight = imagesy($srcImg);
		
		if($origWidth > $origHeight){
			$thumbWidth = 150;
			$thumbWidth1 = 600;
			$thumbWidth2 = 800;
			
			$thumbHeight = floor($origHeight * ($thumbWidth / $origWidth));
			$thumbHeight1 = floor($origHeight * ($thumbWidth1 / $origWidth));
			$thumbHeight2 = floor($origHeight * ($thumbWidth2 / $origWidth));
		}else{
			$thumbHeight = 150;
			$thumbHeight1 = 300;
			$thumbHeight2 = 600;
			
			$thumbWidth = floor($origWidth * ($thumbHeight / $origHeight));
			$thumbWidth1 = floor($origWidth * ($thumbHeight1 / $origHeight));
			$thumbWidth2 = floor($origWidth * ($thumbHeight2 / $origHeight));
		}
		
		
		

    /* create a new, "virtual" image */
		$virtual_image = imagecreatetruecolor($thumbWidth, $thumbHeight);
		$virtual_image1 = imagecreatetruecolor($thumbWidth1, $thumbHeight1);
		$virtual_image2 = imagecreatetruecolor($thumbWidth2, $thumbHeight2);

		imageAlphaBlending($virtual_image, false);
		imageSaveAlpha($virtual_image, true);

		/* copy source image at a resized size */
		imagecopyresampled($virtual_image, $srcImg, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $origWidth, $origHeight);
		imagecopyresampled($virtual_image1, $srcImg, 0, 0, 0, 0, $thumbWidth1, $thumbHeight1, $origWidth, $origHeight);
		imagecopyresampled($virtual_image2, $srcImg, 0, 0, 0, 0, $thumbWidth2, $thumbHeight2, $origWidth, $origHeight);

		/* $thumbImg = imagecreatetruecolor($thumbWidth, $thumbHeight);
		$thumbImg1 = imagecreatetruecolor($thumbWidth1, $thumbHeight1);
		$thumbImg2 = imagecreatetruecolor($thumbWidth2, $thumbHeight2); */
		
		/* imagecopyresized($thumbImg, $srcImg, 0, 0, 0, 0, $thumbWidth, $thumbHeight, $origWidth, $origHeight);
		imagecopyresized($thumbImg1, $srcImg, 0, 0, 0, 0, $thumbWidth1, $thumbHeight1, $origWidth, $origHeight);
		imagecopyresized($thumbImg2, $srcImg, 0, 0, 0, 0, $thumbWidth2, $thumbHeight2, $origWidth, $origHeight); */
		
		
		
		if ($filetype == 'jpg' || $filetype == 'JPG') {
			imagejpeg($virtual_image, "$imageDirectory/$explode[0]_thumb.jpg", 100);
			imagejpeg($virtual_image1, "$imageDirectory/$explode[0]_medium.jpg", 100);
			imagejpeg($virtual_image2, "$imageDirectory/$explode[0].jpg", 100);
			
		} else
		if ($filetype == 'jpeg' || $filetype == 'JPEG') {
			imagejpeg($virtual_image, "$imageDirectory/$explode[0]_thumb.jpg", 100);
			imagejpeg($virtual_image1, "$imageDirectory/$explode[0]_medium.jpg", 100);
			imagejpeg($virtual_image2, "$imageDirectory/$explode[0].jpg", 100);
			
		} else
		if ($filetype == 'png' || $filetype == 'PNG') {
			imagejpeg($virtual_image, "$imageDirectory/$explode[0]_thumb.jpg", 100);
			imagejpeg($virtual_image1, "$imageDirectory/$explode[0]_medium.jpg", 100);
			imagejpeg($virtual_image2, "$imageDirectory/$explode[0].jpg", 100);
			unlink($target);
		} else
		if ($filetype == 'gif' || $filetype == 'GIF') {
			imagejpeg($virtual_image, "$imageDirectory/$explode[0]_thumb.jpg", 100);
			imagejpeg($virtual_image1, "$imageDirectory/$explode[0]_medium.jpg", 100);
			imagejpeg($virtual_image2, "$imageDirectory/$explode[0].jpg", 100);
			unlink($target);
		}
		
	}

    /**
     * Process a delete.
     * @param string $uploadDirectory Target directory.
     * @params string $name Overwrites the name of the file.
     *
     */
    public function handleDelete($uploadDirectory, $name=null)
    {
        if ($this->isInaccessible($uploadDirectory)) {
            return array('error' => "Server error. Uploads directory isn't writable" . ((!$this->isWindows()) ? " or executable." : "."));
        }

        $targetFolder = $uploadDirectory;
        $url = parse_url($_SERVER['REQUEST_URI']);
        $uuid = $_POST['qquuid'];

        $target = join(DIRECTORY_SEPARATOR, array($targetFolder, $uuid));
		
		mysql_connect('localhost','root','')or die('unable to connect to database');
		mysql_select_db('thoughtbase')or die('database cannot be found');
		echo $query = "delete from  survey_images where token ='".$_REQUEST['param1']."' and folder ='".$uuid."'";
		mysql_query($query);

        print_r($target);
        if (is_dir($target)){
            $this->removeDir($target);
            return array("success" => true, "uuid" => $uuid);
        } else {
            return array("success" => false,
                "error" => "File not found! Unable to delete.",
                "path" => $uuid
            );
        }

    }

    /**
     * Returns a path to use with this upload. Check that the name does not exist,
     * and appends a suffix otherwise.
     * @param string $uploadDirectory Target directory
     * @param string $filename The name of the file to use.
     */
    protected function getUniqueTargetPath($uploadDirectory, $filename)
    {
        // Allow only one process at the time to get a unique file name, otherwise
        // if multiple people would upload a file with the same name at the same time
        // only the latest would be saved.

        if (function_exists('sem_acquire')){
            $lock = sem_get(ftok(__FILE__, 'u'));
            sem_acquire($lock);
        }

        $pathinfo = pathinfo($filename);
        $base = $pathinfo['filename'];
        $ext = isset($pathinfo['extension']) ? $pathinfo['extension'] : '';
        $ext = $ext == '' ? $ext : '.' . $ext;

        $unique = $base;
        $suffix = 0;

        // Get unique file name for the file, by appending random suffix.

        while (file_exists($uploadDirectory . DIRECTORY_SEPARATOR . $unique . $ext)){
            $suffix += rand(1, 999);
            $unique = $base.'-'.$suffix;
        }

        $result =  $uploadDirectory . DIRECTORY_SEPARATOR . $unique . $ext;

        // Create an empty target file
        if (!touch($result)){
            // Failed
            $result = false;
        }

        if (function_exists('sem_acquire')){
            sem_release($lock);
        }

        return $result;
    }

    /**
     * Deletes all file parts in the chunks folder for files uploaded
     * more than chunksExpireIn seconds ago
     */
    protected function cleanupChunks(){
        foreach (scandir($this->chunksFolder) as $item){
            if ($item == "." || $item == "..")
                continue;

            $path = $this->chunksFolder.DIRECTORY_SEPARATOR.$item;

            if (!is_dir($path))
                continue;

            if (time() - filemtime($path) > $this->chunksExpireIn){
                $this->removeDir($path);
            }
        }
    }

    /**
     * Removes a directory and all files contained inside
     * @param string $dir
     */
    protected function removeDir($dir){
        foreach (scandir($dir) as $item){
            if ($item == "." || $item == "..")
                continue;

            if (is_dir($item)){
                $this->removeDir($item);
            } else {
                unlink(join(DIRECTORY_SEPARATOR, array($dir, $item)));
            }

        }
        rmdir($dir);
    }

    /**
     * Converts a given size with units to bytes.
     * @param string $str
     */
    protected function toBytes($str){
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;
        }
        return $val;
    }

    /**
     * Determines whether a directory can be accessed.
     *
     * is_executable() is not reliable on Windows prior PHP 5.0.0
     *  (http://www.php.net/manual/en/function.is-executable.php)
     * The following tests if the current OS is Windows and if so, merely
     * checks if the folder is writable;
     * otherwise, it checks additionally for executable status (like before).
     *
     * @param string $directory The target directory to test access
     */
    protected function isInaccessible($directory) {
        $isWin = $this->isWindows();
        $folderInaccessible = ($isWin) ? !is_writable($directory) : ( !is_writable($directory) && !is_executable($directory) );
        return $folderInaccessible;
    }
    
    /**
     * Determines is the OS is Windows or not
     * 
     * @return boolean
     */
    
    protected function isWindows() {
    	$isWin = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');
    	return $isWin;
    }
    
}
