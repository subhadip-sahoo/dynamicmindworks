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
$term_name = $wp_query->queried_object->slug;
$taxonomy = $wp_query->queried_object->taxonomy;
$term_id = $wp_query->queried_object->term_id;
$taxonomy_template = get_field('squeeze_category', $taxonomy . '_' . $term_id);
$squeeze_mailchimp_list_id = get_field('squeeze_mailchimp_list_id', $taxonomy . '_' . $term_id);
$err_msg = '';
$war_msg = '';
$suc_msg = '';
if(isset($_POST['squeeze_mc_form_submit']) && $_POST['squeeze_mc_form_submit'] == 'squeeze_mc_signup'){
	if(!empty($_POST['squeeze_email'])){
		$err_msg = $opts['form']['text_invalid_email'];
	}
	else if(!filter_var(esc_attr($_POST['squeeze_email']), FILTER_VALIDATE_EMAIL)){
		$err_msg = $opts['form']['text_invalid_email'];
	}
	if($err_msg == ''){
		$opts = mc4wp_get_options();
		$mailchimp = new MC4WP_Lite_API($opts['general']['api_key']);
		//$lists = explode(',', $squeeze_mailchimp_list_id);
		$status = $mailchimp->subscribe($squeeze_mailchimp_list_id, $_POST['squeeze_email'], array('name' => $_POST['squeeze_name']));
		if($status){
			$suc_msg = $opts['form']['text_success'];
		}else if($status == 'already_subscribed'){
			$war_msg = $opts['form']['text_already_subscribed'];
		} else if($status == 'error'){
			$err_msg = $opts['form']['text_error'];
		}
	}	
}
/*echo '<pre>';
print_r(mc4wp_get_options());*/
get_header();
?>
<section class="main-container clearfix">
	<section class="main wrapper clearfix">
		<section class="inner-main-container clearfix">
			<?php if(is_array($taxonomy_template) && !empty($taxonomy_template) && $taxonomy_template[0] == 'squeeze_category'):?>
			<?php require_once dirname(__FILE__).'/squeeze_category_template.php';?>
			<?php else:?>			
			<?php query_posts(array('post_type' => 'course-image-gallery', 'taxonomy' => 'course-categories', 'course-categories' => $term_name));?>
			<?php if(have_posts()):?>
			<div class="category-slider-container clearfix">				
                <ul id="course_images">			
                    <?php while(have_posts()): the_post();?>
                    <li>
                        <?php if(has_post_thumbnail()):?>					
                        <?php $image = vt_resize(get_post_thumbnail_id(get_the_ID()), '', 208, 163);?>
                        <a href="<?php echo get_field('image_url');?>" target="_blank">
                            <img src="<?php echo $image['url'];?>" alt="" />
                        </a>
                        <?php endif;?>
                    </li>
                <?php endwhile; ?>
                </ul>               
            </div>
			 <?php endif; wp_reset_query(); ?>
			<?php //echo '<pre>'; print_r($wp_query);?>
			<div class="left-container">					
                <header class="content-title page-title">
                    <h1 class="archive-title"><?php echo $wp_query->queried_object->name; ?></h1>                    
                    <h3><?php echo get_field('category_subtitle', $wp_query->queried_object->taxonomy.'_'.$wp_query->queried_object->term_id, 'course-categories');?></h3>                    
                    <p><?php echo term_description( $wp_query->queried_object->term_id, $wp_query->queried_object->taxonomy );//$wp_query->queried_object->description;?></p>                    
                </header><!-- .archive-header -->		
				<div class="row">
				<?php query_posts(array('post_type' => 'videos', 'posts_per_page' => 1, 'taxonomy' => 'course-categories', 'course-categories' => $term_name));?>
				<?php if(have_posts()):?>
                    <div class="col-md-6">
						<div class="inner-category-video-container clearfix">							                            
							<?php while(have_posts()): the_post();?>
								<?php if(get_field('video_url') <> ''):?>
								<iframe src="<?php echo get_field('video_url');?>" width="100" height="200"></iframe>
								<?php else:?>
								<img src="<?php echo get_template_directory_uri();?>/images/no-video-available.jpg" alt="" width="" height=""/>
								<?php endif;?>
								<p><?php echo get_the_excerpt() ? excerpt_to_charlength(200, get_the_excerpt()) : excerpt_to_charlength(200, get_the_content()); ?></p>
							<?php endwhile; wp_reset_query();?>                            
                        </div>
                    </div>
                    <?php endif;?>
					<?php query_posts(array('post_type' => 'testimonials', 'posts_per_page' => -1, 'taxonomy' => 'course-categories', 'course-categories' => $term_name));?>
					<?php if(have_posts()):?>
                    <div class="col-md-6">
						<div class="inner-category-testimonials-container clearfix">						                                
							<ul id="course_testimonials">
								<?php while(have_posts()): the_post();?>
								<li>
									<div class="testimonials-other-details">
                                        <h5><i class="glyphicon glyphicon-user"></i> - <?php the_title();?></h5>
                                        <?php if(get_field('designation') <> ''):?>
                                            <p class="designation-content"><i class="glyphicon glyphicon-hand-right"></i> - <?php echo get_field('designation');?></p>
                                        <?php endif;?>                                        	
                                    </div>
									<p><?php echo get_the_excerpt() ? excerpt_to_charlength(170, get_the_excerpt(), get_the_ID()) : excerpt_to_charlength(170, get_the_content(), get_the_ID()); ?></p>
									<!--<a href="<?php //echo the_permalink();?>">View more</a>-->
									<a href="<?php echo site_url();?>/testimonials" class="pull-right testimonials-view-link">View all</a>	
								</li>
								<?php endwhile; wp_reset_query();?>						
							</ul>								                            
                         </div>
                     </div>
				  <?php endif;?>
				</div>				
			</div>
			<?php query_posts(array('post_type' => 'events', 'posts_per_page' => -1, 'taxonomy' => 'course-categories', 'course-categories' => $term_name));
			$dates_array = array();
			?>
			<?php 
				if(have_posts()):
					while(have_posts()):
							the_post();
							$temp_arr = get_field('dates');
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
					//print_r($unique_ids);					
			?>
			<?php if(!empty($unique_ids)):?>
			<div class="right-container">
				<section class="sidebar-area">
                	<header class="content-title">
                    	<h2>Related Events</h2>
                    </header>
					<div class="event-lists event-lists-container">										
					<ul class="unstyled" id="course_events">
					<?php $flag = 0;?>
					<?php foreach($unique_ids as $id): $flag++; ?>											
						<?php 
							$post = get_post($id);
							$image = vt_resize(get_post_thumbnail_id($id), '', 146, 103);
						?>
						<?php if($flag == 1):?>
						<li>
						<?php endif;?>
							<div class="course_events_blocks">
								<?php if(!empty($image)):?>
                                <figure class="event-image">
                                    <img src="<?php echo $image['url'];?>" alt="" class="rounded_image">
                                </figure>
								<?php endif;?>
                                <article class="event-content">
                                    <h4><a href="<?php echo get_the_permalink($id);?>"><?php echo $post->post_title;?></a></h4>
                                    <p class="location">
                                        <strong>Location:</strong> <span class="date-location-a"><?php echo get_field('location', $id, true);?></span>
                                    </p>                                    
                                    <p class="dates">
                                        <?php $dates = get_field('dates', $id, true);?>
                                        <?php aasort($dates, 'start_date');?>
                                        <strong>Dates:</strong>
                                        <?php 
											foreach($dates as $date):
												if(strtotime($date['start_date']) >= strtotime(date('Y-m-d',time()))):
										?>
                                        <span class="date-location-a"><?php echo date('d F Y', strtotime($date['start_date']));?> - <?php echo  date('d F Y', strtotime($date['end_date']));?></span>
                                        <?php endif; endforeach;?>									
                                    </p>
									<p class="location">
                                        <strong>Duration:</strong> <span class="date-location-a"><?php echo get_field('course_length', $id, true);?></span>
                                    </p>
									<p class="location">
                                        <strong>Price:</strong> 
										<span class="date-location-a">
										<?php 
											echo '$'.str_replace('$', '',get_field('price', $id, true));
											$cut_off_date = get_field('early_bird_cut_off_date', $id, true);
											$cut_off_price = str_replace('$', '',get_field('early_bird_price', $id, true));			
											if(date('Y-m-d',strtotime($cut_off_date)) >= date('Y-m-d', strtotime('now'))){												
												echo ' { Early Bird: $'.$cut_off_price.' }';
											}
										?>
										</span>
                                    </p>
									<p class="location"><?php echo ($post->post_excerpt <> '') ? excerpt_to_charlength(100, $post->post_excerpt, $id) : excerpt_to_charlength(100, $post->post_content, $id); ?></p>
                                    <form name="book_me" action="<?php echo site_url();?>/book-now" method="POST">
                                        <input type="hidden" name="event_id" value="<?php echo get_the_ID();?>">
                                        <input type="submit" name="book_me" value="Book Me" class="btn">
                                    </form>
                                </article>
                            </div>
						<?php if($flag == 2): $flag = 0;?>
						</li>	
						<?php endif;?>
						<?php endforeach; wp_reset_query();?>
					</ul>
					<div class="text-right">
                    	<a href="<?php echo site_url();?>/event-calendar" class="all-event-link">See all events</a>
                    </div>									
					</div>
				</section>				
			</div>
			<?php endif;?>	
			<?php endif;?>
			<!-- END -->
		</section>
	</section> <!-- #main -->
</section> <!-- #main-container -->
<?php 
get_footer();