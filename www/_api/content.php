<?php
	/**
	 *  @File			content.php
	 * 	@Author			Jose Flores <jose.flores.152@gmail.com>
	 * 	
	 * 	This file holds the ajax processing catch
	 */
	 
	//	Define guard prevents acces unless from the index.php file at 
	//	this level
	if ( !defined( 'CONTENT_GUARD' ) ) 
		header( 'Location: ./' ) ;
		
	////
	// 	AJAX BEGINS
	////
	
	/*
	 * Structuring information
	 * 		Processing Functions can be found in the Library
	 * 		API Actions are in the API
	 * 
	 * Reserved Orders
	 * 		[-INF , 0 ] 
	 * 
	 * For a list of available calls use getMethodList as the call value
	 * 
	 * Example JSON string 
	 * 
	 * [	
	 * 		{ "order":"1",
	 * 		  "call":"api_function_name",
	 * 		  "parameter":[
	 * 				"value5",
	 * 				"value6"
	 * 		  ]
	 * 		},
	 * 		{ "order":"2",
	 * 		  "call":"api_function_name",
	 * 		  "values":[
	 * 				"value5",
	 * 				"value6"
	 * 		  ]
	 * 		}
	 * ]
	 * 
	 */	
	
	//Sets up JSON return type 
	header( 'Content-Type: application/json' ) ;
	
	// Detects if not in ssl prepares error
	if ( $_SERVER['SERVER_NAME'] == $A[ 'PROD_DOMAIN' ] && $_SERVER[ 'SERVER_PORT' ] != 443  ){
		$json = array( array( 'order' => 0 , 'call' => 'ssl' , 'parameter' => array( null ) ) ) ;
	}
	
	// Allowed in ssl
	else {
		
		// empty query response
		$json = array( array( 'order' => 0 , 'call' => 'getMethodList' , 'parameter' => array( null ) ) ) ;
		
		// non empty query default response
		if ( count( $_POST ) || count( $_GET ) ) {
			$json = array( array( 'order' => 0 , 'call' => 'isBadSyntax' , 'parameter' => array( null ) ) ) ;
			
			//  JSON API POST Processing
			if ( isset( $_POST[ 'JSON' ] ) &&
				 $_POST[ 'JSON' ] != null )
					$json = $_POST[ 'JSON' ] ;
					
			//  JSON API GET Processing
			else if ( isset( $_GET[ 'JSON' ] ) &&
					  $_GET[ 'JSON' ] != null ) 
						$json = $_GET[ 'JSON' ] ;
		}
	}
	// process json 
	echo trim( processJson( $A , $json ) ) ;
	
?>
