<?php get_header();?>
<section class="main-container clearfix">
	<section class="main wrapper clearfix">
		<section class="inner-main-container clearfix">
        	<div class="left-container">
			<div class="blog-lists">
				<?php if(have_posts()):?>
                    <?php while(have_posts()): the_post();?>					                       
                        	<header class="content-title">
                                <h1><?php the_title();?></h1>
                            </header>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                                
                                <div class="single-content-area clearfix">
                                    <figure class="single-image-area">								
										<?php if(has_post_thumbnail()):?>
										<?php $image = vt_resize(get_post_thumbnail_id(get_the_ID()), '', 250, 150, false);?>
											<img src="<?php echo $image['url'];?>" alt="Images">
										<?php elseif(get_field('video_url_testi') <> ''):?>
											<iframe src="<?php echo get_field('video_url_testi');?>" width="250" height="150" ></iframe> 
										<?php else:?>
											<?php $image = vt_resize('', get_template_directory_uri().'/images/no-image.png', 250, 150, true);?>
											<img src="<?php echo $image['url'];?>" alt="No Image" />
										<?php endif;?>																			
									 </figure>
                                    <div class="single-content-section single-testimonials-content">
                                        <?php the_content();?>
                                        
                                        <div class="testimonials-other-details">
                                            <h5><i class="glyphicon glyphicon-user"></i> - <?php the_title();?></h5>
                                            <?php if(get_field('designation') <> ''):?>
                                                <p class="designation-content"><i class="glyphicon glyphicon-hand-right"></i> - <?php echo get_field('designation');?></p>
                                            <?php endif;?>
                                            <?php if(get_field('place') <> ''):?>
                                                <p class="place-content"><i class="glyphicon glyphicon-road"></i> - <?php echo get_field('place');?></p>
                                            <?php endif;?>
                                            <?php if(get_field('website') <> ''):?>
                                                <p class="website-content"><i class="glyphicon glyphicon-send"></i> - <a href="<?php echo get_field('website');?>" class="link"><?php echo get_field('website');?></a>
                                            </p>
                                            <?php endif;?>	
                                        </div>	
                                    </div>
                                </div>
                                <a href="<?php echo site_url();?>/testimonials" class="pull-right testimonials-view-link">View all</a>
                            </article>                   
                    <?php endwhile;?>
                <?php endif;?>
            </div>
            </div>
			<div class="right-container">
				<section class="sidebar-area">				
					<div class="widget-area">
						<div class="widget">
							<h3 class="widget-title"><?php echo get_field('testimonial_course_text', 'option');?></h3>
							<div class="widget-content">								
								<ul class="widget-list widget-list-budge">
									<?php $categories = get_categories(array('taxonomy' => 'course-categories', 'hide_empty' => false));?>	
									<?php foreach($categories as $category):?>
									<?php 	if(get_taxonomy_post_type_posts_count('testimonials', $category->term_id) == 0){
												continue;
											}
									?>
									<li><a href="<?php echo site_url();?>/course-testimonials/<?php echo $category->term_id;?>"><?php echo $category->name;?> <span class="budge-list"><?php echo get_taxonomy_post_type_posts_count('testimonials', $category->term_id);?></span></a></li>
									<?php endforeach;?>									
								</ul>
							</div>
						</div>                               
					</div>					
				</section>
			</div>
		</section>
	</section> <!-- #main -->
</section> <!-- #main-container -->
<?php get_footer();?>
