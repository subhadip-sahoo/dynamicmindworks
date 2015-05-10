<?php /* Template Name: Book Now */ ?>
<?php
session_start();
if(isset($_POST['event_id'])){
	$post = get_post($_POST['event_id']);
}else{
	query_posts(array('post_type' => 'events'));
	$dates_array = array();
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
		wp_reset_query();
	endif;
	aasort($dates_array, 'end_date');												
	$unique_ids = array();
	foreach($dates_array as $dt){
		if(strtotime($dt['start_date']) >= strtotime('now')){
			array_push($unique_ids, $dt['post_id']);
		}													
	}					
	$unique_ids = array_unique($unique_ids);
}
if(isset($_POST['book_now'])){	
	$err_msg = '';
	$suc_msg = '';
	if(esc_attr($_POST['cus_fname']) == ''){
		$err_msg = 'First name is required.';
	}
	else if(esc_attr($_POST['cus_lname']) == ''){
		$err_msg = 'Last name is required.';
	}
	else if(esc_attr($_POST['cus_dob']) == ''){
		$err_msg = 'Date of birth is required.';
	}
	else if(esc_attr($_POST['cus_occupation']) == ''){
		$err_msg = 'Occupation is required.';
	}
	else if(esc_attr($_POST['cus_street']) == ''){
		$err_msg = 'Street is required.';
	}
	else if(esc_attr($_POST['cus_suburb']) == ''){
		$err_msg = 'Suburb is required.';
	}
	else if(esc_attr($_POST['cus_state']) == ''){
		$err_msg = 'State is required.';
	}
	else if(esc_attr($_POST['cus_postcode']) == ''){
		$err_msg = 'Postcode is required.';
	}
	else if(esc_attr($_POST['cus_resstreet']) == ''){
		$err_msg = 'Street is required.';
	}
	else if(esc_attr($_POST['cus_ressuburb']) == ''){
		$err_msg = 'Suburb is required.';
	}
	else if(esc_attr($_POST['cus_resstate']) == ''){
		$err_msg = 'State is required.';
	}
	else if(esc_attr($_POST['cus_respostcode']) == ''){
		$err_msg = 'Postcode is required.';
	}
	else if(esc_attr($_POST['cus_email']) == ''){
		$err_msg = 'Email is required.';
	}
	else if(!filter_var(esc_attr($_POST['cus_email']), FILTER_VALIDATE_EMAIL)){
		$err_msg = 'Enter a valid email.';
	}
	else if(esc_attr($_POST['cus_countryCode']) == ''){
		$err_msg = 'Country code is required.';
	}
	else if(esc_attr($_POST['cus_phone']) == ''){
		$err_msg = 'Phone number is required.';
	}
	else if(!isset($_POST['read_and_agreed']) && esc_attr($_POST['read_and_agreed']) == '1'){
		$err_msg = 'Please check read and agreed.';
	}
	if($err_msg == ''){
		if( $_SESSION['security_code'] == $_POST['security_code'] && !empty($_SESSION['security_code'] ) ) {
			$post_course_title = get_post($_POST['course']);
			$to = get_field('emaill_address_for_booking_form_info', 'option');//get_option('admin_email');//'subhadip.sahoo@businessprodesigns.com';//
			$from_name = "Robbwhitewood";
			$headers = "From: $from_name <$from>\r\n";
			$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
			$subject = "Booking request from Robbwhitewood.";
			$first_name = esc_attr($_POST['cus_fname']);
			$middle_name = ($_POST['cus_mname'] <> '')? ' '.esc_attr($_POST['cus_mname']): '';
			$last_name = ' '.esc_attr($_POST['cus_lname']);
			$country_code = esc_attr($_POST['cus_countryCode']);
			$area_code = ($_POST['cus_areaCode'] <> '')? '-'.esc_attr($_POST['cus_areaCode']): '';
			$number = '-'.esc_attr($_POST['cus_phone']);
			$phone_no = $country_code.$area_code.$number;
			$name = $first_name.$middle_name.$last_name;
			$msg = '------------------------------------------------<br/>';
			$msg .= 'Booking form details<br/>';
			$msg .= '------------------------------------------------<br/>';			
			$msg .= '<br/><br/>';			
			$msg .= '---- Course Related Information ----<br/>';		
			$msg .= '<br/>';	
			$msg .= "Course Name: ". $post_course_title->post_title.'<br/>';
			$msg .= "Location: ". esc_attr($_POST['location']).'<br/>';
			$msg .= "Course start date: ". esc_attr($_POST['event_date']).'<br/>';
			$msg .= "Attending: ". esc_attr($_POST['attending']) .'<br/>';
			$msg .= "Booking code: ". esc_attr($_POST['cus_booking_code']).'<br/>';	
			$msg .= "Actual Price: ". $_POST['actual_price'].'<br/>';	
			$msg .= ($_POST['updated_price'] <> '')?"Updated Price: ". $_POST['updated_price']."<br/>":"";	
			$msg .= '<br/>';
			$msg .= '---- Personal Information ----<br/>';
			$msg .= '<br/>';
			$msg .= "Name: ". $name.'<br/>';			
			$msg .= "Date of Birth: ". esc_attr($_POST['cus_dob']).' (dd/mm/yyyy) <br/>';
			$msg .= "Occupation: ". esc_attr($_POST['cus_occupation']).'<br/>';
			$msg .= '<br/>';
			$msg .= '---- Mailing Address ----<br/>';
			$msg .= '<br/>';
			$msg .= "Street: ". esc_attr($_POST['cus_street']).'<br/>';
			$msg .= "Suburb: ". esc_attr($_POST['cus_suburb']).'<br/>';
			$msg .= "State: ". esc_attr($_POST['cus_state']).'<br/>';
			$msg .= "Country: ". esc_attr($_POST['cus_country']).'<br/>';
			$msg .= "Postcode: ". esc_attr($_POST['cus_postcode']).'<br/>';
			$msg .= '<br/>';
			$msg .= '---- Residential Address ----<br/>';
			$msg .= '<br/>';
			$msg .= "Street: ". esc_attr($_POST['cus_resstreet']).'<br/>';
			$msg .= "Suburb: ". esc_attr($_POST['cus_ressuburb']).'<br/>';
			$msg .= "State: ". esc_attr($_POST['cus_resstate']).'<br/>';
			$msg .= "Country: ". esc_attr($_POST['cus_rescountry']).'<br/>';
			$msg .= "Postcode: ". esc_attr($_POST['cus_respostcode']).'<br/>';
			$msg .= '<br/>';
			$msg .= '---- Conatct Information ----<br/>';
			$msg .= '<br/>';
			$msg .= "Email Address: ". esc_attr($_POST['cus_email']).'<br/>';
			$msg .= "Phone No: ". $phone_no.'<br/>';
			$msg .= '<br/>';
			$msg .= '---- Other Information ----<br/>';
			$msg .= '<br/>';
			$msg .= "Comments: ". esc_attr($_POST['cus_comment']).'<br/>';
			$msg .= "How did you hear about us?: ". esc_attr($_POST['how_options']).'<br/>';			
			$msg .= "Terms and Conditions: <br/>". esc_attr($_POST['cus_term']).'<br/>';			
			if(wp_mail( $to, $subject, $msg, $headers )){
				$user_email = esc_attr($_POST['cus_email']);
				$from_name_user = "Dynamic Mind Works";
				$from = get_field('emaill_address_for_booking_form_info', 'option');
				$headers_user = "From: $from_name_user <$from>\r\n";
				$headers_user .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$subject_user = (get_field('booking_form_email_subject', 'option') <> '')? str_replace('[user_name]', $name, get_field('booking_form_email_subject', 'option')): 'Booking form details in Dynamic Mind Works';
				$content = (get_field('booking_form_email_body_content', 'option') <> '')? str_replace(array('[user_name]', '[booking_form_fields_details]'), array($name, $msg), get_field('booking_form_email_body_content', 'option')): $msg;
				if(wp_mail( $user_email, $subject_user, $content, $headers_user )){
					$success = 1;
					unset($_POST);
				}else{
					$err_msg = 'Error occured. Please try again later.';	
				}
			}else{
				$err_msg = 'Error occured. Please try again later.';			
			}		
		}else{
			$err_msg = 'Security code does not match.';			
		}
	}	
}
?>
<?php get_header(); global $wpdb;?>
<script type="text/javascript">
    (function($){
        $(function(){
            $('#course').change(function(){
                var course = $(this).val();				
				var option = $('#attending').val();
				var percentage = $('#attending').find(':selected').data('percentage');
				var booking_code = $('#cus_booking_code').val();
                $.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php');?>',
                    data: {course: course, option: option, percentage: percentage, booking_code: booking_code, action: 'book_me_now'},
                    success: function(response){                                                
						var res = JSON.parse(response);                            
						$('#location').html(res.location);
						$('#event_date').html(res.dates);
						$('#early_bird').empty().text(res.price);
						$('#cus_term').empty().text(res.terms_and_cond);
						$('#actual_price').val(res.actual_price);						
						$('#updated_price').val(res.updated_price);
                    }
                });
            });			
			<?php if(isset($success) && $success == 1):?>				
				$('#myModal').modal();
			<?php endif;?>
			$('#dob_datepicker').datepicker({dateFormat : 'dd/mm/yy',  changeMonth: true, changeYear: true, yearRange: "-100:+0"});
			$('#mailing_equal_res').change(function(){
				if($(this).is(':checked')){					
					$('input[type=text][name=cus_resstreet]').val($('input[type=text][name=cus_street]').val()).attr('readonly', 'readonly');
					$('input[type=text][name=cus_ressuburb]').val($('input[type=text][name=cus_suburb]').val()).attr('readonly', 'readonly');
					$('input[type=text][name=cus_resstate]').val($('input[type=text][name=cus_state]').val()).attr('readonly', 'readonly');
					$('select[name=cus_rescountry] option').removeAttr('selected').each(function(){						
						if($(this).attr('value') == $('select[name=cus_country]').val()){
							$(this).attr('selected', 'selected');
							$(this).parent().attr('readonly', 'readonly');
						}
					});
					$('input[type=text][name=cus_respostcode]').val($('input[type=text][name=cus_postcode]').val()).attr('readonly', 'readonly');
					//$('input[type=text][name=cus_resstreet]').val($('input[type=text][name=cus_street]').val()).attr('readonly', 'readonly');
				}else {
					//alert(1);
					$('input[type=text][name=cus_resstreet]').removeAttr('readonly').val('');
					$('input[type=text][name=cus_ressuburb]').removeAttr('readonly').val('');
					$('input[type=text][name=cus_resstate]').removeAttr('readonly').val('');
					$('select[name=cus_rescountry]').removeAttr('readonly');
					$('select[name=cus_rescountry] option').removeAttr('selected').each(function(){						
						if($(this).attr('value') == 'Australia'){
							$(this).attr('selected', 'selected');							
						}
					});
					$('input[type=text][name=cus_respostcode]').removeAttr('readonly').val('');
				}
			});
			$('#attending').change(function(){
				var option = $(this).val();
				var percentage = $(this).find(':selected').data('percentage');
				var course = $('#course').val();
				var booking_code = $('#cus_booking_code').val();
				$.ajax({
                    type: 'POST',
                    url: '<?php echo admin_url('admin-ajax.php');?>',
                    data: {course: course, option: option, percentage: percentage, booking_code: booking_code, action: 'attending_callback'},
                    success: function(response){                                                						
						var res = JSON.parse(response);                            						
						$('#early_bird').empty().text(res.price);
						$('#actual_price').val(res.actual_price);						
						$('#updated_price').val(res.updated_price);
                    }
                });
			});			
			$('#cus_booking_code').bind('keyup change', function(){
				var booking_code = $(this).val();
				var course = $('#course').val();
				var option = $('#attending').val();
				var percentage = $('#attending').find(':selected').data('percentage');
				$.ajax({
					type: 'POST',
					url: '<?php echo admin_url('admin-ajax.php');?>',
					data: {course: course, option: option, percentage: percentage, booking_code: booking_code, action: 'attending_callback'},
                    success: function(response){                                                						
						var res = JSON.parse(response);                            						
						$('#early_bird').empty().text(res.price);						
						$('#actual_price').val(res.actual_price);						
						$('#updated_price').val(res.updated_price);						
                    }
				});
			});
        });			
    })(jQuery);
