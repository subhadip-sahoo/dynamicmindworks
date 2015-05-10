<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->
        <title><?php wp_title('|', 'right', true);?></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel='shortcut icon' type='image/x-icon' href='<?php echo get_template_directory_uri();?>/favicon.ico' />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/normalize.min.css">
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/flexslider.css" media="all" />
        <link href="<?php echo get_template_directory_uri();?>/css/jquery.bxslider.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/meanmenu.css" media="all" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/bootstrap.css" media="all" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/validationEngine.jquery.css" media="all" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/jquery-ui.css" media="all" />
        <link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/main.css">
        <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,200,200italic,300,300italic,400italic,600,600italic,700,700italic,900|Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800' rel='stylesheet' type='text/css'>
        <script src="<?php echo get_template_directory_uri();?>/js/vendor/modernizr-2.6.2-respond-1.1.0.min.js"></script>
		<?php wp_head();?>
		<script src="<?php echo get_template_directory_uri();?>/js/jquery-ui.js"></script>
		<script src="<?php echo get_template_directory_uri();?>/js/bootstrap.min.js"></script>
    </head>
    <body <?php body_class();?>>

        <header class="header-container clearfix">
            <section class="main-header clearfix">
                <section class="wrapper clearfix">
                    <section class="inner-header-container clearfix">
                        <div class="site-logo">
                            <a href="<?php echo home_url();?>"><img src="<?php header_image(); ?>" alt="Logo"></a>
                        </div>
                        <div class="header-right-container pull-right">
							  <!--<div class="call-area sprit-icon">1300 305 173</div>
							  <div class="social-area text-right">
								  <ul>
									  <li class="sprit-icon icon-facebook"><a href=""></a></li>
									  <li class="sprit-icon icon-twitter"><a href=""></a></li>
									  <li class="sprit-icon icon-linkdin"><a href=""></a></li>
									  <li class="sprit-icon icon-you"><a href=""></a></li>
								  </ul>
							  </div>-->
							  <?php 
								if(is_active_sidebar('sidebar-4')){
									dynamic_sidebar('sidebar-4');
								}
							  ?>
							  <div class="header-search">
								  <form action="<?php echo home_url('/');?>" method="GET">
									<input type="text" name="s" class="form-control" id="search">
									<input type="submit" class="btn btn-submit btn-header-submit" value="Search">
								  </form>
							  </div>
						  </div>      
                    </section>
                </section>
            </section>

            <section class="navigation-container clearfix">
                <div class="wrapper">
                    <nav class="menu">
						<?php
							$args = array(
								'theme_location'  => 'primary',
								'menu'            => '',
								'container'       => '',
								'container_class' => '',
								'container_id'    => '',
								'menu_class'      => 'menu',
								'menu_id'         => '',
								'echo'            => true,
								'fallback_cb'     => 'wp_page_menu',
								'before'          => '',
								'after'           => '',
								'link_before'     => '',
								'link_after'      => '',
								'items_wrap'      => '<ul>%3$s</ul>',
								'depth'           => 0,
								'walker'          => ''
							);
							wp_nav_menu( $args );
						?>
                        <!--<ul>
                            <li class="current-menu-item"><a href="">Home</a></li>
                            <li><a href="">NLP Training</a></li>
                            <li><a href="">Training</a></li>
                            <li><a href="">Coaching Programs</a></li>
                            <li><a href="">Testimonials</a></li>
                            <li><a href="">Blog</a></li>
                            <li><a href="">Book Now</a></li>
                            <li><a href="">Contact Us</a></li>
                        </ul>-->
                    </nav>
                </div>
            </section>
        </header>