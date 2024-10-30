// function for add events to constant contact account
function add_events_form()
{
	jQuery('#add_event_div').toggle('slow');
	var anchor_txt = jQuery('#create_event_link').text();
	if(anchor_txt='Create Event')
	{
		jQuery('#create_event_link').text('Close');
	}	
	if(anchor_txt='Close')
	{
		jQuery('#create_event_link').text('Create Event');
	}

}

function es_close_event_form()
{
	jQuery('#add_event_div').hide('slow');
}

function es_add_event()
{
	var title = jQuery('#event_title').val();	
	if(title=='' || title.length==0)
	{
		jQuery('#event_title_error').removeClass('event-error').addClass('event-error-show');
		jQuery('#event_title').focus();
		return false;
	}
	else
	{
		jQuery('#event_title_error').addClass('event-error').removeClass('event-error-show');
	}
	
	var name = jQuery('#event_name').val();	
	if(name=='' || name.length==0)
	{
		jQuery('#event_name_error').removeClass('event-error').addClass('event-error-show');
		jQuery('#event_name').focus();
		return false;
	}
	else
	{
		jQuery('#event_name_error').addClass('event-error').removeClass('event-error-show');
	}
	
	var type = jQuery('#event_type').val();	
	if(type=='' || type.length==0)
	{
		jQuery('#event_type_error').removeClass('event-error').addClass('event-error-show');
		jQuery('#event_type').focus();
		return false;
	}
	else
	{
		jQuery('#event_type_error').addClass('event-error').removeClass('event-error-show');
	}
	
	var description = jQuery('#event_description').val();	
	
	var start_date = jQuery('#start_date').val();	
	if(start_date=='' || start_date.length==0)
	{
		jQuery('#start_date_error').removeClass('event-error').addClass('event-error-show');
		jQuery('#start_date').focus();
		return false;
	}
	else
	{
		jQuery('#start_date_error').addClass('event-error').removeClass('event-error-show');
	}
	
	var event_startHour = jQuery('#event_startHour').val();	
	var event_startMin = jQuery('#event_startMin').val(); 
	var event_startAm = jQuery('input[name=event_startAm]:checked').val();
	if(event_startHour==0)
	{
		jQuery('#start_hour_error').removeClass('event-error').addClass('event-error-show');
		jQuery('#event_startHour').focus();
		return false;
	} 
	else
	{
		jQuery('#start_hour_error').addClass('event-error').removeClass('event-error-show');
	}
	
	if(event_startMin==0)
	{
		jQuery('#start_min_error').removeClass('event-error').addClass('event-error-show');
		jQuery('#event_startMin').focus();
		return false;
	} 
	else
	{
		jQuery('#start_min_error').addClass('event-error').removeClass('event-error-show');
	}
	
	if(typeof event_startAm === 'undefined')
	{
		jQuery('#start_ampm_error').removeClass('event-error').addClass('event-error-show');
		jQuery('#event_startAm').focus();
		return false;
	} 
	else
	{
		jQuery('#start_ampm_error').addClass('event-error').removeClass('event-error-show');
	}
	
	var end_date = jQuery('#end_date').val();	
	if(end_date=='' || end_date.length==0)
	{
		jQuery('#end_date_error').removeClass('event-error').addClass('event-error-show');
		jQuery('#end_date').focus();
		return false;
	}
	else
	{
		jQuery('#end_date_error').addClass('event-error').removeClass('event-error-show');
	}
	
	//end date
	var event_endHour = jQuery('#event_endHour').val();	
	var event_endMin = jQuery('#event_endMin').val(); 
	var event_endAm = jQuery('input[name=event_endAm]:checked').val();
	if(event_endHour==0)
	{
		jQuery('#end_hour_error').removeClass('event-error').addClass('event-error-show');
		jQuery('#event_endHour').focus();
		return false;
	} 
	else
	{
		jQuery('#end_hour_error').addClass('event-error').removeClass('event-error-show');
	}
	
	if(event_endMin==0)
	{
		jQuery('#end_min_error').removeClass('event-error').addClass('event-error-show');
		jQuery('#event_endMin').focus();
		return false;
	} 
	else
	{
		jQuery('#end_min_error').addClass('event-error').removeClass('event-error-show');
	}
	
	if(typeof event_endAm === 'undefined')
	{
		jQuery('#end_ampm_error').removeClass('event-error').addClass('event-error-show');
		jQuery('#event_endAm').focus();
		return false;
	} 
	else
	{
		jQuery('#end_ampm_error').addClass('event-error').removeClass('event-error-show');
	}
	
	var select_event_TimeZone_arr = jQuery('#select_event_TimeZone').val().split('_');
	
	var select_event_TimeZone = select_event_TimeZone_arr[0];
	var event_TimeZone_abr = select_event_TimeZone_arr[1];
	
	var event_location = jQuery('#event_location').val();	
	if(event_location=='' || event_location.length==0)
	{
		jQuery('#event_location_error').removeClass('event-error').addClass('event-error-show');
		jQuery('#event_location').focus();
		return false;
	}
	else
	{
		jQuery('#event_location_error').addClass('event-error').removeClass('event-error-show');
	}
	
	var event_address1 = jQuery('#event_address1').val();
	var event_address2 = jQuery('#event_address2').val();
	var event_address3 = jQuery('#event_address3').val();
	var event_city = jQuery('#event_city').val();
	var countryCode = jQuery('#countryCode').val();
	var event_postal_code = jQuery('#event_postal_code').val();
	
	var event_contact_name = jQuery('#event_contact_name').val();	
	if(event_contact_name=='' || event_contact_name.length==0)
	{
		jQuery('#event_contact_name_error').removeClass('event-error').addClass('event-error-show');
		jQuery('#event_contact_name').focus();
		return false;
	}
	else
	{
		jQuery('#event_contact_name_error').addClass('event-error').removeClass('event-error-show');
	}
	
	var event_contact_email = jQuery('#event_contact_email').val();	
	if(event_contact_email=='' || event_contact_email.length==0)
	{
		jQuery('#event_contact_email_error').removeClass('event-error').addClass('event-error-show');
		jQuery('#event_contact_email').focus();
		return false;
	}
	else
	{
		jQuery('#event_contact_email_error').addClass('event-error').removeClass('event-error-show');
	}
	
	var event_contact_phone = jQuery('#event_contact_phone').val();	
	if(event_contact_phone=='' || event_contact_phone.length==0)
	{
		jQuery('#event_contact_phone_error').removeClass('event-error').addClass('event-error-show');
		jQuery('#event_contact_phone').focus();
		return false;
	}
	else
	{
		jQuery('#event_contact_phone_error').addClass('event-error').removeClass('event-error-show');
	}
	
	var event_contact_organization = jQuery('#event_contact_organization').val();
	
	var update_event = jQuery('#update_event').val();
	var event_id = jQuery('#event_id').val();
	
	if(update_event==1)
	{
		// update event
		var data = {
			'action': 'cies_edit_event',
			'event_id' : event_id,
			'title': title,
			'name': name,
			'type':type,
			'description' : description,
			'start_date':start_date,
			'event_startHour':event_startHour,
			'event_startMin' : event_startMin,
			'event_startAm' : event_startAm,
			'end_date':end_date,
			'event_endHour' :event_endHour,
			'event_endMin' : event_endMin,
			'event_endAm' : event_endAm,
			'event_TimeZone' : select_event_TimeZone,
			'event_TimeZone_abr' : event_TimeZone_abr,
			'event_location' : event_location,
			'event_address1' : event_address1,
			'event_address2' : event_address2,
			'event_address3' : event_address3,
			'event_city' : event_city,
			'countryCode' : countryCode,
			'event_postal_code' : event_postal_code,
			'event_contact_name' : event_contact_name,
			'event_contact_email' : event_contact_email,
			'event_contact_phone' : event_contact_phone,
			'event_contact_organization' : event_contact_organization		
					
		}; 
		jQuery.post(ajaxurl, data, function(response) {
			jQuery('#success_msg').removeClass('isa_success').addClass('isa_success_show');
		},'JSON');
	}
	else
	{
	// Add event ajax call to php function
	jQuery('#add_event_btn').text('processing...');
	var data = {
			'action': 'cies_add_event',
			'title': title,
			'name': name,
			'type':type,
			'description' : description,
			'start_date':start_date,
			'event_startHour':event_startHour,
			'event_startMin' : event_startMin,
			'event_startAm' : event_startAm,
			'end_date':end_date,
			'event_endHour' :event_endHour,
			'event_endMin' : event_endMin,
			'event_endAm' : event_endAm,
			'event_TimeZone' : select_event_TimeZone,
			'event_TimeZone_abr' : event_TimeZone_abr,
			'event_location' : event_location,
			'event_address1' : event_address1,
			'event_address2' : event_address2,
			'event_address3' : event_address3,
			'event_city' : event_city,
			'countryCode' : countryCode,
			'event_postal_code' : event_postal_code,
			'event_contact_name' : event_contact_name,
			'event_contact_email' : event_contact_email,
			'event_contact_phone' : event_contact_phone,
			'event_contact_organization' : event_contact_organization		
					
		}; 
	jQuery.post(ajaxurl, data, function(response) {
		if(typeof response.id === 'undefined')
		{
			if(response[0].error_message!='')
			{
				jQuery('#success_msg').removeClass('isa_error').addClass('isa_error_show');
				jQuery('#success_msg').html(response[0].error_message);
			}			
		}
		else
		{
			jQuery('#es_success').removeClass('isa_success').addClass('isa_success_show');
			var plugin_url = jQuery('#plugin_url').val();
			var es_start_date = response.start_date.split("T");
			var es_date = es_start_date[0].split("-");
			var dynamic_html = '<tr id="event_id_'+response.id+'"><td width="300px">'+response.title+'</td><td>'+es_date[0]+"-"+es_date[1]+"-"+es_date[2]+'</td><td><span style="color:#000;" id="draft_status_'+response.id+'">'+response.status+'</span></td><td><ul><li><a href="http://www.facebook.com/sharer/sharer.php?u='+response.registration_url+'" target="_blank" title="share on facebook"><img src="'+plugin_url+'fb_share.png" alt="share on facebook" title="share on facebook"></a></li><li><a href="http://plus.google.com/share?url='+response.registration_url+'" target="_blank" title="share on google plus"><img src="'+plugin_url+'google-share.png" alt="share on google plus" title="share on google plus"></a></li><li><a href="http://twitter.com/share?url='+response.registration_url+'" target="_blank" title="share on Twitter"><img src="'+plugin_url+'twitter_share.png" alt="share on facebook" title="share on facebook"></a></li></ul></td><td><a class="es-edit-btn" href="?page=es_update_event&amp;event_id='+response.id+'">Edit</a><a class="es-draft-btn" id="draft_btn_'+response.id+'" title="click to publish this event" onclick=es_publish_event("'+response.id+'") >DRAFT</a></td></tr>';
			
			jQuery('#manage_event_table').append(dynamic_html);
			jQuery("#es_success").delay(3200).fadeOut(300);
		}
		
		jQuery('#add_event_btn').text('Add Event');
		jQuery('#add_event_div').hide('slow');
		
	},'JSON');	
	
	} // else closed
	
	
	
}

