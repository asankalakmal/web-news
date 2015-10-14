<?php require_once(APPPATH.'views/partials/head.php') ?>
<?php require_once(APPPATH.'views/partials/header.php') ?>

<div class="jumbotron">
    <div class="row">
    <div class="col-md-12">
      <h1 class="welcomeText heading"><span class="glyphicon glyphicon-globe"></span>&nbsp;Manage My Publications</h1>
      <p>Globle news forum</p>
      <p><?php echo anchor('news/create/', 'Create a News', 'class="btn btn-primary"'); ?></p>
    </div>
  </div>
</div>

<div class="col-md-12">

        <?php foreach($news_list as $news) { ?>
            <div class="article-list-cotent col-md-12">
                <div class="col-md-3">
                    <img src="<?php echo base_url('news_images/'.$news->image) ?>" height="200" width="240">
                </div>
                <div class="col-md-9">
                    <article class="clearfix">
                        <div class="post-date">
                            <?php echo date('M d Y', $news->created_on); ?> | <?php echo anchor('news/details/'.$news->id, $news->first_name.' '.$news->last_name); ?><span><?php echo anchor('news/remove/'.$news->id, 'Remove this news', 'class="btn btn-danger btn-xs" data-toggle="confirmation" data-singleton="true"'); ?></span>
                        </div>      
                        <h2><?php echo anchor('news/details/'.$news->id, $news->title); ?></h2>
                        <p><?php echo nl2br(str_truncate_words($news->content, 500)); ?> <?php echo anchor('news/details/'.$news->id, 'Read more'); ?>
                        </p>
                    </article>
                </div>
             </div>
        <?php }?>

</div>
    
<?php require_once(APPPATH.'views/partials/footer.php') ?>