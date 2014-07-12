<?php
	$list = array( 1 , 2 , 3 , 4 ) ;
	function generate( $id ) {
			
		echo '<div id="$id" class="media-list-event">
			<a href="" onclick="event-overlay-media-list( $id ) ; return false ; ">
				<div class="media-list-event-date">' ,
					$id ,
				'</div>
				<div class="media-list-event-thumb">
				</div>
			</a>
		</div>' ;
	
	}

	function overlayControlButton( $action , $symbol , $title ) {
		echo '<div class="event-overlay-settings">
				<a href="#" onclick="event-overlay-controls( \'' . $action . '\' ) ; return false ; "> 
					[' . $symbol . '] ' .
					$title .
				'</a>
			</div>';
	}
	
	echo '<div class="event-overlay">
		
		<div class="event-overlay-controls">' ;
			
			overlayControlButton( 'settings' , 'S' , 'Settings' ) ;
			overlayControlButton( 'close' , 'X' , 'Close' ) ;
			
	echo '</div>
		
		<div class="event-overlay-Title">
			Date information large
		</div>
		
		<div class=="event-overlay-container">
			<div class="event-overlay-container-left">
				<div class="event-overlay-container-left-display-media">
					current event media is here
				</div>

				<div class="event-overlay-container-left-display-comments">
					comments go here
				</div>
			</div>
			
			<div class="event-overlay-container-right">
				<div class="event-overlay-container-right-media-list">';
					
					foreach( $list as $id )
						generate( $id ) ;
					
				echo '</div>
			</div>
		</div>
		
		<div class="event-overlay-footer">
			Date information small
		</div>
		
	</div>' ;

?>
