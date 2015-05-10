<?php /* Template Name: Event Calendar */ ?>
<?php get_header();?>
<section class="main-container clearfix">
	<section class="main wrapper clearfix">
		<section class="inner-main-container clearfix">
			<header class="content-title page-title">
			<?php if(have_posts()):?>
				<?php while(have_posts()): the_post();?>
				<?php $title = explode(' ', get_the_title());?>
				<h1><span><?php echo $title[0]?></span> <?php echo $title[1]?></h1>
				<p class="sub-text"><?php echo get_the_content();?></p>
				<?php endwhile; wp_reset_query();?>
			<?php endif;?>
			</header>
			<section class="event-calender-section clearfix">
			<?php
                        $dates_array = array();
                        query_posts(array('post_type' =>'events'));
                        if(have_posts()):
                            while(have_posts()):
                                the_post();
                                $temp_arr = get_field('dates');
                                foreach ($temp_arr as $val) {
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
                        $reset_array = array();
                        $pre_post_id = '0';
                        $pre_month_year = '';
                        foreach ($dates_array as $date) {
                            array_push($reset_array, $date);
                        }
						//echo '<pre>';
						//print_r($reset_array);
                        $all_ids = array();						
                        foreach ($reset_array as $key => $date) {
                            //echo $pre_month_year;							
							if(in_array($date['post_id'], $all_ids) && date('F, Y', strtotime($date['start_date'])) == $pre_month_year){
                                if(array_key_exists(($key + 1), $reset_array)){                                								
									if(date('F, Y', strtotime($date['start_date'])) <> date('F, Y', strtotime($reset_array[($key + 1)]['start_date']))){
						?>
									</div>
                                    </div>
                                </section>
						<?php 		}
								}
								continue;
                            }
                            if(date('F, Y', strtotime($date['start_date'])) <> $pre_month_year){
                                if(strtotime($date['start_date']) >= strtotime(date('Y-m-d',time()))){
                        ?>
                                <section class="event-calender-lists clearfix">
                                    <header class="event-calender-title">
                                        <h2><?php echo date('F, Y', strtotime($date['start_date']));?></h2>
                                    </header>
                                    <div class="event-calender-area clearfix">
                                        <div class="row">
                        <?php
                                }else{
                                    continue;
                                }
                            }							
                            $post = get_post($date['post_id']);                                                       
							$image = vt_resize(get_post_thumbnail_id($date['post_id']), '', 146, 103);
                            $dates = get_field('dates', $date['post_id'], true);
                            aasort($dates, 'start_date');
              ?>
                            <div class="col-sm-6">
                                <article class="event-calender-block clearfix">
									<?php if(!empty($image['url'])):?>
                                    <figure class="event-calender-image"><img src="<?php echo $image['url'];?>" alt=""></figure>
									<?php else: ?>
									<?php $image = vt_resize('', get_template_directory_uri().'/images/dynamicmindworks.png', 146, 103);?>
									<figure class="event-calender-image"><img src="<?php echo $image['url'];?>" alt=""></figure>
									<?php endif; ?>
                                    <div class="event-calender-content">
                                        <h4><a href="<?php echo get_the_permalink($date['post_id']); ?>"><?php echo $post->post_title;?></a></h4>
                                        <p class="location">
                                        <strong>Location:</strong>
                                            <span class="date-location-a"><?php echo get_field('location');?></span>
                                        </p>
                                        <p class="dates">
                                        <strong>Dates:</strong>
                                            
            <?php
                            foreach ($dates as $dt){
                                if(strtotime($date['start_date']) <= strtotime($dt['start_date'])){                                                                    
            ?>
                                <span class="date-location-a"><?php echo date('d F, Y', strtotime($dt['start_date']));?> - <?php echo date('d F, Y', strtotime($dt['end_date']));?> <?php echo ($dt['time'] <> '')? "(".$dt['time'].")":'';?></span>                       
            <?php
                    }
                            }
            ?>
									</p>
									</div>
								</article>
							</div>
            <?php
                            if(array_key_exists(($key + 1), $reset_array)){                                
								//echo $key.' || '.($key + 1).'<br/>';	
								//echo date('F, Y', strtotime($date['start_date'])).' || '.date('F, Y', strtotime($reset_array[($key + 1)]['start_date'])).'<br>';
								if(date('F, Y', strtotime($date['start_date'])) <> date('F, Y', strtotime($reset_array[($key + 1)]['start_date']))){							
            ?>
                                       </div>
                                    </div>
                                </section>
            <?php
                                }
                            }
                            $all_ids[] = $date['post_id'];
							$pre_post_id = $date['post_id'];
                            $pre_month_year = date('F, Y', strtotime($date['start_date']));
                        }
                        
                    ?>											
			</section>
		</section>
	</section> <!-- #main -->
</section> <!-- #main-container -->
<?php get_footer();?>