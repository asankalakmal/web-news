<div class="wrap">    
    <nav class="navbar navbar-default">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
            </div>
 
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li><?php echo anchor('news/home/', 'News Portal'); ?></li>
                    <?php if($this->session->userdata('email')) { ?>
                        <li><?php echo anchor('news/home/', 'Welcome '.$this->session->userdata('first_name')); ?></li>
                    <?php }  ?>
                </ul>
                
                <ul class="nav navbar-nav navbar-right">

                    <?php if(!$this->session->userdata('email')) { ?>
                        <li><?php echo anchor('auth/login', 'Login In', 'title="Log In"'); ?></li>
                        <li><?php echo anchor('auth/signup', 'Sign Up', 'title="Sign Up"'); ?></li>
                   <?php } else { ?>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Account<span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><?php echo anchor('news/manage', 'Manage News', 'title="manage news"'); ?></li>
                                <li><?php echo anchor('news/create', 'Create News', 'title="create news"'); ?></li>
                                <li><?php echo anchor('auth/logout', 'Logout', 'title="logout"'); ?></li>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">


<?php  if($this->session->flashdata('success')) { ?>

    <div class="alert alert-success" role="alert">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      <span class="sr-only">Success:</span>
      <?php echo $this->session->flashdata('success');?>
    </div>

<?php } ?>

<?php  if($this->session->flashdata('error')) { ?>

    <div class="alert alert-danger" role="alert">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      <span class="sr-only">Error:</span>
      <?php echo $this->session->flashdata('error');?>
    </div>

<?php } ?>

<?php  if($this->session->flashdata('warning')) { ?>

    <div class="alert alert-warning" role="alert">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      <span class="sr-only">Error:</span>
      <?php echo $this->session->flashdata('warning');?>
    </div>

<?php } ?>

<?php  if($this->session->flashdata('info')) { ?>

    <div class="alert alert-info" role="alert">
      <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
      <span class="sr-only">Error:</span>
      <?php echo $this->session->flashdata('info');?>
    </div>

<?php } ?>