<?php /* Template Name: Testimonials */?>
<?php get_header();?>
<section class="main-container clearfix">
	<section class="main wrapper clearfix">
		<section class="inner-main-container clearfix">
			<div class="left-container">			
				<header class="content-title page-title">
					<h1><?php the_title(); ?></h1>			
				</header>
				<section class="blog-lists clearfix">	
				<?php $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;?>
				<?php query_posts(array('post_type' =>'testimonials', 'posts_per_page' => 10, 'paged' => $paged));?>						
				<?php if(have_posts()):?>					
						<?php /*custom_numeric_posts_nav(); */echo do_shortcode('[ajax_load_more post_type="testimonials" max_pages="20"]');?>	
					<?php else:?>
						<header class="content-title">
							<h1><?php the_title();?></h1>
						</header>
						<div class="single-content-section">
							<p><?php _e( 'No testimonials found', 'twentyfourteen' ); ?></p>	
						</div>
					<?php endif;?>					
				</section>
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
