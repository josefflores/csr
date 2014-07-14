<?php
	// Navigatiopn Menu links
	
	if( !LOGGED_IN ) {
				$WGT[ 'MENU' ] = array( array( $A[ 'W_ROOT' ] , 'Home' ) ,
							array( $A[ 'W_ROOT' ] . 'about' , 'About' ) ,
							array( $A[ 'W_ROOT' ] . 'contact' , 'Contact' )
							) ;
	}
	else {
	$WGT[ 'MENU' ] = array( array( $A[ 'W_ROOT' ] , 'Home' ) ,
							array( $A[ 'W_ROOT' ] . 'about' , 'About' ) ,
							array( $A[ 'W_ROOT' ] . 'contact' , 'Contact' ) ,
							array( $A[ 'W_ROOT' ] . 'profile' , 'Profile' ) 
							) ;
	}
