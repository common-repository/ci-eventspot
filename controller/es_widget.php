<?php
/* widget class starts here*/
	class cies_widget extends WP_Widget {
	
	// Constructor //
		function cies_widget() {
			$widget_ops = array( 'classname' => 'cies_widget', 'description' => 'Upcoming EventSpot' ); // Widget Settings
			$control_ops = array( 'id_base' => 'cies_widget' ); // Widget Control Settings
			$this->WP_Widget( 'cies_widget', 'EventSpot', $widget_ops, $control_ops ); // Create the widget
		}

		
		// widget form creation
		function form($instance) {

		// Check values
		if( $instance) {
			 $title = esc_attr($instance['title']);
			 $es_no_events = esc_attr($instance['es_no_events']);
			 $es_title_trunc = esc_attr($instance['es_title_trunc']);
			 $es_caption_link = esc_attr($instance['es_caption_link']);
			 $es_title_link = esc_attr($instance['es_title_link']);
			 $es_page_link = esc_attr($instance['es_page_link']);
			 
		} else {
			 $title = '';
			 $es_no_events = '';
			 $es_title_trunc = '';
			 $es_caption_link = '';
			 $es_title_link = '';
			 $es_page_link = '';
			 
		}
		?>

		<p>
		<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>
 
		
		<p>
		<label for="<?php echo $this->get_field_id('es_title_trunc'); ?>"><?php _e('Truncate events title to ', 'wp_widget_plugin'); ?></label>&nbsp;
		<input class="widefat" id="<?php echo $this->get_field_id('es_title_trunc'); ?>" name="<?php echo $this->get_field_name('es_title_trunc'); ?>" type="text" style="width:30px;" value="<?php echo $es_title_trunc; ?>"  />		
		</p>
		
		
		
		<p>
		<label for="<?php echo $this->get_field_id('es_no_events'); ?>"><?php _e('Numbers of events to show', 'wp_widget_plugin'); ?></label>&nbsp;
		<input class="widefat" id="<?php echo $this->get_field_id('es_no_events'); ?>" name="<?php echo $this->get_field_name('es_no_events'); ?>" type="text" style="width:30px;" value="<?php echo $es_no_events; ?>"  />		
		</p>
		
		
		<p>
		<input class="widefat" id="<?php echo $this->get_field_id('es_title_link'); ?>" name="<?php echo $this->get_field_name('es_title_link'); ?>" type="checkbox" <?php if($es_title_link!="") { ?>  checked="checked" <?php } ?> />
		<label for="<?php echo $this->get_field_id('es_title_link'); ?>"><?php _e('Remove link from title of the event', 'wp_widget_plugin'); ?></label>
		</p>
		<p>
		<label for="<?php echo $this->get_field_id('es_caption_link'); ?>"><?php _e('Caption for the link', 'wp_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('es_caption_link'); ?>" name="<?php echo $this->get_field_name('es_caption_link'); ?>" type="text"  value="<?php echo $es_caption_link; ?>" />
		</p>

		<p>
		<label for="<?php echo $this->get_field_id('es_page_link'); ?>"><?php _e('Events list page link', 'wp_widget_plugin'); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id('es_page_link'); ?>" name="<?php echo $this->get_field_name('es_page_link'); ?>" type="text"  value="<?php echo $es_page_link; ?>" />
		</p>	
		
		
		<?php
		}
		
		

		// update widget
		function update($new_instance, $old_instance) {
			  $instance = $old_instance;
			  // Fields
			  $instance['title'] = strip_tags($new_instance['title']);			  
			  $instance['es_no_events'] = strip_tags($new_instance['es_no_events']);
			  $instance['es_title_trunc'] = strip_tags($new_instance['es_title_trunc']);
			  $instance['es_title_link'] = strip_tags($new_instance['es_title_link']);
			  $instance['es_caption_link'] = strip_tags($new_instance['es_caption_link']);
			  $instance['es_page_link'] = strip_tags($new_instance['es_page_link']);
		
			 return $instance;
		}
		
		
		
		// Extract Args //
		
		function widget($args, $instance) {
		
		   extract( $args );
		   // these are the widget options
		   $before_widget = "";
		   $before_title = "";
		   $after_title = "";
		   $after_widget = "";
		   
		   $title = apply_filters('widget_title', $instance['title']);		   
		   $es_no_events = $instance['es_no_events'];
		   $es_title_trunc = $instance['es_title_trunc'];
		   $es_title_link = $instance['es_title_link'];
		   $es_caption_link = $instance['es_caption_link'];
		   $es_page_link = $instance['es_page_link'];
		   echo $before_widget;
		   // Display the widget
		   echo '<div class="widget-text wp_widget_plugin_box">';

		   // Check if title is set
		   if ( $title ) {
			  echo $before_title . $title . $after_title;
		   }

		   	   
		   //upcoming events from constant contact api
		   $access_token_option = "constant_contact_access_token";	
			$access_token = get_option( $access_token_option );
		
			$api_key_option = "constant_contact_api_key";	
			$api_key = get_option( $api_key_option );
			
			
			$url="https://api.constantcontact.com/v2/eventspot/events?limit=100&api_key=$api_key&access_token=$access_token";
			
			$events = cies_getEvents($url);
			
					
			$total_events = count($events['results']);
			
			$event_spot = $events['results'];
		
			echo '<div id="primary" class="sidebar">';
			// get list of event spots
			echo '<ul>';
			$today = "";
			$today_time = "";
			$expire_time = "";
			$expire = "";
			$today = date("Y-m-d");
			
			if($es_no_events!=0 || $es_no_events!="")
			{
				$es_no_events = $es_no_events;
			}
			else
			{
				$es_no_events = 5;
			}
			$es_no_events = $es_no_events-1;
			for($i=0;$i<=$es_no_events;$i++)
			{

				//link for event title
				$url = "https://events.r20.constantcontact.com/register/eventReg?oeidk".$event_spot[$i]['event_detail_url'] ."&oseq=&c=&ch=";
					
				$event_link = str_replace("/v2/eventspot/events/","=",$url);
				
				$start_date = $event_spot[$i]['start_date'];
				
							
				$date_for_link = explode("-",$start_date);
				
				$y = $date_for_link[0];
				$m = $date_for_link[1];
				
				$today_time = strtotime($today);
				$expire_time = strtotime($start_date);
				
				
				//if event title not empty
				if($event_spot[$i]['title']!="")	
				{
				
				echo "<li id='text-".$i."' class='widget widget_text'>";		
				
				if($es_title_trunc!=0 )
				{
					$short_title = substr($event_spot[$i]['title'] , 0 , - $es_title_trunc );
				}
				else
				{
					$short_title = $event_spot[$i]['title'] ;
				}
				
				if($es_title_link!=true) 
				{  				
					
					echo "<div class='textwidget'><p><a target='_blank' href='".$event_link."'>". $short_title ."</a></p></div>";
				}
				else
				{
					echo "<div class='textwidget'><p><a href='javascript:void(0);'>".$event_spot[$i]['title'] ."</a></p></div>";
				}
				
															
				$start_date = date('M d, @   g ma',strtotime($start_date));
				
				
				echo "<div class='textwidget'><p><strong>".$start_date."</b></strong></div>";
				
				echo "<div class='textwidget'><p>".$event_spot[$i]['location'] ."</p></div>";
				
						
				echo "</li>";
				
				}//if closed event title not empty
							
				//}
				

			} 
			
			echo "</ul>";
			
			
			if($es_caption_link)
			{
				$es_caption_link = $es_caption_link;
			}
			else
			{
				$es_caption_link = 'view all events';
			}
			
			if($es_page_link)
			{
				$page_link = $es_page_link;
			}
			else
			{
				$page_link = "#";
			}
				
			echo "<a href='".$page_link."'>".$es_caption_link."</a></div>";
			
		   
		   echo '</div>';
		   echo $after_widget;
		   // get list of events spots
			
		}

	}
	// End class es_widget

?>