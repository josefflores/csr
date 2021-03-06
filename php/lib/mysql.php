<?php
	
    /**
     *  @file	mysql.php
     *  @author	Jose Flores <jose.flores.152@gmail.com>
     *  
     *  This file holds the mysql class which uses the mysqli PHP object 
     *  to generate conections and perform querys from arrays.
     */

	/**
	 *	@name	mysql
	 * 
	 * 	This class handles mysql connections
	 * 
	 * 	concept was based off of a class found online
	 * 	http://alperguc.blogspot.com/2013/08/php-database-class-mysqli.html
	 * 	but then later modified.
	 * 
	 * 	$connection		a mysqli connection
	 */
	// My database Class called myDBC
	class mysql {
		
		//	VARIABLES
		private $connection  ; 	// 	mysqli object instance, holds the connection
		
		//	CONSTUCTOR
		 
		/**
		 * 	@name	__construct
		 * 
		 * 	This function is the class constructor, it instantiates an 
		 * 	instance of the mysqli class and then checks for a valid 
		 * 	connection
		 * 
		 * 	@param	$A	The application global
		 */		
		public function __construct( $A , $DB = null ) {
			
			if ( $DB == null ) {
				$this->connection = new mysqli( $A[ 'M_SERVER' ] , 
								  $A[ 'M_USR' ] ,  
								  $A[ 'M_PWD' ] , 
								  $A[ 'M_DB' ] ) ;
			} else {
				$this->connection = new mysqli( $A[ 'M_SERVER' ] , 
								  $A[ 'M_USR' ] ,  
								  $A[ 'M_PWD' ] , 
								  $DB ) ;
			}	
								  
			if ( $this->connection->connect_errno > 0 ) {
				throw new exception( 'Unable to connect to database [' . 
					$this->connection->connect_error . ']' ) ;
			}
		}
		
		//	DESTRUCTOR
		
		/**
		 * 	@name	__destructor 
		 * 
		 * 	This function kills the thread and closes the database 
		 * 	connection
		 */
		public function __destruct() {
			//	determine thread id 
			$thread_id = $this->connection->thread_id ;

			//	Kill connection 
			$this->connection->kill( $thread_id ) ;
			
			// close database connection
			$this->connection->close() ;
		}
		
		//	METHODS
		
		/**
		 * 	@name	isTable
		 * 
		 * 	Determines if a table exists
		 * 
		 * 	@param 	$table	the table name
		 * 
		 * 	@return true	table exists
		 * 	@return false	table does not exist 
		 */
		public function isTable( $table ) {
			
			if ( $table == null ) 
				return false ;
				
			$query = "SHOW TABLES LIKE '" . $table . "'" ;
			
			if ( ( $result = $this->runQuery( $query ) ) &&
				 mysqli_num_rows( $result ) > 0 ) {
					return true ;
			}
			
			return false ;

		}
		/**
		 * 	@name	insert
		 * 
		 * 	This function creates a mysql insert query from an array of 
		 * 	values and table location
		 * 
		 * 	@param	$table		table to performt he operation on
		 * 	@param	$keyPairs	The array of values
		 * 						array( key => pair )
		 * 
		 * 	@return				Mysqli return values
		 */
		public function insert( $table , $keyPairs ) {

			//VARIABLES
			$bool = false ;				// 	multiple $keyPair sentinel
			$column = $values = '';		//	initializing values

			//	Run through all the keyPairs
			foreach( $keyPairs as $key => $value ) {
				
				// 	check if a field is blank	
				if ( trim( $value ) != '' ) {
					// 	if the second string or beyond seperate with commas
					if ( $bool ) {
						$column .= ' , '  ;
						$values .= ' , '  ;
					}
					
					// 	append the keys and cleaned inputs to their strings
					$column .= '`'. $key .'`' ;
					$values .= '"' . $this->cleanString( $value ) . '"' ;
					
					// 	Set bool to true to signify that the commas can 
					//	start being generated
					$bool = true ;
				}
			}
			
			//	generate query
			$query = 'INSERT INTO `' . $table . '` ( ' .  $column . ' ) VALUES ( ' . $values . ' )' ;

			// perform query
			return $this->runQuery( $query ) ;
		}
		
		/**
		 * 	@name	select
		 * 
		 * 	This function creates a mysql select query from an array of 
		 * 	values , operators and table location
		 * 
		 * 	@param	$table		table to performt he operation on
		 * 	@param	$keyPairs	The array of values
		 * 						array( key => pair )
		 * 	@param	$operators	The relationship betweent the key and value 
		 * 						ie wether they must be equal or not, 
		 * 						using php comparison operators for consistency
		 * 	@param 	$columns	an array of columns to retrieve
		 * 	@return				Mysqli return values
		 */
		public function select( $table , $keyPairs , $operators , $columns = null ) {
			
			//VARIABLES
			$i = 0 ;			//	operator incrementor
			$bool = false ;		//	first item sentinel
			$options = '';		// 	the WHERE options

			//	Run through all the keyPairs
			foreach( $keyPairs as $key => $val ) {
				
				// 	If the second string or beyond seperate with commas
				if ( $bool ) {
					$options .= ' AND '  ;
				}
				
				$options .= '`' . $key . '`' . 
					$this->getOperator( $operators[ $i++ ] ) . 
					'"' . $this->cleanString( $val ) . '"' ;
									
				// 	Set bool to true to signify that the commas can 
				//	start being generated
				$bool = true ;
				
			}

			if ( $columns == null ) {
				// 	Generate Query
				$col = ' * ' ;
			}
			else {
				$col = ' ' ;
				$bool = false ;
				foreach( $columns as $item ) {
					if ( $bool ) {
						$col .= ', '  ;
					}
					$col .=  '`'. $item . '` '  ; 
					$bool = true ;
				}
			}
			
			$query = 'SELECT '.$col.' FROM `' . $table . '`' ;
			
			// 	If there where key pairs
			if ( $options != '' ) 
				$query .= ' WHERE ' . $options ;

			// 	Query mysql
			return $this->runQuery( $query ) ;
		}
		
		/**
		 * 	@name	select
		 * 
		 * 	This function creates a mysql select query from an array of 
		 * 	values , operators and table location
		 * 
		 * 	@param	$table		table to performt he operation on
		 * 	@param	$keyPairs	The array of values
		 * 						array( key => pair )
		 * 	@param	$operators	The relationship betweent the key and value 
		 * 						ie wether they must be equal or not, 
		 * 						using php comparison operators for consistency.
		 * 	@param	$newKeyPairs	The replacement keypairs
		 *  
		 * 	@return				Mysqli return values
		 */
		public function update( $table , $keyPairs , $operators , $newKeyPairs ) {
			
			//VARIABLES
			$i = 0 ;			//	operator incrementor
			$bool = false ;		//	first item sentinel
			$options = $change = '';		// 	the WHERE options

			//	Run through all the keyPairs
			foreach( $keyPairs as $key => $val ) {
				
				// 	If the second string or beyond seperate with commas
				if ( $bool ) {
					$options .= ' AND '  ;
				}
				
				$options .= '`' . $key . '`' . 
					$this->getOperator( $operators[ $i++ ] ) . 
					'"' . /*$this->cleanString(*/ $val /*)*/ . '"' ;
									
				// 	Set bool to true to signify that the commas can 
				//	start being generated
				$bool = true ;
				
			}

			$bool = false ;
			foreach( $newKeyPairs as $key => $val ) {
				
				// 	If the second string or beyond seperate with commas
				if ( $bool ) {
					$change .= ' , '  ;
				}
				
				$change .= '`' . $key . '`=' . 
					'"' . /*$this->cleanString(*/ $val /*)*/ . '"' ;
									
				// 	Set bool to true to signify that the commas can 
				//	start being generated
				$bool = true ;
				
			}
			
			// 	Generate Query
			$query = 'UPDATE `' . $table .'`' ; 
			$query .= ' SET ' . $change ;
			
			// 	If there where key pairs
			if ( $options != '' ) 
				$query .= ' WHERE ' . $options ;

			// 	Query mysql
			return $this->runQuery( $query ) ;
		}
		
		/**
		 * 	@name	delete
		 * 
		 * 	This function creates a mysql delete query from an array of 
		 * 	values, operators and table location
		 * 
		 * 	@param	$table		table to performt he operation on
		 * 	@param	$keyPairs	The array of values
		 * 						array( key => pair )
		 * 	@param	$operators	The relationship betweent the key and value 
		 * 						ie wether they must be equal or not, 
		 * 						using php comparison operators for consistency
		 * 	@return				Mysqli return values
		 */
		public function delete( $table , $keyPairs , $operators ) {
			
			//VARIABLES
			$i = 0 ;			//	operator incrementor
			$bool = false ;		//	first item sentinel
			$options = '';		// 	the WHERE options

			//	Run through all the keyPairs
			foreach( $keyPairs as $key => $val ) {
				
				// 	If the second string or beyond seperate with commas
				if ( $bool ) {
					$options .= ' AND '  ;
				}
				
				$options .= '`' . $key . '`' . 
					$this->getOperator( $operators[ $i++ ] ) . 
					'"' . $this->cleanString( $val ) . '"' ;
									
				// 	Set bool to true to signify that the commas can 
				//	start being generated
				$bool = true ;
				
			}

			// 	Generate Query
			$query = 'DELETE FROM `' . $table .'` WHERE ' . $options ;

			// 	Query mysql
			return $this->runQuery( $query ) ;
							
		}

		/**
		 * 	@name	getOperator
		 * 
		 * 	This function guarantees that the operators for a WHERE mysql 
		 * 	clause are valid and that for ease of use are translated from 
		 * 	the php equivilents
		 *
		 * 	@param 	$operators 	the operator to verify/ convert
		 * 
		 * 	@return the mysql operator 
		 */
		private function getOperator( $operators ) {
			
			switch ( $operators ) {			
				case '==' 	: return '=' ;
				case '===' 	: return '===' ;	
				case '!=' 	: return '!=' ;
				case '!==' 	: return '!==' ;
				case '<' 	: return '<' ;
				case '>' 	: return '>' ;
				case '<=' 	: return '<=' ;
				case '>=' 	: return '>=' ;
				default 	: return false ;
			}
				
		}
		
		/**
		 * 	@name 	runQuery
		 * 
		 * 	This function runs a mysql query. 
		 * 
		 * 	@param $query 	the query to perform
		 * 
		 * 	@return the mysqli response
		 */
		public function runQuery( $query) {
			
			// run query or report error
			if ( !$result = $this->connection->query( $query ) ) {
				die( '[ SQL ] ' . $this->connection->error  ) ;
			}	
			// return result
			return $result ;	
		}
		 
		/**
		 * 	@name	cleanString
		 * 	
		 * 	This function cleans the string so that it can be stored 
		 * 	safely in a mysql database
		 * 
		 * 	@param	$text 		the string to sanitize
		 * 
		 * 	@return string		the cleaned string
		 */ 
		private function cleanString( $text ) {
			// strip extra spaces on out sid and sanitize
			return $this->connection->real_escape_string( trim( $text ) ) ;
		}
		 
		/**
		 * 	@name 	getLastInsertID
		 * 
		 * 	This function gets the last insertion id
		 * 
		 * 	@return int		the last insert id
		 */
		private function getLastInsertID() {
			
			return $this->connection->insert_id ;
		}	 
	}	
	 
?>
