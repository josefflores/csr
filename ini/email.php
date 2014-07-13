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
	$A[ 'MAIL_SMTP_PORT' ]	= 587 ;
	$A[ 'MAIL_SMTP_SEC' ]   = 'tls' ;
	
	$A[ 'MAIL_FROM_DOMAIN'] = 'csr.cs.uml.edu' ;
	
	$A[ 'MAIL_SMTP_USR' ] 	= $_ENV[ 'CSR_SMTP_USR' ] ;  	// SMTP username
	$A[ 'MAIL_SMTP_PWD' ] 	= $_ENV[ 'CSR_SMTP_PWD' ] ;  	// SMTP password
		
?>
