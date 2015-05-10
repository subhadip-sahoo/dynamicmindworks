<?php get_header();?>
<section class="main-container clearfix">
	<section class="main wrapper clearfix">
		<section class="inner-main-container clearfix">
			<article class="hentry">
			<?php if(have_posts()):?>
				<?php while(have_posts()):?>
					<?php the_post();?>
				<header class="content-title">
					<h1><?php the_title();?></h1>
				</header>
				<?php if(has_post_thumbnail()):?>
				<figure class="blog-imageww clearfix">						
					<?php $image = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large');?>
					<?php //$image = vt_resize(get_post_thumbnail_id(get_the_ID()), '', 271, 198, false);?>
					<img src="<?php echo $image[0];?>" alt="Images">									
				</figure>
				<?php endif;?>
				<div class="content-final">
					<?php the_content();?>	
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</div>
				<?php endwhile;?>
			<?php endif;?>
			</article>
		</section>
	</section> <!-- #main -->
</section> <!-- #main-container -->
<?php get_footer();?>