<article class="hentry testimonials-lists">							
	<div class="blog-list-content clearfix">								
		<figure class="blog-image">																			
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
		<div class="blog-content">									
			<p><?php echo (get_the_excerpt(get_the_ID()) <> '') ? excerpt_to_charlength(290, get_the_excerpt(get_the_ID()), get_the_ID()) : excerpt_to_charlength(290, get_the_content(get_the_ID()), get_the_ID()); ?></p>
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
			<!--<a href="<?php //the_permalink();?>" class="link blog-link">Read More</a>-->
		</div>
	</div>
</article>