</script>
<div class="modal model-success fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header bg-success">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h4 class="modal-title text-success" id="myModalLabel"><i class="glyphicon glyphicon-ok"></i> Success</h4>
      </div>
      <div class="modal-body"><?php echo get_field('book_now_successful_message', 'option');?></div>
      <div class="modal-footer">
        <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>        
      </div>
    </div>
  </div>
</div>
<section class="main-container clearfix">
	<section class="main wrapper clearfix">
		<section class="inner-main-container clearfix">
			<?php if(have_posts()): while(have_posts()): the_post(); ?>
                <article class="hentry">			
                    <header class="content-title">
                        <h1><?php the_title();?></h1>
                    </header>
                    <div class="content-final">
                    	<?php the_content(); ?>
                    </div>
                 </article>
			 <?php endwhile;
				wp_reset_query();
			 endif;?>
            <div class="content-final col-md-8">					
                <form name="booking_form" id="booking_form" action="" method="POST">
                    <?php if(!empty($err_msg)):?>
						<script type="text/javascript">
							(function($){
								$(function(){
									//alert(1);
									var course = <?php echo $_POST['course'];?>;
									var option = '<?php echo $_POST['attending'];?>';									
									var percentage = $('#attending').find(':selected').data('percentage');									
									var booking_code = $('#cus_booking_code').val();
									$.ajax({
										type: 'POST',
										url: '<?php echo admin_url('admin-ajax.php')?>',
										data: {course: course, option: option, percentage: percentage, booking_code: booking_code, action: 'book_me_now'},
										success: function(response){											
											//alert(response);
											var res = JSON.parse(response);
											$('#location').html(res.location);
											$('#event_date').html(res.dates);
											$('#early_bird').empty().text(res.price);
											$('#cus_term').empty().text(res.terms_and_cond);
											$('#actual_price').val(res.actual_price);						
											$('#updated_price').val(res.updated_price);
										}
									});												
								});				 		
							})(jQuery);
						</script>
                        <div class="alert alert-danger text-danger" role="alert">
                          <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                          	<?php echo $err_msg;?>
                        </div>
					<?php endif;?>                    
                    <div class="form-horizontal" role="form">
						<fieldset>
							<legend>Course Related Information</legend>
							<div class="form-group">
								<label for="inputcourse3" class="col-sm-4 control-label">Course: </label>
								<div class="col-sm-8">																
										<?php if(isset($_POST['event_id'])):
												$post = get_post($_POST['event_id']);
										?>
											<select name="course" id="course" class="form-control">
												<option value="<?php echo $_POST['event_id'];?>" <?php echo(isset($_POST['course']) && $_POST['course'] == $_POST['event_id'])?'selected="selected"':'';?>><?php echo $post->post_title;?></option>
											</select>	
										<?php else:	?>
										<select name="course" id="course" class="form-control validate[required]">	
											<option value="">-- Select Course --</option>
										<?php
												foreach($unique_ids as $id):
													$post_all = get_post($id);
										?>
												<option value="<?php echo $id;?>" <?php echo(isset($_POST['course']) && $_POST['course'] == $id)?'selected="selected"':'';?>><?php echo $post_all->post_title;?></option>				
										<?php
												endforeach;
												?>
										</select>	
										<?php
											endif;
										?>																							  
								</div>
						  </div>						  
						  <div class="form-group">
							<label for="inputlocation3" class="col-sm-4 control-label">Location: </label>
							<div class="col-sm-8">	
								<?php if(isset($_POST['event_id'])):?>
								<select name="location" id="location" class="form-control">									
									<option value="<?php echo get_field('location', $_POST['event_id'], true);?>"><?php echo get_field('location', $_POST['event_id'], true);?></option>			
								</select>
								 <?php else:?>
								 <select name="location" id="location" class="form-control validate[required]">									
									<option value="">-- Select location --</option>			
								</select>
								 <?php endif;?>
							</div>
						</div>						 						  
						<div class="form-group">
							<label for="inputdate3" class="col-sm-4 control-label">Start date: </label>
							<div class="col-sm-8">
							<?php if(isset($_POST['event_id'])):?>
								<select name="event_date" id="event_date" class="form-control">
								<?php 
									$count = 1;
									$dates = get_field('dates', $_POST['event_id'], true);
									aasort($dates, 'start_date');
									foreach($dates as $date):
										if(date('Y-m-d') <= $date['start_date']):
										if($count==1):
								?>								
									<option value="<?php echo date('d F Y', strtotime($date['start_date']));?>"><?php echo date('d F Y', strtotime($date['start_date']));?></option>	
								<?php $count++; endif; endif; endforeach; ?>
								</select>
							<?php else:?>
									<select name="event_date" id="event_date" class="form-control">
										<option value="">-- Select course start date --</option>
									</select>
							<?php endif;?>
							</div>
						</div>
						<?php $attending_options = get_field('booking_form_attending_options', 'option');?>
						<?php if(!empty($attending_options)):?>
						<div class="form-group">
							<label for="inputdate3" class="col-sm-4 control-label">Attending: </label>
							<div class="col-sm-8">								
								<select name="attending" id="attending" class="form-control">
									<?php foreach($attending_options as $opts):?>
									<option data-percentage="<?php echo $opts['updated_price'];?>" value="<?php echo $opts['add_options'];?>" <?php echo(isset($_POST['attending']) && $_POST['attending'] == $opts['add_options'])?'selected="selected"':'';?>><?php echo $opts['add_options'];?></option>
									<?php endforeach;?>
								</select>								
							</div>
						</div>
						<?php endif;?>
						<div class="form-group">
							<label for="inputcomment" class="col-sm-4 control-label">Booking Code: </label>
							<div class="col-sm-8">			 
								<input type="text" name="cus_booking_code" id="cus_booking_code" class="form-control" value="<?php echo (isset($_POST['cus_booking_code']))? $_POST['cus_booking_code']:'';?>"/>
							</div>
						</div>
						<div class="form-group">
							<label for="inputlocation3" class="col-sm-4 control-label">Fees due: </label>
							<div class="col-sm-8">	
								<?php if(isset($_POST['event_id'])):?>
								<p id="early_bird">
								<?php echo '$'.str_replace('$', '',get_field('price', $_POST['event_id'], true));?>
								<?php if(strtotime(get_field('early_bird_cut_off_date', $_POST['event_id'], true)) >= strtotime('now')):?>
								<?php echo '{ $'.str_replace('$', '',get_field('early_bird_price', $_POST['event_id'], true)).' Early Bird offer to be paid by: '. date('d F Y', strtotime(get_field('early_bird_cut_off_date', $_POST['event_id'], true))).' }';?>
								<?php endif;?>
								</p>
								<?php else:?>
								<p id="early_bird">Please select a course</p>
								<?php endif;?>
								<input type="hidden" name="actual_price" id="actual_price" value="" />
								<input type="hidden" name="updated_price" id="updated_price" value="" />
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Personal Information</legend>
						<div class="form-group">
							<label for="inputname" class="col-sm-4 control-label">First Name: </label><div class="col-sm-8">						 
							 <input type="text" name="cus_fname" class="form-control validate[required]" value="<?php echo (isset($_POST['cus_fname']))? $_POST['cus_fname']:'';?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="inputname" class="col-sm-4 control-label">Middle Name: </label><div class="col-sm-8">						 
							 <input type="text" name="cus_mname" class="form-control" value="<?php echo (isset($_POST['cus_mname']))? $_POST['cus_mname']:'';?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="inputname" class="col-sm-4 control-label">Last Name: </label><div class="col-sm-8">						 
							 <input type="text" name="cus_lname" class="form-control validate[required]" value="<?php echo (isset($_POST['cus_lname']))? $_POST['cus_lname']:'';?>" />
							</div>
						</div>						
						<div class="form-group">
							<label for="inputname" class="col-sm-4 control-label">Date of Birth: </label><div class="col-sm-8">						 
							 <input type="text" name="cus_dob" id="dob_datepicker" class="form-control validate[required]" value="<?php echo (isset($_POST['cus_dob']))? $_POST['cus_dob']:'';?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="inputname" class="col-sm-4 control-label">Occupation: </label><div class="col-sm-8">						 
							 <input type="text" name="cus_occupation" class="form-control validate[required]" value="<?php echo (isset($_POST['cus_occupation']))? $_POST['cus_occupation']:'';?>" />
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Mailing Address</legend>						
						<div class="form-group">
							<label for="inputname" class="col-sm-4 control-label">Street: </label><div class="col-sm-8">						 
							<input type="text" name="cus_street" class="form-control validate[required]" value="<?php echo (isset($_POST['cus_street']))? $_POST['cus_street']:'';?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="inputname" class="col-sm-4 control-label">Suburb: </label><div class="col-sm-8">						 
							<input type="text" name="cus_suburb" class="form-control validate[required]" value="<?php echo (isset($_POST['cus_suburb']))? $_POST['cus_suburb']:'';?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="inputname" class="col-sm-4 control-label">State: </label><div class="col-sm-8">						 
							<input type="text" name="cus_state" class="form-control validate[required]" value="<?php echo (isset($_POST['cus_state']))? $_POST['cus_state']:'';?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="inputdate3" class="col-sm-4 control-label">Country: </label>
							<div class="col-sm-8">							
								<select name="cus_country" id="cus_country" class="form-control">
									<?php 
										$countries = $wpdb->get_results("SELECT * FROM countries", ARRAY_A);
										foreach($countries as $country):?>
											<option value="<?php echo $country['countryName'];?>" <?php echo ($country['countryName'] == 'Australia')? 'selected="selected"': '';?> <?php echo (isset($_POST['cus_country']) && $country['countryName'] == $_POST['cus_country'])? 'selected="selected"': '';?>><?php echo $country['countryName'];?></option>
									<?php endforeach;?>
								</select>							
							</div>
						</div>
						<div class="form-group">
							<label for="inputname" class="col-sm-4 control-label">Postcode: </label><div class="col-sm-8">						 
							<input type="text" name="cus_postcode" class="form-control validate[required]" value="<?php echo (isset($_POST['cus_postcode']))? $_POST['cus_postcode']:'';?>" />
							</div>
						</div>											
					</fieldset>
					<fieldset>
						<legend>Residential Address</legend>
						<div class="form-group">
							<label for="inputname" class="col-sm-4 control-label"></label><div class="col-sm-8">						 
							<input type="checkbox" name="mailing_equal_res" id="mailing_equal_res" value="1"> Check if mailing address and residential address are same.
							</div>
						</div>
						<div class="form-group">
							<label for="inputname" class="col-sm-4 control-label">Street: </label><div class="col-sm-8">						 
							<input type="text" name="cus_resstreet" class="form-control validate[required]" value="<?php echo (isset($_POST['cus_resstreet']))? $_POST['cus_resstreet']:'';?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="inputname" class="col-sm-4 control-label">Suburb: </label><div class="col-sm-8">						 
							<input type="text" name="cus_ressuburb" class="form-control validate[required]" value="<?php echo (isset($_POST['cus_ressuburb']))? $_POST['cus_ressuburb']:'';?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="inputname" class="col-sm-4 control-label">State: </label><div class="col-sm-8">						 
							<input type="text" name="cus_resstate" class="form-control validate[required]" value="<?php echo (isset($_POST['cus_resstate']))? $_POST['cus_resstate']:'';?>" />
							</div>
						</div>
						<div class="form-group">
							<label for="inputdate3" class="col-sm-4 control-label">Country: </label>
							<div class="col-sm-8">							
								<select name="cus_rescountry" id="cus_rescountry" class="form-control">
									<?php 
										$countries = $wpdb->get_results("SELECT * FROM countries", ARRAY_A);
										foreach($countries as $country):?>
											<option value="<?php echo $country['countryName'];?>" <?php echo ($country['countryName'] == 'Australia')? 'selected="selected"': '';?> <?php echo (isset($_POST['cus_rescountry']) && $country['countryName'] == $_POST['cus_rescountry'])? 'selected="selected"': '';?>><?php echo $country['countryName'];?></option>
									<?php endforeach;?>
								</select>							
							</div>
						</div>
						<div class="form-group">
							<label for="inputname" class="col-sm-4 control-label">Postcode: </label><div class="col-sm-8">						 
							<input type="text" name="cus_respostcode" class="form-control validate[required]" value="<?php echo (isset($_POST['cus_respostcode']))? $_POST['cus_respostcode']:'';?>" />
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Conatct Information</legend>
						<div class="form-group">
							<label for="inputemail" class="col-sm-4 control-label">Email: </label><div class="col-sm-8">					 
							<input type="email" name="cus_email" class="form-control validate[required, custom[email]]" value="<?php echo (isset($_POST['cus_email']))? $_POST['cus_email']:'';?>"/>
							</div>
						</div>
						<div class="form-group">
							<label for="inputphone" class="col-sm-4 control-label">Phone: </label><div class="col-sm-2">				 
							 <input type="tel" name="cus_countryCode" placeholder="Country code" class="form-control validate[required]" value="<?php echo (isset($_POST['cus_countryCode']))? $_POST['cus_countryCode']:'';?>" />
							</div>
							<div class="col-sm-2">				 
							 <input type="tel" name="cus_areaCode" class="form-control" placeholder="Area code" value="<?php echo (isset($_POST['cus_areaCode']))? $_POST['cus_areaCode']:'';?>" />
							</div>
							<div class="col-sm-4">				 
							 <input type="tel" name="cus_phone" placeholder="Number" class="form-control validate[required]" value="<?php echo (isset($_POST['cus_phone']))? $_POST['cus_phone']:'';?>" />
							</div>
						</div>
					</fieldset>
					<fieldset>
						<legend>Other Information</legend>
						<div class="form-group">
							<label for="inputcomment" class="col-sm-4 control-label">Comment: </label><div class="col-sm-8">				 
							 <textarea rows="4" name="cus_comment" class="form-control" ><?php echo (isset($_POST['cus_comment']))? $_POST['cus_comment']:'';?></textarea>
							</div>
						</div>
						<?php $how_options = get_field('how_did_you_hear_about_us', 'option');?>
							<?php if(!empty($how_options)):?>
							<div class="form-group">
								<label for="inputdate3" class="col-sm-4 control-label">How did you hear about us? </label>
								<div class="col-sm-8">									
									<select name="how_options" id="how_options" class="form-control">
										<?php foreach($how_options as $opts):?>
										<option value="<?php echo $opts['add_options'];?>" <?php echo(isset($_POST['how_options']) && $_POST['how_options'] == $opts['add_options'])?'selected="selected"':'';?>><?php echo $opts['add_options'];?></option>
										<?php endforeach;?>
									</select>									
								</div>
							</div>
						<?php endif;?>						
						<div class="form-group">
							<label for="inputcomment" class="col-sm-4 control-label">Terms and Conditions: </label><div class="col-sm-8">
							<?php if(isset($_POST['event_id'])):?>
								<textarea rows="4" name="cus_term" id="cus_term" class="form-control" readonly><?php echo (get_field('terms_and_conditions', $_POST['event_id'], true) <> '')?get_field('terms_and_conditions', $_POST['event_id'], true):get_field('terms_and_conditions', 'option');?></textarea>
							<?php else:?>
								<textarea rows="4" name="cus_term" id="cus_term" class="form-control" readonly><?php echo get_field('terms_and_conditions', 'option');?></textarea>
							<?php endif;?>
							</div>
						</div>
						<div class="form-group">
							<label for="inputname" class="col-sm-4 control-label"></label><div class="col-sm-8">						 
							<input type="checkbox" name="read_and_agreed" id="read_and_agreed" value="1" class="validate[required]"> Read and Agreed
							</div>
						</div>
						<div class="form-group">
							<label for="inputcomment" class="col-sm-4 control-label">Security Code</label>
							<div class="col-sm-2">				 
								<img src="<?php echo get_template_directory_uri();?>/captcha/CaptchaSecurityImages.php?width=100&height=40&characters=5" />
							</div>
							<div class="col-sm-6">				 
								<input id="security_code" name="security_code" type="text" class="form-control validate[required]"/>
							</div>
						</div>
					</fieldset>
                    <div class="form-group">
                        <div class="col-sm-offset-4 col-sm-8">
                          <input type="submit" name="book_now" value="Book Now" class="btn"/>
                        </div>
                    </div>
                </div>
                </form>					
            </div>				
		</section>
	</section> <!-- #main -->
</section> <!-- #main-container -->
<?php get_footer(); ?>