<?php get_header(); global $post;?>
<section class="main-container clearfix">
	<section class="main wrapper clearfix">
		<section class="inner-main-container clearfix">
        	<div class="full-container">
			<div class="blog-lists">
				<?php if(have_posts()):?>
                    <?php while(have_posts()): the_post();?>					                        
                        	<header class="content-title">
                                <h1><?php the_title();?></h1>
                            </header>	
					<?php endwhile;?>
				<?php endif;?>
						<?php	
							$term_lists = wp_get_post_terms($post->ID, 'course-categories', array('orderby' => 'id', 'order' => 'ASC', 'fields' => 'all'));
							$html = '';
							//echo '<pre>'; print_r($term_lists);
							$reset_array = array();
							foreach($term_lists as $list){
								if($list->parent == 0){
									array_push($reset_array, $list);
									//echo '<pre>'; print_r($list);
									foreach($term_lists as $lists){
										if($lists->parent == $list->term_id){
											array_push($reset_array, $lists);
										}
									}
								}								
							}
							//echo '<pre>'; print_r($reset_array);
							$li_count = 0;
							foreach($reset_array as $term){																
								if($term->parent == 0){									
									$li_count++;
									//echo $li_count;
									if($li_count == 1){
										$html .= '<ul class="row unstyled">';
									}									
									$html .= '<li class="col-sm-4">';
									$image_id = get_field('cat_image', $term->taxonomy . '_' . $term->term_id, 'course-categories');
									$image = wp_get_attachment_image_src($image_id, 'large');
									if(!empty($image)){
										$html .= '<figure class="single-image-area">';
										$html .= '<img src="'.$image[0].'">';
										$html .= '</figure>';
									}
									$html .= '<h3>'.$term->name.'</h3>';
									$flag = 0;									
									$count = 0;
									foreach ($term_lists as $key=>$value) {
										if ($value->parent == $term->term_id) {
											$count++;
										}
									}									
								}																
								if($term->parent <> 0){									
									if($flag == 0){										
										$html .= '<ul class="category-course-ul">';
									}
									$html .= '<li><a href="'.get_term_link($term->term_id, 'course-categories').'">'.$term->name.'</a></li>';
									if($flag == $count - 1){
										$html .= '</ul>';
										$html .= '</li>';
										if($li_count == 3){
											$html .= '</ul>';
											$li_count = 0;
										}										
									}
									$flag++;
								}
							}							
							echo $html;
						?>						                                     
				</div>
            </div>			
		</section>
	</section> <!-- #main -->
</section> <!-- #main-container -->
<?php get_footer();?>