<?php get_header();?>
<section class="main-container clearfix">
	<section class="main wrapper clearfix">
		<section class="inner-main-container clearfix">
			<div class="left-container">			
				<header class="content-title page-title">
					<h1><?php printf( __( '<span>Search Results for:</span> %s', 'twentyfourteen' ), get_search_query() ); ?></h1>			
				</header>
				<section class="blog-lists clearfix">				
				<?php if(have_posts()):?>
					<?php while(have_posts()): the_post();?>
						<article class="hentry">							
							<div class="blog-list-content clearfix">								
								<figure class="blog-image">																			
									<?php if(has_post_thumbnail()):?>
									<?php $image = vt_resize(get_post_thumbnail_id(get_the_ID()), '', 271, 198, false);?>
										<img src="<?php echo $image['url'];?>" alt="Images">
									<?php else:?>
										<?php $image = vt_resize('', get_template_directory_uri().'/images/no-image.png', 271, 198, true);?>
										<img src="<?php echo $image['url'];?>" alt="No Image" />
									<?php endif;?>	
								</figure>								
								<div class="blog-content">
									<h4 class="blog-title"><?php the_title();?></h4>
									<p><?php echo get_the_excerpt() ? excerpt_to_charlength(350, get_the_excerpt(), get_the_ID()) : excerpt_to_charlength(350, get_the_content(), get_the_ID()); ?></p>									
									<a href="<?php the_permalink();?>" class="link blog-link">Read More</a>
								</div>
							</div>
						</article>
						<?php endwhile;?>
						<?php custom_numeric_posts_nav();?>	
					<?php else:?>
						<header class="content-title">
							<h1><?php the_title();?></h1>
						</header>
						<div class="single-content-section">
							<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'twentyfourteen' ); ?></p>	
						</div>
					<?php endif;?>					
				</section>
			</div>
			<div class="right-container">
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
			</div>
		</section>
	</section> <!-- #main -->
</section> <!-- #main-container -->
<?php get_footer();?>
