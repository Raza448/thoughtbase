<?$this->layout->block('currentPageCss')?>
<style>
html, body {
background:none;
}
</style>
<?$this->layout->block()?>

<?$this->layout->block('breadcrumbs')?>

<?$this->layout->block()?>

<div class="form-box" id="login-box">
            <div class="header">Sign In</div>
            <?php $attribute = array('autocomplete' => 'off', 'action' => 'admin/login', 'method' => 'post' ,'onSubmit' => 'return form_fi();'); ?>
			<?php echo form_open('',$attribute); ?>
                <div class="body bg-gray">
				<div style="background:#f2dede;">
					<?php 
					if(isset($error))
					{
						echo $error;
					} 
					?>
				</div>
                    <div class="form-group">
					<div style="background:#f2dede;"><?php echo form_error('username'); ?></div>
                        <input type="text" autocorrect="off" autocapitalize="none" name="username" class="form-control" placeholder="User ID"/>
                    </div>
                    <div class="form-group">
						<div style="background:#f2dede;"><?php echo form_error('password'); ?></div>
                        <input type="password" name="password" class="form-control" placeholder="Password"/>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="remember_me"/> Remember me
                    </div>
                </div>
                <div class="footer">
                    <input type="submit" name="signin" value="Sign In" class="btn bg-olive btn-block">

                    <p><a href="#">I forgot my password</a></p>

                    <!--<a href="register.html" class="text-center">Register a new membership</a>-->
                </div>
            </form>

            <div class="margin text-center">
                <span>Sign in using social networks</span>
                <br/>
                <button class="btn bg-light-blue btn-circle"><i class="fa fa-facebook"></i></button>
                <button class="btn bg-aqua btn-circle"><i class="fa fa-twitter"></i></button>
                <button class="btn bg-red btn-circle"><i class="fa fa-google-plus"></i></button>

            </div>
        </div>
		
<?$this->layout->block('currentPageJS')?>
<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js" type="text/javascript"></script>


<?$this->layout->block()?>