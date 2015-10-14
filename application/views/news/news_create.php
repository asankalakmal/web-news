<?php require_once(APPPATH.'views/partials/head.php') ?>
<?php require_once(APPPATH.'views/partials/header.php') ?>

	
<div id="newscreate" class="mainbox col-md-8 col-md-offset-2 col-sm-10 col-sm-offset-1 ">
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="panel-title">Create news</div>
            </div>  
            <div class="panel-body" >
                <?php echo form_open_multipart('news/create', 'class="form-horizontal" id="signupform" role="form"'); ?>
                    
                    <div id="signupalert" class="alert alert-danger <?php echo isset($error) &&  trim($error) != '' ? '': 'hide'?>">
                        <p>Errors:</p>

                       <?php echo $error; ?>
                    </div>
                        
                    
                      
                    <div class="form-group">
                        <label for="email" class="col-md-3 control-label">News Title</label>
                        <div class="col-md-9">
                            <?php echo form_input($news_title);?>
                        </div>
                    </div>
                        
                    <div class="form-group">
                        <label for="news_image" class="col-md-3 control-label">Image</label>
                        <div class="col-md-9">
                            <div class="fileinput fileinput-new input-group" data-provides="fileinput">
                              <div class="form-control" data-trigger="fileinput"><i class="glyphicon glyphicon-file fileinput-exists"></i> <span class="fileinput-filename"></span></div>
                                <span class="input-group-addon btn btn-default btn-file"><span class="fileinput-new">Select file</span><span class="fileinput-exists">Change</span><input type="file" name="news_image"></span>
                                <a href="#" class="input-group-addon btn btn-default fileinput-exists" data-dismiss="fileinput">Remove</a>
                            </div>
                            <div class="form-tip">Max width-height: 1024 * 1024</div>
                            <div class="form-tip">Max size: 500kb</div>
                            <div class="form-tip">Allowed types: 'gif | jpg | jpeg | png'</div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="content" class="col-md-3 control-label">News Content</label>
                        <div class="col-md-9">
                            <?php echo form_textarea($news_content);?>
                        </div>
                    </div>

                    <div class="form-group">
                        <!-- Button -->                                        
                        <div class="col-md-offset-3 col-md-9">
                            <input type="submit" class="btn btn-info" name="signup" value="Create" />
                        </div>
                    </div>
                                                    
                <?php echo form_close(); ?>
             </div>
        </div>

        </div> 
    
<?php require_once(APPPATH.'views/partials/footer.php') ?>