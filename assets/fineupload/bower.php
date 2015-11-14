<html>
<head></head>
<body>

<!-- jQuery
====================================================================== -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>

<!-- Fine Uploader JS
====================================================================== -->
<script src="fine.js"></script>
<script>
  $(document).ready(function() {
    $('#thumbnail-fine-uploader').fineUploader({
      template: "qq-simple-thumbnails-template",
      thumbnails: {
          placeholders: {
            waitingPath: "assets/waiting-generic.png",
            notAvailablePath: "assets/not_available-generic.png"
          }
      },
      request: {
        endpoint: 'server/endpoint.php',
		 params: {
          param1: "foo",
          param2: "bar"
        }
      },
	  deleteFile: {
        enabled: true, // defaults to false
        endpoint: 'server/delete.php',
		method:'POST'
    },
      validation: {
          allowedExtensions: ['jpeg', 'jpg', 'gif', 'png']
      }
    });
  });
</script>

<!-- Fine Uploader CSS
====================================================================== -->
<link href="fine.css" rel="stylesheet">

<!-- Fine Uploader DOM Element
====================================================================== -->
<div id="thumbnail-fine-uploader"></div>

<!-- Fine Uploader template
====================================================================== -->
<script type="text/template" id="qq-simple-thumbnails-template">
  <div class="qq-uploader-selector qq-uploader">
    <div class="qq-upload-drop-area-selector qq-upload-drop-area" qq-hide-dropzone>
      <span>Drop files here to upload</span>
    </div>
    <div class="qq-upload-button-selector qq-upload-button">
      <div>Upload a file</div>
    </div>
    <span class="qq-drop-processing-selector qq-drop-processing">
      <span>Processing dropped files...</span>
      <span class="qq-drop-processing-spinner-selector qq-drop-processing-spinner"></span>
    </span>
    <ul class="qq-upload-list-selector qq-upload-list">
      <li>
        <div class="qq-progress-bar-container-selector">
          <div class="qq-progress-bar-selector qq-progress-bar"></div>
        </div>
        <span class="qq-upload-spinner-selector qq-upload-spinner"></span>
        <img class="qq-thumbnail-selector" qq-max-size="100" qq-server-scale>
        <span class="qq-edit-filename-icon-selector qq-edit-filename-icon"></span>
        <span class="qq-upload-file-selector qq-upload-file"></span>
        <input class="qq-edit-filename-selector qq-edit-filename" tabindex="0" type="text">
        <span class="qq-upload-size-selector qq-upload-size"></span>
        <a class="qq-upload-cancel-selector qq-upload-cancel" href="#">Cancel</a>
        <a class="qq-upload-retry-selector qq-upload-retry" href="#">Retry</a>
        <a class="qq-upload-delete-selector qq-upload-delete" href="#">Delete</a>
        <span class="qq-upload-status-text-selector qq-upload-status-text"></span>
      </li>
    </ul>
  </div>
</script>

</body>
</html>