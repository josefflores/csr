<?php
	/**
	 * 	@file 	eventManager.php
	 * 
	 * 	@author Jose Flores	<jose.flores.152@gmail.com>
	 * 
	 * 	This file holds the this->event class
	 */
	 
	/**
	 * 	@name 	eventManager
	 * 
	 * 	This class is made to manage api this->event data
	 */
	class eventManager {
		
		private $eventList ;			// Holds the ids of a users events
		private	$lastEventId ;			// The id of the last event
		private $event ;				// Holds the last retrieved event details
		private $user ;
		private $A ;					// The application settings
		
		/**
		 * 	@name 	__construct
		 * 	
		 * 	The constructor
		 * 
		 * 	@param 	$A		The application gloabal settings
		 */
		public function __construct( $A ){
				$this->A = $A ;
				$this->lastEventId = null ;
		}
		
		/** 
		 * 	@name 	setUser
		 * 
		 * 	This function sets the basic user information for the event
		 * 
		 * 	@param	$user	The user to get information about
		 */
		public function setUser( $user ) {
			// Try a database connection
			try {
				$DB = new mysql( $this->A , 'csr' ) ;
			}
			catch ( Exception $e ) {
				// connection error
				return 1 ; 
			}
			
			//	Query the user 
			$table = 'csr_usr_account' ;
			$keyPairs = array( 'id' => $user ) ;
			$operators = array( '==' ) ;
			$result = $DB->select( $table , $keyPairs , $operators )  ;
			$row = $result->fetch_array( MYSQLI_ASSOC ) ;
		
			unset( $this->user ) ;
			unset( $this->event ) ;
			unset( $this->eventList ) ;
			
			$this->user = null ;
			$this->event = null ;
			$this->eventList = null ;
			
			$this->user[ 'ID' ] 		=  $row[ 'id' ] ;
			$this->user[ 'FIRST_NAME' ] =  $row[ 'usr_name_first' ] ;
			$this->user[ 'MIDDLE_NAME' ]=  $row[ 'usr_name_middle' ] ;
			$this->user[ 'LAST_NAME' ] 	=  $row[ 'usr_name_last' ] ;
			$this->user[ 'EMAIL' ] 		=  $row[ 'usr_email' ] ;
			
			$this->eventList = $this->getEventList( $user ) ;
			
			return 0 ;
		}
		
		/**
		 * 	@name 	getEventList
		 * 
		 * 	This function creates a list of available events
		 * 
		 * 	@param the user to get events for
		 * 	
		 * 	@return array	Success
		 * 	@return 1		Database connection error
		 */
		private function getEventList( $user ) {
			
			if ( $this->eventList == null ) {		
			
				// Try a data database connection
				try {
					$DB_D = new mysql( $this->A , 'csr_d' ) ;
				}
				catch ( Exception  $e ) {
					// connection error
					return 1 ; 
				}
				
				$ret = array() ;
				
				// Query the key Pair Database
				$table = 'csr_d_key_pair' ;
				$keyPairs = array( 'csr_d_usr_id' => $user ) ;
				$operators = array( '==' ) ;
				$columns = array( 'csr_d_event_id' ) ;
				$result = $DB_D->select( $table , $keyPairs , $operators , $columns )  ;
				
				while ($row = $result->fetch_row()) {
					$ret[] = $row ;
				}

				//	Query the File Database
				$table = 'csr_d_files' ;
				$keyPairs = array( 'csr_d_f_usr_id' => $user ) ;
				$operators = array( '==' ) ;
				$columns = array( 'csr_d_event_id' ) ;
				$result = $DB_D->select( $table , $keyPairs , $operators , $columns )  ;
				
				while ($row = $result->fetch_row()) {
					$ret[] = $row ;
				}
				
				// Get array of event keys
				$keySwitch = array() ;
				foreach( $ret as $i ) {
					$keySwitch[ $i[ 0 ] ] = true ;
				}
				$keys = array_keys( $keySwitch ) ;
				
				//	Order Oldest to newest		
				if( !sort( $keys , SORT_NUMERIC ) )
					return 2 ;
				
				// Store the event list
				$this->eventList = $keys ;
			
			}
			
			// return the event lsit
			return $this->eventList ;
			
		}
		/**
		 * 	@name	retrievethisEvent
		 * 
		 * 	This function retrieves an this->event from the database.
		 *	
		 * 	@param	$user		the user id being search for
		 * 	@param 	$eventId	The event to get
		 * 
		 * 	@return 0 	Succesfuly retrieved event
		 * 	@return 1	Connection error
		 */
		public function retriveEvent( $user , $eventId ) {
			
	
			// Try a data database connection
			try {
				$DB = new mysql( $this->A , 'csr_d' ) ;
			}
			catch ( Exception $e ) {
				// connection error
				return 1 ; 
			}
			
			// Query the key Pair Database
			$table = 'csr_d_key_pair' ;
			$keyPairs = array( 'csr_d_event_id'=>  $eventId , 'csr_d_usr_id' => $user ) ;
			$operators = array( '==' , '==' ) ;
			$rowKeyPairs = $DB->select( $table , $keyPairs , $operators )  ;
			
			//	Query the File Database
			$table = 'csr_d_files' ;
			$keyPairs = array( 'csr_d_event_id'=>  $eventId , 'csr_d_f_usr_id' => $user ) ;
			$operators = array( '==' , '==' ) ;
			$rowFiles = $DB->select( $table , $keyPairs , $operators )  ;
			
			// Store this event as accessed
			unset( $this->event ) ;
			unset( $this->lastEventId ) ;
			$this->lastEventId = $eventId ;	
			
						
			for ( $i = 0 ; $row = $rowFiles->fetch_assoc() ; ++$i ) {
				//echo '<pre>' , var_dump( $row ), '</pre>' ;
				$this->event[ $this->lastEventId ][ 'FILE' ][ $i ][ 'MIME' ] = $row[ 'csr_d_f_mime' ] ;
				$this->event[ $this->lastEventId ][ 'FILE' ][ $i ][ 'NAME' ] = $row[ 'csr_d_f_name' ] ;
				$this->event[ $this->lastEventId ][ 'FILE' ][ $i ][ 'PATH' ] = $row[ 'csr_d_f_path' ] ;
			}
			$this->event[ $this->lastEventId ][ 'FILE' ][ 'COUNT' ] = $i ;	
			
			
			for ( $i = 0 ; $row = $rowKeyPairs->fetch_assoc() ; ++$i ) {
				$this->event[ $this->lastEventId ][ 'KEY_PAIRS' ][ $i ][ 'KEY' ] = $row[ 'csr_d_key' ] ;
				$this->event[ $this->lastEventId ][ 'KEY_PAIRS' ][ $i ][ 'VAL' ] = $row[ 'csr_d_val' ] ;
			}
			$this->event[ $this->lastEventId ][ 'KEY_PAIRS' ][ 'COUNT' ] = $i ;
			
			return 0 ;
		}
		
		/** 
		 * 	@name getSetByIndex
		 * 
		 * 	This function returns the next set of indexed events where 
		 * 	next is newer
		 * 
		 * 	@param	$atart		The index start 
		 * 	@param 	$stop		The index end
		 */
		public function getSetByIndex( $start , $stop ) {
			// find the index of the current
			$length = count( $this->eventList ) ;
			$values = array() ;
			// make sure you are not looking out of range
			if ( $start < 0 )
				$start = 0 ;
				
			// get as many as possible
			for ( $i = $start ; $i < $length && $i <= $stop ; ++$i ) {
				if ( $this->retriveEvent( $this->user[ 'ID' ] , $this->eventList[ $i ] ) == 0 ) 
					$val = $this->event ;
				else 
					$val = array( 'ERROR' ) ;
				
				array_push( $values , $val ) ;
			}
			
			return $values ;
			
		}
		
		/**
		 * 	@name	getSetByTime
		 * 
		 * 	This function returns a date range of events
		 * 
		 * 	@param 	$start	The start timestamp in epoch format
		 * 	@param	$stop	The end timestamp in epoch format
		 */
		public function getSetByTime( $start , $stop ) {
			//ERROR RESOLVE DATE TIME SEARCH
			
			//	Get the number of events
			$length = count( $this->eventList ) ; 
			
			// Initialize range
			$start_i = 0 ;
			$stop_i = 0 ;
		
			$bool_start = true ;
				
			//	retrieve indices	
			for ( $i = 0 ; $i < $length ; ++$i ) {
				if( $bool_start && $this->eventList[ $i ] >= $start ) {
					$bool_start = false ;
					$start_i = $i ;
				} 
				if( $this->eventList[ $i ] <= $stop ) {
					$stop_i = $i ;
				}
			}
				
			// get events
			return $this->getSetByIndex( $start_i , $stop_i ) ;
			
		}
		
		/**
		 * 	@name	manage
		 * 
		 * 	This function manages the event retrieval, It takes an action 
		 * 	and an action optional parameter
		 * 	
		 * 	@param $action		The action to take
		 *		SET_USER 	- Set the user whose events are being searched for	
		 * 		LIST 		- Return a list of the events 
		 * 		RANGE_INDEX - Get a range of events by index
		 * 		RANGE_DATE 	- Get a range of events by epoch
		 * 
		 * 	@paraq $param	The paramaters needed for the $action
		 * 		SET_USER 	- (int) The User id
		 * 		RANGE_INDEX - (int[]) array indeces
		 * 						$param[0] Start Index 
		 * 						$param[1] Stop Index
		 * 		RANGE_DATE 	- (int[]) epoch timestamps 
		 * 						$param[0] Start Index , 
		 * 						$param[1] Stop Index
		 * 		
		 * 					
		 */ 						
		public function manage( $action , $param = null ){
			switch ( $action ) {
				
				case 'SET_USER' :
					// Get User
					$tmp =  $this->setUser( $param ) ;
					break ;
				
				// retrieve list
				case 'LIST' :
					// Check for user
					if ( $this->user[ 'ID' ] == null )
						return null ;
					// Retrieve list
					$tmp = $this->getEventList( $this->user[ 'ID' ] ) ;
					break ;
				
				// List Index search	 
				case 'RANGE_INDEX' :
					// Determine id indeces were given
					
					if ( is_array( $param ) ) {
						$start = $param[ 0 ] ;
						$stop = $param[ 1 ] ;
						$tmp = $this->getSetByIndex( $start , $stop ) ;
					}
					else 
						$tmp = null ;
					
					break ;
				
				// Date range search
				case 'RANGE_EPOCH' :
					if ( is_array( $param ) ) {
						$start = $param[ 0 ] ;
						$stop = $param[ 1 ] ;
						$tmp = $this->getSetByTime( $start , $stop ) ;
					}
					else {
						$tmp = null ;
					}
					
					
					break ;
									
				default :
					$tmp = null ;
			}
			
			return $tmp ;
		}
	}
	
	/*
	$parent = 'timeline-this->event-'
	echo '<div class="timeline">' ;
	foreach ( $this->eventList as $this->event ) {
		echo'
		<div class="'.$parent.'this->event">
		
			<div class="'.$parent.'header">
				<div class="'.$parent.'title">'.$title.'</div>
				<div class="'.$parent.'date">'.$date.'</div>
			</header>
			
			<div class="'.$parent.'body">'.$body.'</div>
			<div class="'.$parent.'comment">'.$comment.'</div>
			<div class="'.$parent.'footer">'.$footer.'</div>
			
		</div>';
	}*/
	
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

	$E = new eventManager( $A ) ;
	$E->manage( 'SET_USER' , 1 ) ;
	$E->manage( 'LIST' ) ;
	$E->manage( 'RANGE_EPOCH' , array( 2 , 2 ) ) ) ;
	*/
?>
