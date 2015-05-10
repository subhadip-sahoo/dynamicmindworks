<?php 
	/* Template Name: Home */
	get_header();
?>
	<section class="banner-container clearfix">
            <section class="wrapper">
                <div class="inner-banner-container clearfix">
                    <section class="main-banner-area">
                        <div class="flexslider">
                            <ul class="slides">
								<?php query_posts(array('post_type' => 'sliders', 'posts_per_page' => -1));?>
								<?php if(have_posts()): while(have_posts()): the_post();?>
								<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');?>
                                <li>									
                                    <img src="<?php echo $image[0];?>" alt="Banner Image" width="620" height="526" />
                                    <div class="flex-caption">
                                    	<?php the_content(); ?>
                                    </div>
                                </li>
								<?php endwhile; endif; wp_reset_query();?>							                             
                            </ul>
                        </div>
                    </section>
                    <section class="banner-event-area">
                        <h2><span>Upcoming</span> Events &amp; Training</h2>
                        <div class="event-lists">
						<?php query_posts(array('post_type' => 'events'));
						$dates_array = array();
						if(have_posts()):
								while(have_posts()):
									the_post();
									$upcoming_events_checking = get_field('upcomimg_events');
									//print_r($upcoming_events_checking);
									if($upcoming_events_checking[0] == 1){
										continue;
									}
									$temp_arr = get_field('dates');
									//print_r($temp_arr);
									foreach ($temp_arr as $val) {																			
										if(strtotime($val['start_date']) < strtotime(date('Y-m-d',time()))){
											continue;
										}
										$data = array(
											'post_id' => get_the_ID(),
											'start_date' => $val['start_date'],
											'end_date' => $val['end_date']
										);
										array_push($dates_array, $data);
									}
								endwhile;
								wp_reset_query();
							endif;
							aasort($dates_array, 'start_date');
							//print_r($dates_array);
							$unique_ids = array();
							foreach($dates_array as $dt){								
								if(strtotime($dt['start_date']) >= strtotime(date('Y-m-d',time()))){
									array_push($unique_ids, $dt['post_id']);
								}													
							}					
							$unique_ids = array_unique($unique_ids);
							$count_id = 0;
							//echo '<pre>'; print_r($unique_ids);
							?>
							<?php if(!empty($unique_ids)):?>
                            <ul class="unstyled">
							<?php foreach($unique_ids as $id): ?>
							<?php 
								$count_id++;
								if($count_id == 4){
									break;
								}
								$post = get_post($id);
								$image = vt_resize(get_post_thumbnail_id($id), '', 123, 97);
								//print_r($image);
								//$term_lists = wp_get_post_terms($id, 'course-categories');
								//echo '<pre>'; print_r($term_lists);
							?>
                                <li>
                                    <a href="<?php echo get_permalink($id);?>">
										<?php if(!empty($image['url'])):?>
                                        <figure class="event-image">
											<img src="<?php echo $image['url'];?>" width="123" height="86" alt="Event Image">
										</figure>
										<?php else:?>
										<figure class="event-image">
											<?php $image = vt_resize('', get_template_directory_uri().'/images/dynamicmindworks.png', 123, 86, true);?>
											<img src="<?php echo $image['url'];?>" width="123" height="86" alt="Event Image">
										</figure>
										<?php endif;?>
                                        <article class="event-content">
                                            <h4><?php echo $post->post_title;?></h4>
                                            <p class="location"><strong>Location:</strong> <span class="date-location-a"><?php echo get_field('location', $id, true);?></span></p>
                                            <p class="dates"><strong>Dates:</strong>
											<?php $dates = get_field('dates', $id, true);?>
											<?php aasort($dates, 'start_date');?>
											<?php 
												foreach($dates as $date):
													if(strtotime($date['start_date']) >= strtotime(date('Y-m-d',time()))):
											?>
											<span class="date-location-a"><?php echo date('d F Y', strtotime($date['start_date']));?> - <?php echo  date('d F Y', strtotime($date['end_date']));?></span>
											<?php endif; endforeach;?>
											</p>
                                        </article>
                                    </a>
								</li>
								<?php $image = '';endforeach;?>                                
                            </ul>
							<?php endif;?>
                        </div>
                        <a href="<?php echo site_url();?>/event-calendar" class="btn see-event-btn">See all events</a>
                    </section>
                </div>
            </section>
        </section>

        <section class="main-container clearfix">
            <section class="main wrapper clearfix">
                <section class="inner-main-container clearfix">
                    <article class="hentry">
                        <?php if(have_posts()): while(have_posts()): the_post();?>
						<header class="content-title">
                            <h1><?php echo get_field('welcome_title');?></h1>
                        </header>
                        <div class="content-final">                            
							<?php if(get_the_content() <> ''):?>
							<p><?php echo get_the_excerpt() ? excerpt_to_charlength(400, get_the_excerpt()) : excerpt_to_charlength(400, get_the_content()); ?></p>
							<?php endif; endwhile; endif;?>
                            <p><a href="<?php echo get_permalink(58);?>" class="btn btn-view-more">View More</a></p>
                        </div>
                    </article>
                </section>
            </section> <!-- #main -->
        </section> <!-- #main-container -->

        <section class="main-container video-container clearfix">
            <section class="main wrapper clearfix">
                <section class="inner-main-container inner-video-container clearfix">
                    <div class="video-area">
                        <h2>Video</h2>
                        <div class="main-video-sec">
							<?php query_posts(array('post_type' => 'videos', 'posts_per_page' => -1));?>
							<?php if(have_posts()): $setFlag = false;?>
								<?php while(have_posts()): the_post(); $feature_video = get_field('feature_video'); ?>
									<?php if($feature_video[0] == 'Feature video'): $setFlag = true; ?>
										<iframe src="<?php echo get_field('video_url'); ?>" width="634" height="332"></iframe>
									<?php break;endif;?>
								<?php endwhile; wp_reset_query(); ?>
								<?php if($setFlag == false):?>
									<?php query_posts(array('post_type' => 'videos', 'posts_per_page' => 1));?>
									<?php while(have_posts()): the_post(); ?>
										<iframe src="<?php echo get_field('video_url'); ?>" width="634" height="332"></iframe>
									<?php endwhile; wp_reset_query(); ?>
								<?php endif; ?>
							<?php else:?>
                            <img src="<?php echo get_template_directory_uri();?>/images/video-image.jpg" width="" height="" alt="">
							<?php endif; ?>
                        </div>
                        <a href="<?php echo site_url();?>/videos" class="btn btn-view-more">View More</a>
                    </div>
                    <div class="free-bonus-form-area">
                        <h2><?php echo get_field('sign_up_form_text_1', 'option');?></h2>
                        <div class="inner-bonus-form-area">
                            <header class="title-group text-center">
                                <h2><?php echo get_field('sign_up_form_text_2', 'option');?></h2>
                                <h3><?php echo get_field('sign_up_form_text_3', 'option');?></h3>
                            </header>
                            <div class="inner-bonus-form">
                                <?php echo do_shortcode('[mc4wp_form]') ;?>
                            </div>
                        </div>
						<?php //echo do_shortcode('[mc4wp_form]') ;?>
                    </div>
                </section>
            </section> <!-- #main -->
        </section> <!-- #main-container -->

        <section class="main-container bloginfo-container clearfix">
            <section class="main wrapper clearfix">
                <section class="inner-main-container inner-bloginfo-container text-center clearfix">
                    <?php query_posts(array('post_type' => 'services', 'posts_per_page' => 4));?>
					<?php if(have_posts()): ?>
					<ul class="grid">
						<?php while(have_posts()): the_post();?>						
                         <li class="col-sm-3">
                            <article class="bloginfo-area">
                                <figure class="bloginfo-area-image">
									<?php if(has_post_thumbnail()):?>
									<?php $image = vt_resize(get_post_thumbnail_id(get_the_ID()), '', 176, 176, false);?>           
										  <img src="<?php echo $image['url']; ?>" alt="Blog Information Image" width="176" height="176" >								
									<?php else:?>
									<?php $image = vt_resize('', get_template_directory_uri().'/images/no-image.png', 176, 176, true);?>
										<img src="<?php echo $image['url'];?>" alt="No Image" width="176" height="176"/> 
									<?php endif;?>
                                </figure>
                                <h4><?php the_title();?></h4>
                                <div class="bloginfo-content">
                                   <?php echo get_the_excerpt() ? excerpt_to_charlength(100, get_the_excerpt()) : excerpt_to_charlength(100, get_the_content()); ?>
                                </div>
                                <a href="<?php echo (get_field('custom_link') <> '')? get_field('custom_link'): the_permalink();?>" class="btn btn-read-more">Read More</a>
                            </article>
                         </li>
						 <?php endwhile; wp_reset_query();?>                         
                     </ul> 
					 <?php endif;?>
                </section>
            </section> <!-- #main -->
        </section> <!-- #main-container -->

        <section class="main-container testimonial-blog-container clearfix">
            <section class="main wrapper clearfix">
                <section class="inner-main-container inner-testimonial-blog-container clearfix">
                    <div class="grid">
                        <div class="col-sm-6">
                            <div class="testimonial-blog-container-area">
                                <header class="testimonial-blog-container-title">
                                    <h2>Testimonials</h2>
                                </header>
                                <section class="testimonial-blog-container-content clearfix">
                                    <?php query_posts(array('post_type' =>'testimonials', 'posts_per_page' => 2));?>
									<?php if(have_posts()):?>
									<ul class="unstyled">									
										<?php while(have_posts()): the_post();?>	
                                        <li class="testimonials-list">
											<figure class="testimonial-image">
											<?php if(has_post_thumbnail()):?>
											<?php $image = vt_resize(get_post_thumbnail_id(get_the_ID()), '', 98, 98, false);?>           
												  <img src="<?php echo $image['url'];?>" alt="" width="98" height="98">
											<?php elseif(get_field('video_url_testi') <> ''):?>
													<iframe src="<?php echo get_field('video_url_testi');?>" width="98" height="98" ></iframe> 
											<?php else:?>
											<?php $image = vt_resize('', get_template_directory_uri().'/images/no-image.png', 98, 98, true);?>
												<img src="<?php echo $image['url'];?>" alt="No Image" width="98" height="98"/>
											<?php endif;?>
											</figure>
                                            <blockquote><?php echo get_the_excerpt() ? excerpt_to_charlength(300, get_the_excerpt(), get_the_ID()) : excerpt_to_charlength(300, get_the_content(), get_the_ID()); ?></blockquote>
                                            <cite>
                                                <?php the_title();?>
												<?php if(get_field('designation') <> ''):?>
												<i><?php echo get_field('designation');?></i>
												<?php endif;?>                                                
                                            </cite>
                                        </li>
										<?php endwhile; wp_reset_query();?>
									 </ul>
										<?php else:?>										
										<div class="single-content-section">
											<p><?php _e( 'No testimonials found', 'twentyfourteen' ); ?></p>	
										</div>
									<?php endif;?>                                                                           
                                    <a href="<?php echo site_url();?>/testimonials" class="btn btn-read-more">Read All</a>
                                </section>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="testimonial-blog-container-area lastest-blog-area">
                                <header class="testimonial-blog-container-title">
                                    <h2>Blog</h2>
                                </header>
                                <section class="testimonial-blog-container-content clearfix">
                                    <?php query_posts(array('post_type' =>'post', 'posts_per_page' => 2));?>
									<?php if(have_posts()):?>
									<ul class="unstyled">
									<?php while(have_posts()): the_post();?>
                                        <li class="recentblog-list">
                                            <article>
                                                <h5><?php the_title();?></h5>
                                                <p><?php echo get_the_excerpt() ? excerpt_to_charlength(200, get_the_excerpt(), get_the_ID()) : excerpt_to_charlength(200, get_the_content(), get_the_ID()); ?></p>
                                            </article>
                                            <p class="blog-author">
                                                - <?php the_author();?>
                                            </p>
                                        </li>
										<?php endwhile; wp_reset_query();?>
										</ul>
										<?php else:?>										
											<div class="single-content-section">
												<p><?php _e( 'No posts found', 'twentyfourteen' ); ?></p>	
											</div>											
										<?php endif;?>                                                                           
                                    <a href="<?php echo site_url();?>/blog" class="btn btn-read-more">Read All</a>
                                </section>
                            </div>
                        </div>
                    </div>
                </section>
            </section> <!-- #main -->
        </section> <!-- #main-container -->
<?php get_footer();?>