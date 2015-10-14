<?php require_once(APPPATH.'views/partials/head.php') ?>
<?php require_once(APPPATH.'views/partials/header.php') ?>

	<div id="loginbox" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2 ">                    
        <div class="panel panel-info" >
            <div class="panel-heading">
                <div class="panel-title">Sign In</div>
            </div>     

            <div class="panel-body" >

                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                    
                
                <?php echo form_open('auth/login', 'class="form-horizontal" id="loginform" role="form"'); ?>

                <div id="signupalert" class="alert alert-danger <?php echo validation_errors() ? '': 'hide'?>">
                    <p>Errors:</p>
                    <?php echo validation_errors('<span>', '</span><br>'); ?>
                 </div>
                            
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                    <?php echo form_input($email);?>                                      
                </div>
                    
                <div class="input-group">
                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                    <?php echo form_input($password);?> 
                </div>
                        

                    
                <div class="input-group">
                    <div class="checkbox">
                        <label>
                            <input id="login-remember" type="checkbox" name="remember" value="1"> Remember me
                        </label>
                    </div>
                </div>


                    <div class="form-group login-btn">
                        <!-- Button -->

                        <div class="col-sm-12 controls">
                          <input type="submit" class="btn btn-success" name="login" value="Login" />
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="col-md-12 control">
                            <div class="account-create" >
                                Don't have an account! 
                            <?php echo anchor('auth/signup', 'Sign Up Here', 'title="Sign Up"'); ?>

                            </div>
                        </div>
                    </div>    
                <?php echo form_close(); ?>



            </div>                     
        </div>  
    </div>	
        
    
<?php require_once(APPPATH.'views/partials/footer.php') ?>