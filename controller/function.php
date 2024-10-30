<?php
//function for get events from constant contact
function cies_getEvents($url)
{
	$ch1 = curl_init ($url);
			
	curl_setopt ($ch1, CURLOPT_RETURNTRANSFER, true);
	curl_setopt ($ch1, CURLOPT_SSL_VERIFYPEER, false);	
	curl_setopt($ch1,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
	
	$returndata2 = curl_exec ($ch1);
	
	$curl_errno = curl_errno($ch1);
	
	$curl_error = curl_error($ch1);
	
	curl_close($ch1);

		if ($curl_errno > 0) {

				echo "cURL Error ($curl_errno): $curl_error\n";
				
		} else {

		}

	$fetch = json_decode($returndata2,true);
	
	return $fetch;
}



// delete event API call
function cies_deleteEvents($url,$request,$method)
{
	$ch1 = curl_init ($url);
			
	curl_setopt ($ch1, CURLOPT_RETURNTRANSFER, true);
	curl_setopt ($ch1, CURLOPT_SSL_VERIFYPEER, false);	
	curl_setopt($ch1,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
	curl_setopt($ch1, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: OAuth 2.0 token here"));
	curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, $method);
	curl_setopt($ch1, CURLOPT_POST, 1);
	curl_setopt($ch1, CURLOPT_POSTFIELDS, $request);
	
	$returndata2 = curl_exec ($ch1);
	
	$curl_errno = curl_errno($ch1);
	
	$curl_error = curl_error($ch1);
	
	curl_close($ch1);

		if ($curl_errno > 0) {

				echo "cURL Error ($curl_errno): $curl_error\n";
				
		} else {

		}
	
	return $returndata2;
}


// create event API call
function cies_createEvents($url,$request,$method)
{
	$ch1 = curl_init ($url);
			
	curl_setopt ($ch1, CURLOPT_RETURNTRANSFER, true);
	curl_setopt ($ch1, CURLOPT_SSL_VERIFYPEER, false);	
	curl_setopt($ch1,  CURLOPT_USERAGENT , "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.1)");
	curl_setopt($ch1, CURLOPT_HTTPHEADER, array("Content-Type: application/json","Authorization: OAuth 2.0 token here"));
	curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, $method);
	curl_setopt($ch1, CURLOPT_POST, 1);
	curl_setopt($ch1, CURLOPT_POSTFIELDS, $request);
	
	$returndata2 = curl_exec ($ch1);
	
	$curl_errno = curl_errno($ch1);
	
	$curl_error = curl_error($ch1);
	
	curl_close($ch1);

		if ($curl_errno > 0) {

				echo "cURL Error ($curl_errno): $curl_error\n";
				
		} else {

		}
	
	return $returndata2;
}

// Delete Event with ajax
add_action( 'wp_ajax_cies_delete_event', 'cies_delete_event_callback' );
function cies_delete_event_callback() {
	global $wpdb; 
	
	$delete_request = array(
		array("op" => "REPLACE",
		"path" => "#/status",
		"value" => "CANCELLED")
		); 

	$event_id = intval( $_POST['event_id'] );
	if ( ! $event_id )
	{
	  $event_id = '';
	}
	
	$access_token_option = "constant_contact_access_token";	
	$access_token = get_option( $access_token_option );

	$api_key_option = "constant_contact_api_key";	
	$api_key = get_option( $api_key_option );
	
	$url="https://api.constantcontact.com/v2/eventspot/events/$event_id?api_key=$api_key&access_token=$access_token";
	echo cies_deleteEvents($url,json_encode($delete_request),'PATCH');	

	wp_die();
}


// Publish Event with ajax
add_action( 'wp_ajax_cies_publish_event', 'cies_publish_event_callback' );
function cies_publish_event_callback() {
	global $wpdb; 
	
	$delete_request = array(
		array("op" => "REPLACE",
		"path" => "#/status",
		"value" => "ACTIVE")
		); 

	$event_id = intval( $_POST['event_id'] );
		if ( ! $event_id ) {
		  $event_id = '';
		}
	
	$access_token_option = "constant_contact_access_token";	
	$access_token = get_option( $access_token_option );

	$api_key_option = "constant_contact_api_key";	
	$api_key = get_option( $api_key_option );
	
	$url="https://api.constantcontact.com/v2/eventspot/events/$event_id?api_key=$api_key&access_token=$access_token";
	echo cies_deleteEvents($url,json_encode($delete_request),'PATCH');	

	wp_die();
}



// Add Event 
add_action( 'wp_ajax_cies_add_event', 'cies_add_event_callback' );
function cies_add_event_callback() {
	global $wpdb; 
	if(isset($_POST['title']) && !empty($_POST['title']))
	{
		$event_title = sanitize_text_field($_POST['title']);
	}
	else
	{
		$event_title='N/A';
	}
	
	if(isset($_POST['name']) && !empty($_POST['name']))
	{
		$event_name = sanitize_text_field($_POST['name']);
	}
	else
	{
		$event_name='N/A';
	}
	
	if(isset($_POST['type']) &&  !empty($_POST['type']))
	{
		$event_type = sanitize_text_field($_POST['type']);
	}
	else
	{
		$event_type='N/A';
	}
	
	if(isset($_POST['description']) && !empty($_POST['description']))
	{
		$event_detail = sanitize_text_field($_POST['description']);
	}
	else
	{
		$event_detail='N/A';
	}
	
	if(isset($_POST['start_date']) && !empty($_POST['start_date']))
	{
		$event_date =  sanitize_text_field($_POST['start_date']);
	}
	else
	{
		$event_date='N/A';
	}
	
	if(isset($_POST['event_startHour']) && !empty($_POST['event_startHour']))
	{
		$event_startHour = sanitize_text_field($_POST['event_startHour']);
	}
	else
	{
		$event_startHour='N/A';
	}
	
	if(isset($_POST['event_startMin']) &&  !empty($_POST['event_startMin']))
	{
		$event_startMin = sanitize_text_field($_POST['event_startMin']);
	}
	else
	{
		$event_startMin='N/A';
	}
	
	if(isset($_POST['event_startAm']) && !empty($_POST['event_startAm']))
	{
		$event_startAm = sanitize_text_field($_POST['event_startAm']);
	}
	else
	{
		$event_startAm='N/A';
	}
	
	if(isset($_POST['end_date']) && !empty($_POST['end_date']))
	{
		$event_end_date = sanitize_text_field($_POST['end_date']);
	}
	else
	{
		$event_end_date='N/A';
	}
	
	if(isset($_POST['event_endHour']) && !empty($_POST['event_endHour']))
	{
		$event_endHour = sanitize_text_field($_POST['event_endHour']);
	}
	else
	{
		$event_endHour='N/A';
	}
	
	if(isset($_POST['event_endMin']) && $_POST['event_endMin']!='')
	{
		$event_endMin = sanitize_text_field($_POST['event_endMin']);
	}
	else
	{
		$event_endMin='N/A';
	}
	
	if(isset($_POST['event_endAm']) && $_POST['event_endAm']!='')
	{
		$event_endAm = sanitize_text_field($_POST['event_endAm']);
	}
	else
	{
		$event_endAm='N/A';
	}
	
	if(isset($_POST['event_TimeZone']) && $_POST['event_TimeZone']!='')
	{
		$event_TimeZone = sanitize_text_field($_POST['event_TimeZone']);
	}
	else
	{
		$event_TimeZone='N/A';
	}
	
	if(isset($_POST['event_TimeZone_abr']) && $_POST['event_TimeZone_abr']!='')
	{
		$event_TimeZone_abr = sanitize_text_field($_POST['event_TimeZone_abr']);
	}
	else
	{
		$event_TimeZone_abr='N/A';
	}
	
	
	if(isset($_POST['event_location']) && $_POST['event_location']!='')
	{
		$event_location = sanitize_text_field($_POST['event_location']);
	}
	else
	{
		$event_location='N/A';
	}
	
	if(isset($_POST['event_address1']) && $_POST['event_address1']!='')
	{
		$event_address1 = sanitize_text_field($_POST['event_address1']);
	}
	else
	{
		$event_address1='N/A';
	}
	
	if(isset($_POST['event_address2']) && $_POST['event_address2']!='')
	{
		$event_address2 = sanitize_text_field($_POST['event_address2']);
	}
	else
	{
		$event_address2='N/A';
	}
	
	if(isset($_POST['event_address3']) && $_POST['event_address3']!='')
	{
		$event_address3 = sanitize_text_field($_POST['event_address3']);
	}
	else
	{
		$event_address3='N/A';
	}
	
	if(isset($_POST['event_city']) && $_POST['event_city']!='')
	{
		$event_city = sanitize_text_field($_POST['event_city']);
	}
	else
	{
		$event_city='NA';
	}
	
	if(isset($_POST['countryCode']) && $_POST['countryCode']!='')
	{
		$countryCode = sanitize_text_field($_POST['countryCode']);
	}
	else
	{
		$countryCode='NA';
	}
	
	if(isset($_POST['event_postal_code']) && $_POST['event_postal_code']!='')
	{
		$event_postal_code = intval( $_POST['event_postal_code'] );
		if ( ! $event_postal_code )
		{
		  $event_postal_code = '';
		}
	}
	else
	{
		$event_postal_code='NA';
	}
	
	
	if(isset($_POST['event_contact_name']) && $_POST['event_contact_name']!='')
	{
		$event_contact_name = sanitize_text_field($_POST['event_contact_name']);
	}
	else
	{
		$event_contact_name='NA';
	}
	
	
	if(isset($_POST['event_contact_email']) && $_POST['event_contact_email']!='')
	{
		$event_contact_email = sanitize_email($_POST['event_contact_email']);
	}
	else
	{
		$event_contact_email='NA';
	}
	
	if(isset($_POST['event_contact_phone']) && $_POST['event_contact_phone']!='')
	{
		$event_contact_phone = intval( $_POST['event_contact_phone'] );
		if ( ! $event_contact_phone ) {
		  $event_contact_phone = '';
		}
	}
	else
	{
		$event_contact_phone='NA';
	}
	
	if(isset($_POST['event_contact_organization']) && $_POST['event_contact_organization']!='')
	{
		$event_contact_organization = sanitize_text_field($_POST['event_contact_organization']);
	}
	else
	{
		$event_contact_organization='NA';
	}
	
	$event_state = '';
	$country = '';
	$state_code = '';
	
	$event_time_zone = $event_TimeZone; 
	
	
	$create_request = array(
		'name' => trim($event_name),
		'title' => trim($event_title),
		'location' => trim($event_location),
		'type' => $event_type,
		'address' => array(
			'city' => trim($event_city),
			'state' => $event_state,
			'country' => $country,	
			'line1' => trim($event_address1),
			'line2' => trim($event_address2),
			'state_code' => $state_code,
			'country_code' => $countryCode,
			'postal_code' => $event_postal_code
		),
		'description' => trim($event_detail),
		'contact' => array(
			'name' => $event_contact_name,
			'email_address' => $event_contact_email,
			'phone_number' => $event_contact_phone,
			'organization_name' => trim($event_contact_organization)
		),
		'start_date' => trim($event_date."T".$event_startHour.":".$event_startMin.":00".$event_time_zone),
		'end_date' => trim($event_end_date."T".$event_endHour.":".$event_endMin.":00".$event_time_zone),
		'time_zone_id' => $event_TimeZone_abr,
		'is_checkin_available' => false,
		'theme_name' => 'Default',
		'currency_type' => 'USD',
		'is_virtual_event' => false,
		'notification_options' => array(array(
			'notification_type' => 'SO_REGISTRATION_NOTIFICATION',
			'is_opted_in' => true)
		),
		'is_home_page_displayed' => false,
		'is_map_displayed' => true,
		'is_calendar_displayed' => true,
		'is_listed_in_external_directory' => false,
		'are_registrants_public' => false,
		'track_information' => array(
			'information_sections' => array(
			"CONTACT",
			"TIME",
			"LOCATION"
			),
			'is_registration_closed_manually' => false,
			'is_ticketing_link_displayed' => false,
			'guest_limit' => 0,
			'registration_limit_count' => 0,
			'guest_display_label' => 'Guest(s)',
			'is_guest_name_required' => false,
			'is_guest_anonymous_enabled' => false
			)
	);
	
 
	
	$access_token_option = "constant_contact_access_token";	
	$access_token = get_option( $access_token_option );

	$api_key_option = "constant_contact_api_key";	
	$api_key = get_option( $api_key_option );
	
	$url="https://api.constantcontact.com/v2/eventspot/events?api_key=$api_key&access_token=$access_token";
	echo cies_createEvents($url,json_encode($create_request),'POST');	

	wp_die();
}


// Edit Event 
add_action( 'wp_ajax_cies_edit_event', 'cies_edit_event_callback' );
function cies_edit_event_callback() {
	global $wpdb; 
	
	if(isset($_POST['event_id']) && $_POST['event_id']!='')
	{
		$event_id = intval( $_POST['event_id'] );
		if ( ! $event_id )
		{
		  $event_id = '';
		}
	}	
	
	if(isset($_POST['title']) && $_POST['title']!='')
	{
		$event_title = sanitize_text_field($_POST['title']);
	}
	else
	{
		$event_title='N/A';
	}
	
	if(isset($_POST['name']) && $_POST['name']!='')
	{
		$event_name = sanitize_text_field($_POST['name']);
	}
	else
	{
		$event_name='N/A';
	}
	
	if(isset($_POST['type']) && $_POST['type']!='')
	{
		$event_type = sanitize_text_field($_POST['type']);
	}
	else
	{
		$event_type='N/A';
	}
	
	if(isset($_POST['description']) && $_POST['description']!='')
	{
		$event_detail = sanitize_text_field($_POST['description']);
	}
	else
	{
		$event_detail='N/A';
	}
	
	if(isset($_POST['start_date']) && $_POST['start_date']!='')
	{
		$event_date = sanitize_text_field($_POST['start_date']);
	}
	else
	{
		$event_date='N/A';
	}
	
	if(isset($_POST['event_startHour']) && $_POST['event_startHour']!='')
	{
		$event_startHour = sanitize_text_field($_POST['event_startHour']);
	}
	else
	{
		$event_startHour='N/A';
	}
	
	if(isset($_POST['event_startMin']) && $_POST['event_startMin']!='')
	{
		$event_startMin = sanitize_text_field($_POST['event_startMin']);
	}
	else
	{
		$event_startMin='N/A';
	}
	
	if(isset($_POST['event_startAm']) && $_POST['event_startAm']!='')
	{
		$event_startAm = sanitize_text_field($_POST['event_startAm']);
	}
	else
	{
		$event_startAm='N/A';
	}
	
	if(isset($_POST['end_date']) && $_POST['end_date']!='')
	{
		$event_end_date = sanitize_text_field($_POST['end_date']);
	}
	else
	{
		$event_end_date='N/A';
	}
	
	if(isset($_POST['event_endHour']) && $_POST['event_endHour']!='')
	{
		$event_endHour = sanitize_text_field($_POST['event_endHour']);
	}
	else
	{
		$event_endHour='N/A';
	}
	
	if(isset($_POST['event_endMin']) && $_POST['event_endMin']!='')
	{
		$event_endMin = sanitize_text_field($_POST['event_endMin']);
	}
	else
	{
		$event_endMin='N/A';
	}
	
	if(isset($_POST['event_endAm']) && $_POST['event_endAm']!='')
	{
		$event_endAm = sanitize_text_field($_POST['event_endAm']);
	}
	else
	{
		$event_endAm='N/A';
	}
	
	if(isset($_POST['event_TimeZone']) && $_POST['event_TimeZone']!='')
	{
		$event_TimeZone = sanitize_text_field($_POST['event_TimeZone']);
	}
	else
	{
		$event_TimeZone='N/A';
	}
	
	if(isset($_POST['event_TimeZone_abr']) && $_POST['event_TimeZone_abr']!='')
	{
		$event_TimeZone_abr = sanitize_text_field($_POST['event_TimeZone_abr']);
	}
	else
	{
		$event_TimeZone_abr='N/A';
	}
	
	
	if(isset($_POST['event_location']) && $_POST['event_location']!='')
	{
		$event_location = sanitize_text_field($_POST['event_location']);
	}
	else
	{
		$event_location='N/A';
	}
	
	if(isset($_POST['event_address1']) && $_POST['event_address1']!='')
	{
		$event_address1 = sanitize_text_field($_POST['event_address1']);
	}
	else
	{
		$event_address1='N/A';
	}
	
	if(isset($_POST['event_address2']) && $_POST['event_address2']!='')
	{
		$event_address2 = sanitize_text_field($_POST['event_address2']);
	}
	else
	{
		$event_address2='N/A';
	}
	
	if(isset($_POST['event_address3']) && $_POST['event_address3']!='')
	{
		$event_address3 = sanitize_text_field($_POST['event_address3']);
	}
	else
	{
		$event_address3='N/A';
	}
	
	if(isset($_POST['event_city']) && $_POST['event_city']!='')
	{
		$event_city = sanitize_text_field($_POST['event_city']);
	}
	else
	{
		$event_city='NA';
	}
	
	if(isset($_POST['countryCode']) && $_POST['countryCode']!='')
	{
		$countryCode = sanitize_text_field($_POST['countryCode']);
	}
	else
	{
		$countryCode='NA';
	}
	
	if(isset($_POST['event_postal_code']) && $_POST['event_postal_code']!='')
	{
		$event_postal_code = sanitize_text_field($_POST['event_postal_code']);
	}
	else
	{
		$event_postal_code='NA';
	}
	
	
	if(isset($_POST['event_contact_name']) && $_POST['event_contact_name']!='')
	{
		$event_contact_name = sanitize_text_field($_POST['event_contact_name']);
	}
	else
	{
		$event_contact_name='NA';
	}
	
	
	if(isset($_POST['event_contact_email']) && $_POST['event_contact_email']!='')
	{
		$event_contact_email = sanitize_email($_POST['event_contact_email']);
	}
	else
	{
		$event_contact_email='NA';
	}
	
	if(isset($_POST['event_contact_phone']) && $_POST['event_contact_phone']!='')
	{
		$event_contact_phone = intval( $_POST['event_contact_phone'] );
		if ( ! $event_contact_phone ) {
		  $event_contact_phone = '';
		}
	}
	else
	{
		$event_contact_phone='NA';
	}
	
	if(isset($_POST['event_contact_organization']) && $_POST['event_contact_organization']!='')
	{
		$event_contact_organization = sanitize_text_field($_POST['event_contact_organization']);
	}
	else
	{
		$event_contact_organization='NA';
	}
	
	$event_state = '';
	$country = '';
	$state_code = '';
	
	$event_time_zone = $event_TimeZone; 
	
	
	$create_request = array(
		'name' => trim($event_name),
		'title' => trim($event_title),
		'location' => trim($event_location),
		'type' => $event_type,
		'address' => array(
			'city' => trim($event_city),
			'state' => $event_state,
			'country' => $country,	
			'line1' => trim($event_address1),
			'line2' => trim($event_address2),
			'state_code' => $state_code,
			'country_code' => $countryCode,
			'postal_code' => $event_postal_code
		),
		'description' => trim($event_detail),
		'contact' => array(
			'name' => $event_contact_name,
			'email_address' => $event_contact_email,
			'phone_number' => $event_contact_phone,
			'organization_name' => trim($event_contact_organization)
		),
		'start_date' => trim($event_date."T".$event_startHour.":".$event_startMin.":00".$event_time_zone),
		'end_date' => trim($event_end_date."T".$event_endHour.":".$event_endMin.":00".$event_time_zone),
		'time_zone_id' => $event_TimeZone_abr,
		'is_checkin_available' => false,
		'theme_name' => 'Default',
		'currency_type' => 'USD',
		'is_virtual_event' => false,
		'notification_options' => array(array(
			'notification_type' => 'SO_REGISTRATION_NOTIFICATION',
			'is_opted_in' => true)
		),
		'is_home_page_displayed' => false,
		'is_map_displayed' => true,
		'is_calendar_displayed' => true,
		'is_listed_in_external_directory' => false,
		'are_registrants_public' => false,
		'track_information' => array(
			'information_sections' => array(
			"CONTACT",
			"TIME",
			"LOCATION"
			),
			'is_registration_closed_manually' => false,
			'is_ticketing_link_displayed' => false,
			'guest_limit' => 0,
			'registration_limit_count' => 0,
			'guest_display_label' => 'Guest(s)',
			'is_guest_name_required' => false,
			'is_guest_anonymous_enabled' => false
			)
	);
	
 
	
	$access_token_option = "constant_contact_access_token";	
	$access_token = get_option( $access_token_option );

	$api_key_option = "constant_contact_api_key";	
	$api_key = get_option( $api_key_option );
	
	$url="https://api.constantcontact.com/v2/eventspot/events/$event_id?api_key=$api_key&access_token=$access_token";
	echo cies_createEvents($url,json_encode($create_request),'PUT');	

	wp_die();
}
?>