<?php require_once(APPPATH.'views/partials/head.php') ?>
<?php require_once(APPPATH.'views/partials/header.php') ?>

	
<?php //var_dump($news_list); ?>


<div class="jumbotron">
    <div class="row">
    <div class="col-md-10">
      <h2 class="welcomeText heading"><span class="glyphicon glyphicon-book"></span>&nbsp;<?php echo $news->title; ?></h2>
    </div>
    <div class="col-md-2">
        <?php echo anchor('news/createpdf/'.$news->id, 'Export to PDF', 'class="btn btn-primary btn-sm"'); ?>
    </div>
  </div>
</div>

<div class="col-md-12">
    <div class="row">
        <div align="justify" class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading">
              Reported by: <?php echo $news->first_name.' '.$news->last_name; ?> | <?php echo date('M d Y', $news->created_on); ?>
              <?php if ($loggin && $user_id == $news->user_id) {?>
                <?php echo anchor('news/remove/'.$news->id, 'Remove this news', 'class="right btn btn-danger btn-xs" data-toggle="confirmation" data-singleton="true"'); ?>
              <?php } ?>
              <?php echo anchor('news/home/', 'Back to home'); ?>
            </div>
            <div class="panel-body">
              <p><img class="content-image" src="<?php echo base_url('news_images/'.$news->image) ?>" height="400" width="500"><?php echo nl2br($news->content); ?></p>
              
            </div>
          </div>
        </div>
    </div>
</div>
    
<?php require_once(APPPATH.'views/partials/footer.php') ?>