function es_edit_event(event_id)
{
	jQuery('#edit_event_div_'+event_id).addClass('es_edit_event_show').removeClass('es_edit_event');
	jQuery('#create_event_link').hide();
}

function es_edit_event_close(event_id)
{
	jQuery('#edit_event_div_'+event_id).removeClass('es_edit_event_show').addClass('es_edit_event');
}	

// cancel an event
function es_delete_event(event_id)
{
	if(confirm('Are you sure want to cancel this event ?')==true)
	{
			var data = {
				'action': 'cies_delete_event',
				'event_id': event_id
			}; 
		jQuery.post(ajaxurl, data, function(response) {
			jQuery('a#publish_btn_'+response.id).removeClass('es-green-btn').addClass('es-del-btn');
			jQuery('a#publish_btn_'+response.id).text('Canceled');
			jQuery('a#draft_btn_'+response.id).removeClass('es-green-btn').addClass('es-del-btn');
			jQuery('a#draft_btn_'+response.id).text('Canceled');
			jQuery('#active_status_'+response.id).text(response.status);
			jQuery('#active_status_'+response.id).css("color","red");
			jQuery('#draft_status_'+response.id).text(response.status);
			jQuery('#draft_status_'+response.id).css("color","red");
		},'JSON');  
	}
	else
	{
		return false;
	}
	
	
}


