<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<section class="main-container clearfix">
	<section class="main wrapper clearfix">
		<section class="inner-main-container clearfix">
			<div class="left-container">			
                <header class="content-title page-title">
                    <h1 class="archive-title"><?php printf( __( '%s', 'twentyfourteen' ), single_cat_title( '', false ) ); ?></h1>
    
                    <?php
                        // Show an optional term description.
                        $term_description = term_description();
                        if ( ! empty( $term_description ) ) :
                            printf( '<div class="sub-text">%s</div>', $term_description );
                        endif;
                    ?>
                </header><!-- .archive-header -->
				<section class="blog-lists clearfix">				
				<?php if(have_posts()):?>
					<?php while(have_posts()): the_post();?>
						<article class="hentry">
							<p class="post-meta-blog">Posted by <a href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) ); ?>"><?php the_author(); ?></a> on <?php the_date();?> <?php //echo get_post_comment(get_the_ID())?></p>
							<div class="blog-list-content clearfix">
								<figure class="blog-image">
									<?php if(has_post_thumbnail()):?>										
										<?php $image = vt_resize(get_post_thumbnail_id(get_the_ID()), '', 271, 198, false);?>
										<img src="<?php echo $image['url'];?>" alt="Images">
									<?php else:?>
										<img src="<?php echo get_template_directory_uri();?>/image/no-image.jpg" alt="No Image" />
									<?php endif;?>									
								</figure>
								<div class="blog-content">
									<h4 class="blog-title"><?php the_title();?></h4>
									<p><?php echo get_the_excerpt() ? excerpt_to_charlength(400, get_the_excerpt()) : excerpt_to_charlength(400, get_the_content()); ?></p>									
									<a href="<?php the_permalink();?>" class="link blog-link">Read More</a>
								</div>
							</div>
						</article>
						<?php endwhile;?>
						<?php custom_numeric_posts_nav();?>	
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
<?php 
get_footer();