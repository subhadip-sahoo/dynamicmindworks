<?php 
	$sqeeze_banner_image = get_field('squeeze_banner_image', $taxonomy . '_' . $term_id);
	$squeeze_banner_image_caption = get_field('squeeze_banner_image_caption', $taxonomy . '_' . $term_id);
	$squeeze_text_above_mc_form = get_field('squeeze_text_above_mc_form', $taxonomy . '_' . $term_id);
	$squeeze_template_title_text = get_field('squeeze_template_title_text', $taxonomy . '_' . $term_id);
	$squeeze_template_video_title = get_field('squeeze_template_video_title', $taxonomy . '_' . $term_id);
	$squeeze_template_video_url = get_field('squeeze_template_video_url', $taxonomy . '_' . $term_id);
	$squeeze_template_title_before_video = get_field('squeeze_template_title_before_video', $taxonomy . '_' . $term_id);
	$squeeze_template_features = get_field('stf', $taxonomy . '_' . $term_id);
	//var_dump($sqeeze_banner_image);
	/*echo '<pre>';
	print_r($squeeze_template_features);*/
?>
<div>
    	<div class="banner squeeze_banner" style="background: url('<?php echo $sqeeze_banner_image;?>') no-repeat scroll center top / cover rgba(0, 0, 0, 0);">
    		<div class="row">
    			<div class="col-md-5">
    				<p><?php echo $squeeze_banner_image_caption;?></p>
    			</div>
    			<div class="col-md-7">
    				<h3 class="form-title"><?php echo $squeeze_text_above_mc_form;?></h3>
    				<!-- Begin MailChimp Signup Form -->
					<div class="free-bonus-form-area">
                        <h2 class="inner-head"><?php echo get_field('squeeze_template_capture_form_text_1', $taxonomy . '_' . $term_id);?></h2>
                        <div class="inner-bonus-form-area">
                            <header class="title-group text-center">
                                <h2><?php echo get_field('squeeze_template_capture_form_text_2', $taxonomy . '_' . $term_id);?></h2>
                                <h3><?php echo get_field('squeeze_template_capture_form_text_3', $taxonomy . '_' . $term_id);?></h3>
                            </header>
                            <div class="inner-bonus-form">
								<?php if(!empty($err_msg)):?>
								<div class="mc4wp-alert mc4wp-error"><?php echo $err_msg;?></div>
								<?php endif;?>
								<?php if(!empty($war_msg)):?>
								<div class="mc4wp-alert mc4wp-notice"><?php echo $war_msg;?></div>
								<?php endif;?>
								<?php if(!empty($suc_msg)):?>
								<div class="mc4wp-alert mc4wp-success"><?php echo $suc_msg;?></div>
								<?php endif;?>
								<form name="squeeze_mc_form" id="squeeze_mc_form" action="" method="POST">
									<p><input type="text" id="mc4wp_name" name="squeeze_name" placeholder="Name" class="validate[required]"></p>
									<p><input type="text" id="mc4wp_email" name="squeeze_email" placeholder="Email" class="validate[required, custom[email]]"></p>
									<input type="hidden" name="squeeze_mc_form_submit" value="squeeze_mc_signup" />
									<p><button type="submit" class="btn">YES, I Want To Reach My Full Potential Starting Now!" </button></p>
								</form>
                            </div>
                        </div>
						<?php //echo do_shortcode('[mc4wp_form]') ;?>
                    </div>
                    <!--End mc_embed_signup-->
    			</div>
    		</div>
    	</div>
    	<section class="video-section">
    		<h3 id="title"><?php echo $squeeze_template_title_text;?></h3>
    		<h6 class="watch-video"><?php echo $squeeze_template_video_title;?></h6>
    		<br>
    		<iframe src="<?php echo $squeeze_template_video_url;?>" width="642" height="365" ></iframe>
    		<br>
    		<h4 class="video-title"><?php echo $squeeze_template_title_before_video;?></h4>
    		<br>
    		<div class="row">
			<?php if(!empty($squeeze_template_features)): ?>
			<?php foreach($squeeze_template_features as $stf): ?>
    			<div class="col-sm-4">    				
					<article>
    					<p align="center"><img alt="img" src="<?php echo $stf['sfi'];?>"></p>
    					<h6><?php echo $stf['sft'];?></h6>
						<?php if(is_array($stf['sf']) && !empty($stf['sf'])):?>
    					<ul>
							<?php foreach($stf['sf'] as $sf): ?>
    						<li><?php echo $sf['f_lists'];?></li>    						
							<?php endforeach;?>
    					</ul>
						<?php endif;?>
    				</article>					
    			</div>
				<?php endforeach;?>
				<?php endif;?>    			
    		</div>
    	</section>    	
    </div>