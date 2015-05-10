<?php /* Template Name: Course Testimonials */?>
<?php 
	$url = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$segment = explode('/', untrailingslashit($url));
	$course_id = end($segment);
	if(!is_numeric($course_id)){
		wp_safe_redirect(home_url());
		exit();
	}
	$term = get_term($course_id, 'course-categories');
?>
<?php get_header();?>
<section class="main-container clearfix">
	<section class="main wrapper clearfix">
		<section class="inner-main-container clearfix">
			<div class="left-container">			
				<header class="content-title page-title">
					<h1><?php echo $term->name;?></h1>			
				</header>
				<section class="blog-lists clearfix">				
				<?php query_posts(array('post_type' =>'testimonials', 'posts_per_page' => 10, 'taxonomy' => 'course-categories', 'course-categories' => $term->slug));
				?>
				<?php if(have_posts()):?>
					<?php //echo do_shortcode('[ajax_load_more post_type="testimonials" max_pages="11" "taxonomy" => "course-categories" "course-categories" => '.$term->slug.']')?>
					<?php echo do_shortcode('[ajax_load_more post_type="testimonials" taxonomy="course-categories" taxonomy_terms="'.$term->slug.'" max_pages="20"]')?>
						<?php //custom_numeric_posts_nav();?>	
					<?php else:?>						
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
