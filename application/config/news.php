<?php
defined('BASEPATH') OR exit('No direct script access allowed');


// News Image Related configurations
$config['image_upload_path']     = './news_images/';
$config['image_allowed_types']   = 'gif|jpg|jpeg|png';
$config['image_max_size']        = 500; // 500kb
$config['image_max_heignt']= 1024; // 1024px
$config['image_max_width'] = 1024; // 1024px

// News list size
$config['news_display_limit'] = 10; 
$config['news_rss_feed_limit'] = 10;