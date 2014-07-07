<?php
	/**
	 *  @File			ssl.php
	 * 	@Authors		Jose Flores
	 * 					jose.flores.152@gmail.com
	 * 	
	 * 	@Description	This is the ssl configuration file.
	 * 
	 * 	@changelog		
	 *	4/24/14			Created file
	 */
	 
	$A[ 'PROD_DOMAIN' ] = 'csr.cs.uml.edu' ;
	
	if ( $_SERVER['SERVER_NAME'] == $A[ 'PROD_DOMAIN' ] && $_SERVER[ 'SERVER_PORT' ] != 443  ) {
		header( 'Location: https://' . $_SERVER[ 'HTTP_HOST' ] . $_SERVER[ 'PHP_SELF' ] ) ;
		exit() ; 
	}
	
	

?>
