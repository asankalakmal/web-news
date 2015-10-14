<?php require_once(APPPATH.'views/partials/head.php') ?>
<?php require_once(APPPATH.'views/partials/header.php') ?>


        <div id="signupbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 ">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title">Change Password</div>
                            <div class="signin-link"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
                        </div>  
                        <div class="panel-body" >
                           	<?php echo form_open('auth/changePassword', 'class="form-horizontal" id="signupform" role="form"'); ?>
                                
                                <div id="signupalert" class="alert alert-danger <?php echo validation_errors() ? '': 'hide'?>">
                                    <p>Errors:</p>

                                   <?php echo validation_errors('<span>', '</span><br>'); ?>
                                </div>
                                  
                                <div class="form-group">
                                    <label for="email" class="col-md-3 control-label">Password</label>
                                    <div class="col-md-9">
                                        <?php echo form_input($password);?>
                                    </div>
                                </div>
                                    
                                <div class="form-group">
                                    <label for="firstname" class="col-md-3 control-label">Confirm password</label>
                                    <div class="col-md-9">
                                        <?php echo form_input($password_confirm);?>
                                    </div>
                                </div>
                                <?php echo form_input($code);?>
                                <?php echo form_input($id);?>

                                <div class="form-group">
                                    <!-- Button -->                                        
                                    <div class="col-md-offset-3 col-md-9">
                                        <input type="submit" class="btn btn-info" name="signup" value="Change" />
                                    </div>
                                </div>
                                                                
                            <?php echo form_close(); ?>
                         </div>
                    </div>

         </div> 
    
<?php require_once(APPPATH.'views/partials/footer.php') ?>