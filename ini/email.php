<?php
	/**
	 *  @File			email.php
	 * 	@Authors		Jose Flores
	 * 					jose.flores.152@gmail.com
	 * 	
	 * 	@Description	This is the email configuration file.
	 * 
	 * 	@changelog		
	 *	6/25/14			Created file
	 */

	
	
	$A[ 'MAIL_SMTP_HOST' ] 	= 'smtp.zoho.com' ;			// Specify main and backup SMTP servers
	$A[ 'MAIL_SMTP_PORT' ]	= 465 ;
	$A[ 'MAIL_SMTP_SEC' ]   = 'ssl' ;
	
	$A[ 'MAIL_FROM_USR']	= 'no-reply' ;
	$A[ 'MAIL_FROM_DOMAIN'] = 'csr.cs.uml.edu' ;
	
	$A[ 'MAIL_SMTP_PWD' ] 	= $_ENV[ 'CSR_SMTP_PWD' ] ;  	// SMTP password
		
?>
