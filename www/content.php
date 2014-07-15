<?php
	/**
	 *  @File			content.php
	 * 	@Authors		Jose Flores
	 * 					jose.flores.152@gmail.com
	 * 	
	 * 	@Description	This file holds the home page
	 * 
	 * 	@changelog		
	 *	2/25/14			Generated template
	 */
	 
	//	Define guard prevents acces unless from the index.php file at 
	//	this level
	if ( !defined( 'CONTENT_GUARD' ) ) 
		header( 'Location: ./' ) ;
		
	// Content begin
	
	
	echo '<div class="article">
			
			<div class="center">
				<h1> Computational Sensing Research Project</h1>
				
				<img src="' . $A[ 'W_IMG' ] . 'devices.png "/>
				
			</div>
			
			<div class="center">
				
				<button class="large" onclick="window.location.replace(\'http://www.josefflores.com/csr/register/\') ; " > Register </button>
			</div>
		
		</div>' ;
?>
