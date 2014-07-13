<?php
	
	$list = array( 1 , 2 , 3 , 4 ) ;
	function generateEventThumb( $id ) {
			
		echo '<div id="',$id,'" class="media-list-event">
				<a href="" onclick="event-overlay-media-list( ' ,$id  ,') ; return false ; ">
					<div class="media-list-event-date">' ,
						$id ,
					'</div>
					<div class="media-list-event-thumb">
					</div>
				</a>
			</div>' ;
	
	}

	function overlayControlButton( $action , $symbol , $title ) {
		echo '<div class="event-overlay-controls-button">
				<a href="#" onclick="event-overlay-controls( \'' . $action . '\' ) ; return false ; "> 
					[' . $symbol . '] 
				</a>
			</div>';
	}
	
	echo 	'<html>
				<head>
					<style src="_com/css/main.css" ></style>
					<style>
						div.event-overlay { 
							background : red ; 
							width : 800px ; 
							height : 600px; 
						}
						div.event-overlay-title {
							background : yellow ; 
							height : 32px ; 
							width : 100% ;
						}
						
						div.event-overlay-container {
							height: 536px ;
							width: 100% ;
						}
						div.event-overlay-container-left {
							height: 100% ;
							width : 80% ;
							background: blue;
							float: left ;
						}
						div.event-overlay-container-left-display-comments {
							height:50% ;
							background :orange ;
						}
						div.event-overlay-container-left-display-media {
							height:50% ;
							background :teal ;
						}
						
						div.event-overlay-container-right { 
							height: 100%;
							width: 20%;
							background: brown;
							float: left;
						}
						div.event-overlay-container-right-media-list {
							margin : 5% ;
							width : 90% ;
							height : 90 ;
						}
						
						div.event-overlay-controls { 
							background : green ; 
							height : 32px ; 
							width : 100% ;
						}
						
						div.event-overlay-controls > div.event-overlay-controls-button {
							background : white ;
							height : 20px ;
							width : 20px ; 
							padding : 3px ; 
							margin : 3px ;
							float : right ;
							
						}
						
						div.event-overlay-footer {}
						
						div.media-list-event {
							background : white ; 
							height : 90px ; 
							width : 90px ;
							float : left ;
						}
						div.media-list-event a {}
						div.media-list-event a div.media-list-event-date {}
						div.media-list-event a div.media-list-event-thumb { }
						
						
					</style>
				</head>
				<body>
					<div class="event-overlay">
		
						<div class="event-overlay-controls">' ;
							
							overlayControlButton( 'close' , 'X' , 'Close' ) ;
							overlayControlButton( 'settings' , 'S' , 'Settings' ) ;
							
						
				echo 	'</div>
					
						<div class="event-overlay-title">
							Date information large
						</div>
						
						<div class="event-overlay-container">
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
										generateEventThumb( $id ) ;
									
						echo 	'</div>
							</div>
						</div>						
					</div>
				</body>
			</html>' ;

?>
