<?php
	/**
	 * 	@file		permissions.php
	 * 	@author		Jose F Flores	<jose.flores.152@gmail.com>
	 * 
	 * 	This file holds the permisions class
	 */
	 
	/**
	 * 	@name 	permissions
	 * 
	 * 	This class controls the user read write permissions for users
	 */	
	class permissions {
		
		private $A ;
		
		public function	__construct( $A ){
			$this->A = $A ;
		}
		
		/**
		 * 	@name 	setPermissions
		 * 
		 * 	This function sets a users permissions
		 * 
		 * 	@param	$user	The user who is gaining permissions
		 * 	@param	$target	The permissionss they are gaining on
		 * 	@param	$read	Read permission
		 * 	@param	$write	Write Permission
		 * 
		 * 	@return	0	Success
		 * 	@return	1	Mysql Connection Error
		 */
		private function setPermissions( $user , $target , $read = 0 , $write = 0 ) {
			
			try {
				$DB = new mysql( $this->A ) ;
			}
			catch( Exception $e ){
				return 1 ;
			}
			
			$table = 'csr_usr_permission' ;
			$keyPairs = array( 'per_id_self' => $user , 
							   'per_id_target' => $target ) ;
			$operators = array( '==' , '==' ) ;	
			$newKeyPairs = array( 'per_id_self' => $user , 
							   'per_id_target' => $target ,
							   'per_access_read' => $read ,
							   'per_access_write' => $write ) ;
			
			$result = $DB->select( $table , $keyPairs , $operators ) ;			   
							   
			if( $result->num_rows > 0 ) {
				$DB->update( $table , $keyPairs , $operators , $newKeyPairs ) ;
				
			}
			else
			{	
				$DB->insert( $table , $newKeyPairs ) ;
			}

			return 0 ;
		}
		
		/**
		 * 	@name 	getPermissions
		 * 
		 * 	This function gets a users permissions
		 * 
		 * 	@param	$user	The user whos permissions are being queried
		 * 
		 * 	@return	null	Success	, no permissions found for user
		 * 	@return array	The users permissions
		 * 	@return	1		Mysql Connection Error
		 */
		private function getPermissions( $user ) {
			
			try {
				$DB = new mysql( $this->A ) ;
			}
			catch( Exception $e ){
				return 1 ;
			}
				
			$table = 'csr_usr_permission' ;
			$keyPairs = array( 'per_id_self' => $user ) ;
			$operators = array( '==' ) ;	
			
			
			$result = $DB->select( $table , $keyPairs , $operators ) ;			   
			
			if( $result->num_rows > 0 ) {
				$tmp = array() ;
				$tmp[ 'USER' ] 	= $user ;
				$tmp[ 'COUNT' ] = $result->num_rows ;
				for( $i = 0 ; $row = $result->fetch_row( ) ; ++$i ) {
					$tmp[ $i ][ 'TARGET' ] 	= $row[ 2 ] ;
					$tmp[ $i ][ 'READ' ] 	= $row[ 3 ] ;
					$tmp[ $i ][ 'WRITE' ] 	= $row[ 4 ] ;
				}
				return $tmp ;
			}
			
			return null ;
		}
		
		/**
		 * 	@name 	manage
		 * 
		 * 	This function manages users permissions
		 * 
		 * 	@param	$action	The action to take
		 * 					SET	- seta permissions for a nother user 
		 * 					GET	- Get the given users permissions
		 * 	@param	$param	The optional parameters
		 * 					SET - (int) $param[ target ]
		 * 						  ( 0 | 1 ) $param[ read ]
		 * 						  ( 0 | 1 ) $param[ write ]
		 * 
		 * 	@return	tmmp	The called function return values
		 * 	@return	-1		Function Error
		 */
		public function manage( $action , $param = null ) {
				
			switch ( $action ) {
				case 'SET' :
					if( !defined( 'CURRENT_USER_ID' ) ) {
						$tmp = -1 ;
						break ;
					}
					$tmp = $this->setPermissions(  $param[ 'target' ] , CURRENT_USER_ID , $param[ 'read' ] , $param[ 'write' ] ) ;
					break ;
				
				case 'GET' :
					if( !defined( 'CURRENT_USER_ID' ) ) {
						$tmp = -1 ;
						break ;
					}
					$tmp = $this->getPermissions( CURRENT_USER_ID ) ;
					break ;
					
				default :
					$tmp = -1 ;
					break ;					
			}
			
			return $tmp ;
			
		}		
	}
	/*
	$A[ 'W_ROOT' ] = 'josefflores.com/csr/' ;
	$A[ 'D_ROOT' ] = 'F:\\Github\\csr\\' ;
	$A[ 'SECURE' ] = false ;
	
	include( $A[ 'D_ROOT' ].'ini\\paths.php' ) ;
	include( $A[ 'D_TMP' ] . 'includes.php' ) ;

	errorsOn( true ) ;
	
	define( 'CURRENT_USER_ID' , 1 ) ;
	define( 'CURRENT_SRC_ID' , null ) ;
	define( 'CURRENT_WEB_OR_MFA' , 'WEB' ) ;

	$E = new permissions( $A ) ;
	
	$param = array( 'target' => 2 ,
					'read' => 1 ,
					'write' => 1 ) ;
					
	echo $E->manage( 'SET' , $param ) ;
	
	$param = array( 'target' => 4 ,
					'read' => 1 ,
					'write' => 0 ) ;
					
	echo $E->manage( 'SET' , $param ) ;
	
	echo '<pre>' , var_dump(  $E->manage( 'GET' ) ) , '</pre>';
	
	$param = array( 'target' => 2 ,
					'read' => 0 ,
					'write' => 1 ) ;
					
	echo $E->manage( 'SET' , $param ) ;
	
	$param = array( 'target' => 4 ,
					'read' => 0 ,
					'write' => 1 ) ;
					
	echo $E->manage( 'SET' , $param ) ;
	
	echo '<pre>' , var_dump(  $E->manage( 'GET' ) ) , '</pre>';
	*/
	
	
	
?>
