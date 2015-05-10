<footer class="footer-container clearfix">
            <div class="wrapper">
                <div class="inner-footer-container text-center">
                    <div class="footer-logos-container clearfix">
						<?php
							$image1 = vt_resize(get_field('footer_image_1', 'option'), '', 331, 128);
							$image2 = vt_resize(get_field('footer_image_2', 'option'), '', 331, 128);						
						?> 
						<?php if(!empty($image1)):?>
						<a href="<?php echo get_field('footer_image_1_url', 'option');?>" target="_blank"><img src="<?php echo $image1['url'];?>" alt="Logos"></a>
						<?php endif;?>
						<?php if(!empty($image2)):?>
						<a href="<?php echo get_field('footer_image_2_url', 'option');?>" target="_blank"><img src="<?php echo $image2['url'];?>" alt="Logos"></a>
						<?php endif;?>                       
                    </div>
                    <div class="footer-navigation clearfix">
                        <nav class="menu">
							<?php
								$args_footer = array(
									'theme_location'  => 'footer',
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
								wp_nav_menu( $args_footer );
							?>                            
                        </nav>
                    </div>
					<?php 
						if(is_active_sidebar('sidebar-3')){
							dynamic_sidebar('sidebar-3');
						}
					?>
                    <!--<p class="copyright-text">&copy; Dynamic Mind Works 2014. All rights reserved. Created by Digital Graphic Design</p>
                    <div class="footer-call-social clearfix">
                        <div class="call-area sprit-icon">1300 305 173</div>
                        <div class="social-area">
                            <ul>
                                <li class="sprit-icon icon-facebook"><a href=""></a></li>
                                <li class="sprit-icon icon-twitter"><a href=""></a></li>
                                <li class="sprit-icon icon-linkdin"><a href=""></a></li>
                                <li class="sprit-icon icon-you"><a href=""></a></li>
                            </ul>
                        </div>
                    </div>-->
					
                </div>
            </div>
        </footer>

        <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo get_template_directory_uri();?>/js/vendor/jquery-1.11.0.js"><\/script>')</script>
        
        <script src="http://cdnjs.cloudflare.com/ajax/libs/flexslider/2.2.2/jquery.flexslider.js"></script>
        <script src="<?php echo get_template_directory_uri();?>/js/vendor/jquery.bxslider.js"></script>        
        <script src="<?php echo get_template_directory_uri();?>/js/vendor/jquery.fitvids.js"></script>
        <script src="<?php echo get_template_directory_uri();?>/js/vendor/jquery.meanmenu.js"></script>
        <script src="<?php echo get_template_directory_uri();?>/js/jquery.validationEngine-en.js"></script>
        <script src="<?php echo get_template_directory_uri();?>/js/jquery.validationEngine.js"></script>		
        <script src="<?php echo get_template_directory_uri();?>/js/jquery.validate.min.js"></script>		
        <script src="<?php echo get_template_directory_uri();?>/js/main.js"></script>
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
			$(function(){
				$('#booking_form').validationEngine();				
				$('#squeeze_mc_form').validationEngine();				
				var li_count = $('ul#course_events li').length;
				if(li_count <= 1){
					$('div.bx-controls-direction').remove();
				}
			});			
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='http://www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </script>
		<?php wp_footer();?>
    </body>      
</html>