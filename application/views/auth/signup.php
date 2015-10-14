<?php require_once(APPPATH.'views/partials/head.php') ?>
<?php require_once(APPPATH.'views/partials/header.php') ?>

	<div id="signupbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 ">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Sign Up</div>
                <div class="signin-link"><?php echo anchor('auth/login', 'Sign In', 'title="sign In"'); ?></div>
            </div>  
            <div class="panel-body" >
               	<?php echo form_open('auth/signup', 'class="form-horizontal" id="signupform" role="form"'); ?>
                    
                    <div id="signupalert" class="alert alert-danger <?php echo validation_errors() ? '': 'hide'?>">
                        <p>Errors:</p>

                       <?php echo validation_errors('<span>', '</span><br>'); ?>
                    </div>
                        
                    
                      
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">Email</label>
                        <div class="col-md-9">
                            <?php echo form_input($email);?>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label for="firstname" class="col-md-3 control-label">First Name</label>
                        <div class="col-md-9">
                            <?php echo form_input($first_name);?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="lastname" class="col-md-3 control-label">Last Name</label>
                        <div class="col-md-9">
                            <?php echo form_input($last_name);?>
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- Button -->                                        
                        <div class="col-md-offset-3 col-md-9">
                            <input type="submit" class="btn btn-info" name="signup" value="Signup" />
                        </div>
                    </div>
                                                    
                <?php echo form_close(); ?>
             </div>
        </div>

		</div> 
    
<?php require_once(APPPATH.'views/partials/footer.php') ?>