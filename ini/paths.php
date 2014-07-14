<?php
	/**
	 *  @file		paths.php
	 * 	@author		Jose Flores 	<jose.flores.152@gmail.com>
	 * 	
	 * 	This is paths configuration file.
	 */

	// Resolving relative web paths
	
	$A[ 'W_API' ]		= $A[ 'W_ROOT' ].'_api/' ;
	$A[ 'W_COM' ]		= $A[ 'W_ROOT' ].'_com/' ;
	$A[ 'W_PORTAL' ]	= $A[ 'W_ROOT' ].'_portal/' ;
	
	$A[ 'W_CSS' ] 		= $A[ 'W_COM' ].'css/' ;
	$A[ 'W_IMG' ] 		= $A[ 'W_COM' ].'img/' ;
	$A[ 'W_JS' ] 		= $A[ 'W_COM' ].'js/' ;
	
	$A[ 'W_JS_LIB' ] 	= $A[ 'W_JS' ].'lib/' ;
	$A[ 'W_JS_WGT' ] 	= $A[ 'W_JS' ].'wgt/' ;
	
	$A[ 'W_ADMIN' ]		= $A[ 'W_PORTAL' ].'admin/' ;
	$A[ 'W_DEV' ]		= $A[ 'W_PORTAL' ].'dev/' ;
	
	// Resolving relative dir paths
	$A[ 'D_DOC' ]		= $A[ 'D_ROOT' ].'doc\\' ;
	$A[ 'D_INI' ]		= $A[ 'D_ROOT' ].'ini\\' ;
	$A[ 'D_PHP' ]		= $A[ 'D_ROOT' ].'php\\' ;
	$A[ 'D_JAVA' ]		= $A[ 'D_ROOT' ].'java\\' ;
	$A[ 'D_USR' ]		= 'C:\\csr_files\\usr\\' ;
	$A[ 'D_WWW' ]		= $A[ 'D_ROOT' ].'www\\' ;
	//$A[ 'D_UPLOAD_TMP' ]= $A[ 'D_ROOT' ].'tmp\\' ; // This should be kept externall to the application 
	
	$A[ 'D_HEAD' ]		= $A[ 'D_PHP' ].'head\\' ;
	$A[ 'D_API' ]		= $A[ 'D_PHP' ].'api\\' ;
	$A[ 'D_LIB' ]		= $A[ 'D_PHP' ].'lib\\' ;
	$A[ 'D_TMP' ]		= $A[ 'D_PHP' ].'tmp\\' ;
	$A[ 'D_WGT' ]		= $A[ 'D_PHP' ].'wgt\\' ;

	//Icon Sets	
	$A[ 'ToolbarMenuIcons' ] = $A[ 'W_IMG' ].'jquery-ui/' ;
	
?>
