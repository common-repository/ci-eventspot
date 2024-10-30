jQuery(function() {
	var cal = '';
	var check_shortcode = jQuery('#calendar').length;
	if(check_shortcode!=0)
	{
		var transEndEventNames = {
					'WebkitTransition' : 'webkitTransitionEnd',
					'MozTransition' : 'transitionend',
					'OTransition' : 'oTransitionEnd',
					'msTransition' : 'MSTransitionEnd',
					'transition' : 'transitionend'
				},
				transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
				$wrapper = jQuery( '#custom-inner' ),
				$calendar = jQuery( '#calendar' ),
				cal = $calendar.calendario( {
					onDayClick : function( $el, $contentEl, dateProperties ) {
						console.log($contentEl);
						console.log(dateProperties);
						
						if( $contentEl.length > 0 ) {
							showEvents( $contentEl, dateProperties );
						}

					},
					caldata : codropsEvents,
					displayWeekAbbr : true
				} ),
				$month = jQuery( '#custom-month' ).html( cal.getMonthName() ),
				$year = jQuery( '#custom-year' ).html( cal.getYear() );

				jQuery( '#custom-next' ).on( 'click', function() {
					cal.gotoNextMonth( updateMonthYear );
				} );
				jQuery( '#custom-prev' ).on( 'click', function() {
					cal.gotoPreviousMonth( updateMonthYear );
				} );

	}
	if(check_shortcode!=0)
	{
			
	}

	function updateMonthYear() {				
		$month.html( cal.getMonthName() );
		$year.html( cal.getYear() );
	}

	function showEvents( $contentEl, dateProperties ) {

		hideEvents();
		
		var $events = jQuery( '<div id="custom-content-reveal" class="custom-content-reveal"><h4>Events for ' + dateProperties.monthname + ' ' + dateProperties.day + ', ' + dateProperties.year + '</h4></div>' ),
			$close = jQuery( '<span class="custom-content-close"></span>' ).on( 'click', hideEvents );
			
		$events.append( $contentEl.html() , $close ).insertAfter( $wrapper );
		
		setTimeout( function() {
			$events.css( 'top', '0%' );
		}, 25 );

	}
	function hideEvents() {

		var $events = jQuery( '#custom-content-reveal' );
		if( $events.length > 0 ) {
			
			$events.css( 'top', '100%' );
			Modernizr.csstransitions ? $events.on( transEndEventName, function() { jQuery( this ).remove(); } ) : $events.remove();

		}

	}
	

});

	