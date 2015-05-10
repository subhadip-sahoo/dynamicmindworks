<?php get_header();?>
<section class="main-container clearfix">
	<section class="main wrapper clearfix">
		<section class="inner-main-container clearfix">
        	<div class="full-container">
			<div class="blog-lists">
				<?php if(have_posts()):?>
                    <?php while(have_posts()): the_post();?>					
                        <?php setPostViews(get_the_ID());?>
                        	<header class="content-title">
                                <h1><?php the_title();?></h1>
                            </header>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>                                
                                <div class="single-content-area clearfix">
                                    <?php if(has_post_thumbnail()):?>	
									<figure class="single-image-area">                                        								
										<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');?>
										<?php //$image = vt_resize(get_post_thumbnail_id(get_the_ID()), '', 271, 198, false);?>
										<img src="<?php echo $image[0];?>" alt="<?php the_post_thumbnail_caption(get_the_ID());?>">
                                    </figure>									
									 <?php endif;?>
                                    <div class="single-content-section">
                                        <?php the_content();?>	
                                    </div>
                                </div>
                            </article>
                    <?php
                        if ( comments_open() || get_comments_number() ) {
                            //comments_template();
                        }
                    ?>
                    <?php endwhile;?>
                <?php endif;?>
            </div>
            </div>
			<?php /*?><div class="right-container">
            	<section class="sidebar-area">				
					<div class="widget-area">
						<div class="widget">
							<h3 class="widget-title">Categories</h3>
							<div class="widget-content">								
								<ul class="widget-list widget-list-budge">
									<?php $categories = get_categories(array('taxonomy' => 'category', 'hide_empty' => true));?>		
									<?php foreach($categories as $category):?>
									<li><a href="<?php echo get_category_link( $category->term_id );?>"><?php echo $category->name;?> <span class="budge-list"><?php echo $category->count;?></span></a></li>
									<?php endforeach;?>									
								</ul>
							</div>
						</div>                               
					</div>
					<div class="widget-area">
						<div class="widget">
							<h3 class="widget-title">Popular Posts</h3>
							<div class="widget-content">
								<ul class="widget-list">
									<?php query_posts('meta_key=post_views_count&orderby=meta_value_num&order=DESC&posts_per_page=5');
									if (have_posts()) : while (have_posts()) : the_post(); ?>
									<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
									<?php endwhile; endif; wp_reset_query();?>									
								</ul>
							</div>
						</div>
					</div>
				</section>
            </div><?php */?>
		</section>
	</section> <!-- #main -->
</section> <!-- #main-container -->
<?php get_footer();?>
