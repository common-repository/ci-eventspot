<?php
require("function.php");
// short code for calendar
function es_calendar_func( $atts ){
	
		//upcoming events from constant contact api
		   $access_token_option = "constant_contact_access_token";	
			$access_token = get_option( $access_token_option );
		
			$api_key_option = "constant_contact_api_key";	
			$api_key = get_option( $api_key_option );
			
			
			$url="https://api.constantcontact.com/v2/eventspot/events?limit=100&api_key=$api_key&access_token=$access_token";
			
			$events_list = cies_getEvents($url);
						
			$fetch = $events_list['results'];			
			
			
			$string = "var codropsEvents = {";
			for($i=0;$i<count($fetch);$i++)
			{
				$start_date = date('m-d-Y',strtotime($fetch[$i]['start_date']));
				
				$start_date = "'".$start_date."'";
				
				$title = $fetch[$i]['title'];
				
				$url = "https://events.r20.constantcontact.com/register/eventReg?oeidk".$fetch[$i]['event_detail_url'] ."&oseq=&c=&ch=";
					
				$event_link = str_replace("/v2/eventspot/events/","=",$url);
				
				
				$string .= $start_date." : '<a target=_blank href=$event_link>".$title."</a>',";
				
			}
			
			$string = rtrim($string,',');
			$string .= "}";
			
			$plugin_name = explode("/",plugin_basename(__FILE__));
			$file =  WP_PLUGIN_DIR ."/".$plugin_name[0]."/js/data.js";
			
			file_put_contents($file, $string);
				
	
			
	$es_html = '
		<div class="container">	
			<section class="main">
				<div class="custom-calendar-wrap">
					<div id="custom-inner" class="custom-inner">
						<div class="custom-header clearfix">
							<nav>
								<span id="custom-prev" class="custom-prev"></span>
								<span id="custom-next" class="custom-next"></span>
							</nav>
							<h2 id="custom-month" class="custom-month"></h2>
							<h3 id="custom-year" class="custom-year"></h3>
						</div>
						<div id="calendar" class="fc-calendar-container"></div>
					</div>
				</div>
			</section>
		</div><!-- /container -->'; 
	
	return $es_html;
}
add_shortcode( 'es_calendar', 'es_calendar_func' );


// short code for calendar
function es_allevents_func( $atts ){
	
	//upcoming events from constant contact api
		   $access_token_option = "constant_contact_access_token";	
			$access_token = get_option( $access_token_option );
		
			$api_key_option = "constant_contact_api_key";	
			$api_key = get_option( $api_key_option );
			
			
			$url="https://api.constantcontact.com/v2/eventspot/events?limit=100&api_key=$api_key&access_token=$access_token";
			
			$events_list = cies_getEvents($url);
						
			$fetch = $events_list['results'];	
			
			$es_html = '<ul>'; 
			

			for($i=0;$i<count($fetch);$i++)
			{
				$start_date = date('m-d-Y',strtotime($fetch[$i]['start_date']));
				
			
				$title = $fetch[$i]['title'];
				
				$es_html .= '<li>';				
				
				$url = "https://events.r20.constantcontact.com/register/eventReg?oeidk".$fetch[$i]['event_detail_url'] ."&oseq=&c=&ch=";
					
				$event_link = str_replace("/v2/eventspot/events/","=",$url);
				
				
				$es_html .= $start_date." : <a target=_blank href=$event_link>".$title."</a>";
				
				$es_html .= '</li>';
				
			}			
			
			$es_html .= '</ul>';		
	
	return $es_html;
}
add_shortcode( 'es_allevents', 'es_allevents_func' );
?>