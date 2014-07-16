<?php
	/**
	 *  @File			include_onces.php
	 * 	@Authors		Jose Flores
	 * 					jose.flores.152@gmail.com
	 * 	
	 * 	@Description	This file holds all the index include_onces
	 * 
	 * 	@changelog		
	 * 	6/4/14			Added mysql, cookie, token, user ; enabled mysql 
	 * 					ini
	 *	4/24/14			Wrote file			
	 */	
	
	// 	Including external classes
	// 	PHPMailer - Used and required by the email class
	
	// 	Including the application Classes
	include_once( $A[ 'D_LIB' ] . 'mysql.php'  ) ;
	include_once( $A[ 'D_LIB' ] . 'cookie.php'  ) ;
	include_once( $A[ 'D_LIB' ] . 'token.php'  ) ;
	include_once( $A[ 'D_LIB' ] . 'user.php'  ) ;
	include_once( $A[ 'D_LIB' ] . 'authentication.php'  ) ;
	include_once( $A[ 'D_LIB' ] . 'email.php'  ) ;
	include_once( $A[ 'D_LIB' ] . 'mfa.php'  ) ;
	include_once( $A[ 'D_LIB' ] . 'fManager.php'  ) ;
	include_once( $A[ 'D_LIB' ] . 'eventManager.php'  ) ;
	include_once( $A[ 'D_LIB' ] . 'permissions.php'  ) ;	

	//	Including the application library
	include_once( $A[ 'D_LIB' ] . 'library.php' ) ;
		
	//	Including the application api
	include_once( $A[ 'D_API' ] . 'api.php' ) ;	
		
	//	Including developer configuration file
	include_once( $A[ 'D_INI' ] . 'dev.php' ) ;
	
	//	Including mySql	configuration
	include_once( $A[ 'D_INI' ] . 'mysql.php' ) ;
	
	//	Including sec configuration
	include_once( $A[ 'D_INI' ] . 'sec.php' ) ;
	
	//	Including ssl configuration
	include_once( $A[ 'D_INI' ] . 'ssl.php' ) ;
	
	//	Including email configuration
	include_once( $A[ 'D_INI' ] . 'email.php' ) ;
	

	if ( isset( $A[ 'SECURE_REDIRECT' ] ) && 
		 $A[ 'SECURE_REDIRECT' ] == false ) 
			$A[ 'FLAG' ] = false ;
	else $A[ 'FLAG' ] = true ;
	
	$A[ 'AUTH' ] = new authentication( $A , $A[ 'FLAG' ] ) ;
	
?>