// publish an event
function es_publish_event(event_id)
{
	    jQuery('a#draft_btn_'+event_id).text('Processing...');
		var data = {
			'action': 'cies_publish_event',
			'event_id': event_id
		}; 
	jQuery.post(ajaxurl, data, function(response) {
		if(typeof response.id === 'undefined')
		{
			if(response[0].error_message!='')
			{
				jQuery('#publish_msg').removeClass('isa_error').addClass('isa_error_show');
				jQuery('#publish_msg').html(response[0].error_message);
				jQuery("#publish_msg").delay(5000).fadeOut(300);
				jQuery('a#draft_btn_'+event_id).text('DRAFT');
			}
		}
		jQuery('a#draft_btn_'+response.id).text('Published');
		jQuery('a#draft_btn_'+response.id).removeClass('es-draft-btn').addClass('es-green-btn');
		jQuery('a#draft_btn_'+response.id).attr('onclick', 'es_delete_event("'+response.id+'")');
		jQuery('a#draft_btn_'+response.id).attr('title', 'click to cancel this event');
		jQuery('#draft_status_'+response.id).text(response.status);
		jQuery('#draft_status_'+response.id).css("color","green");
	},'JSON');  
	
}

jQuery(document).ready(function() {	
	// jquery date picker
	var dateToday = new Date();
	jQuery( "#start_date , #end_date" ).datepicker({
        minDate: dateToday,
		dateFormat : 'yy-mm-dd'
    });
	
	//validating start time and end time
	jQuery('#event_startHour').change("live",function(){

	});
});

