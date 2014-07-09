<?php
	/**
     *  @file           authenticate.php
     *  @author        	Jose Flores <jose.flores.152@gmail.com>
     *  
     *  This file holds the authenticate class, it manages website 
     * 	lauthentication
     */
		
	/**
	 * 	@name 	authentication
	 * 
	 * 	This is the authentication class it handles user authentication
	 * 	to the web part of the website not the api, The api is intended 
	 * 	for MFA devices
	 * 
	 * 	@param	$A		Holds the Application globals
	 */
	class authentication {

		private $A ;
		private $user ;
		
		/**
		 * 	@name		__construct
		 * 	
		 * 	This function kicks off authentication
		 * 
		 * 	@param	$A				The application Globals
		 * 	@param	$bool_secure	Wether security is enabled for the 
		 * 							landing page and subsequent pages
		 */ 
		 public function __construct( $A ) {
			
			$this->A = $A ;
			
			// Security is not required
			if ( $A[ 'SECURE' ] ) {

				// Security required
				$this->user = new user( $A , null , true ) ;
				
				// perform authentication
				$id = $this->authenticate() ;				
				
				// Authenticate user
				define( 'CURRENT_USER_ID' , $id ) ;
				define( 'CURRENT_WEB_OR_MFA' , 'wEB' ) ;
				define( 'CURRENT_SRC_ID' , $_SERVER[ 'REMOTE_ADDR' ] ) ;
			}

		 }
		 
		/**
		 * 	@name		deauthenticate
		 * 
		 * 	This function terminates a session.
		 */                
		public function deauthenticate( ) {
			
			$this->user->manage( 'SESSION' , 'STOP' ) ;	
			
		}
		
		/**
		 * 	@name		authenticate
		 * 
		 * 	This function authenticates a user or redirects them to a target 
		 * 	page 
		 *
		 * 	@return		null		error page was redirected
		 * 	@retunr 	int			The user id number	
		 */
		public function authenticate( ) {
				
			// Redirect possibilities
			$login = 'Location: ' . $this->A[ 'W_ROOT' ].'login' ;
			
			$session =  $this->user->manage( 'SESSION' , 'INFO' ) ;
			
			// has session cookie
		
			if ( $session[ 'session_active' ] == 1 ) {
				 // has valid session token
								 
				 $DB = new mysql( $this->A ) ;
				 
				 $table = 'csr_usr_account' ;
				 $keyPairs = array( 'usr_email' => $session[ 'usr_email' ] ) ;
				 $operators = array( '==' ) ;
				 
				 $result = $DB->select( $table , $keyPairs , $operators ) ;	
				 
				 $row = $result->fetch_assoc() ;				 

				 $this->user->manage( 'SESSION' , 'EXTEND' ) ;
				 
				 return $row[ 'id' ] ;
				 
			}
			
			$this->deauthenticate( ) ;
			
			if ( $session[ 'session_active' ] == 2 ) {
				 // not registered
				 header( $registration ) ;
			}
						
			header( $login ) ;
		}
	}


?>
