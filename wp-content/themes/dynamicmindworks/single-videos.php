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
										<?php if(get_field('video_url') <> ''):?>
											<iframe src="<?php echo get_field('video_url');?>" width="250" height="150" ></iframe> 
										<?php else:?>
											<?php $image = vt_resize('', get_template_directory_uri().'/imagesno-video-available.jpg', 250, 150, true);?>
											<img src="<?php echo $image['url'];?>" alt="No Video" />
										<?php endif;?>																			
									 </figure>
                                    <div class="single-content-section">
                                        <?php the_content();?>	
                                    </div>
                                </div>
                            </article>                   
                    <?php endwhile;?>
                <?php endif;?>
            </div>
            </div>
			<div class="right-container">
				<section class="sidebar-area">				
					<div class="widget-area">
						<div class="widget">
							<h3 class="widget-title"><?php echo get_field('video_course_text', 'option');?></h3>
							<div class="widget-content">								
								<ul class="widget-list widget-list-budge">
									<?php $categories = get_categories(array('taxonomy' => 'course-categories', 'hide_empty' => false));?>	
									<?php foreach($categories as $category):?>
									<?php 	if(get_taxonomy_post_type_posts_count('videos', $category->term_id) == 0){
												continue;
											}
									?>
									<li><a href="<?php echo site_url();?>/course-videos/<?php echo $category->term_id; ?>"><?php echo $category->name;?> <span class="budge-list"><?php echo get_taxonomy_post_type_posts_count('videos', $category->term_id);?></span></a></li>
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
