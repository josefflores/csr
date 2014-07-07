<?php

	/**
     *  @file           fManager.php
     *  @author        	Jose Flores <jose.flores.152@gmail.com>
     *  
     *  This file holds the file class, it manages files 
     */
		
	/**
	 * 	@name 	file
	 * 
	 * 	This is the file class it handles upload and downloads of files 
	 * 
	 * 	@param	$A		Holds the Application globals
	 */
	class fManager {
		
		// Variables
		private $A ;									// 	The application Global
		private $sizeLimit = 20000 ;					// 	file size limit
		private $allowedMimes = array( 'image/jpg' , 	//	Array of acceptable mime types 
									   'image/jpeg' , 
									   'image/gif' , 
									   'image/png' , 
									   'audio/mp3' , 
									   'audio/wma' , 
									   'video/mp4' ) ;
									   
		
		// Generate dictionary
		private $Dict = array( 	'application/pdf'   => 'pdf' ,
								'application/zip'   => 'zip' ,
								
								'image/gif'         => 'gif' ,
								'image/jpg'			=> 'jpg' ,
								'image/jpeg'        => 'jpg' ,
								'image/png'         => 'png' ,
								                        
								'text/css'          => 'css' ,
								'text/html'         => 'html',
								'text/javascript'   => 'js'  ,
								'text/plain'        => 'txt' ,
								'text/xml'          => 'xml' ,
								                        
								'video/avi'			=> 'avi' ,
								'video/mpeg'		=> 'mpeg' ,
								'video/mp4'			=> 'mp4' ) ;
		/**                                             
		 * 	@name 		__construct
		 * 	
		 * 	This is the constructor
		 * 
		 * 	@param 	$A	This  is the application global
		 */
		public function __construct( $A  ) {
			$this->A = $A ;
			//ini_set( 'upload_tmp_dir' , $A[ 'D_UPLOAD_TMP' ] ) ;
		}
		
		/**
		 * 	@name 		upload
		 * 
		 * 	This function uploads a file using the $_FILE variable
		 * 
		 * 	@return 0	file uploaded
		 * 	
		 *  @return 1	not authorized, user is not defined
		 *  @return 2	file upload did not occur
		 *  @return 3	file name not found
		 * 	@return	4	file type not allowed
		 * 	@return 5	file to large
		 * 	@return 6 	file upload error
		 * 	@return 7 	file already exists	
		 * 	@return 8	file could not be moved
		 * 	@return 9	Connection error
		 */
		public function upload( $fileName ){
			
			//Validate User
			if ( !defined( 'CURRENT_USER_ID' ) ) 
				return 1 ;
			
			// file upload occured
			if ( !isset( $_FILES[ 'file' ][ 'type' ] ) )
				return 2 ;
				
			if ( is_array( $_FILES[ 'file' ][ 'type' ] ) )  {
				
				$i = 0 ;
				foreach( $_FILES[ 'file' ][ 'type' ] as $item ) {
					if ( $item[ $index ] == $fileName ) {
						return $index ;
					} else {
						++$index ;
					}
				}
				
				// File name not found
				if ( !isset( $_FILES[ 'file' ][ 'type' ][ $index ] ) )	
					return 2 ;
					
				$files[ 'file' ][ 'type' ] = $_FILES[ 'file' ][ 'type' ][ $index ] ;
				$files[ 'file' ][ 'type' ] = $_FILES[ 'file' ][ 'name' ][ $index ] ;
				$files[ 'file' ][ 'type' ] = $_FILES[ 'file' ][ 'error' ][ $index ] ;
				$files[ 'file' ][ 'type' ] = $_FILES[ 'file' ][ 'size' ][ $index ] ;
				$files[ 'file' ][ 'type' ] = $_FILES[ 'file' ][ 'tmp_name' ][ $index ] ;
				
			} else {
				$files = $_FILES ;
			}
			
			// Check File type 
			if ( !in_array( $files[ 'file' ][ 'type' ] , $this->allowedMimes ) )
				return 4 ;
	
			// Check File size
			if( ( $files[ 'file' ][ 'size' ] > $this->sizeLimit ) ) 
				return 5 ;
				 
			// File upload error	
			if ( $files[ 'file' ][ 'error' ] > 0 ) 
				return 6 ; 
			
			// Determine name cmponents	
			$timeStamp = time() ;	
			$extension = pathinfo( $files[ 'file' ][ 'name' ] , PATHINFO_EXTENSION ) ;
			
			// Generate file path
			$filePath = $this->A[ 'D_USR' ] . CURRENT_USER_ID . '\\' ;
			$fileName = CURRENT_USER_ID . '_' . $timeStamp . '.' . $extension ;
				
			// File already exists	      				
			if ( file_exists( $filePath.$fileName ) ) 
				return 7 ;
			
			// Store file
			if ( !move_uploaded_file( $files[ 'file' ][ 'tmp_name' ] ,
								$filePath.$fileName ) ){
									return 8 ;
			
			}
			
			// delete tmp file
			unlink( sys_get_temp_dir () . $files[ 'file' ][ 'tmp_name' ] ) ;
			
			// update db
			if ( record( $files[ 'file' ][ 'type' ] , $timeStamp , $filePath, $fileName ) )
				return 9 ;
				
			return 0 ;
					
		
		}
		
		/**
		 * 	@name	encodeB64
		 * 
		 * 	This function encodes a file in base 64 for json transport
		 * 
		 * 	@param $file		The file path and name
		 * 
		 *	@return	$encoded	The encoded string
		 *	@return	1			File does not exist
		 *	@return	2			mime is invalid, update mime library
		 */
		public function encodeB64( $file ) {
			// check file exists
			if ( !file_exists ( $file ) ) 
				return 1 ;
			
			// Determine file extension
			$ext = pathinfo( $file , PATHINFO_EXTENSION ) ;

			// 	Search if file extension is supported
			if ( !$this->searchMimeDict( $ext ) )
				return 2 ;
			
			// Get mime from file extension
			$mime = $this->searchMimeDict( $ext , true ) ;

			// 	Encode the file
			$fp = fopen( $file , "r" ) ;					// read
			$content = fread( $fp , filesize( $file ) ) ;	// extract
			$encoded = base64_encode( $content ) ;			// convert
			$encoded = str_replace( ' ' , '+' , $encoded ) ;// deal with a php bug since 5.0.5	
			
			//	Success
			return array( 'mime' => $mime , 'encoding' => 'base64' , 'data' => $encoded ) ;
			
		}
		
		/**
		 * 	@name	searchMimeDict
		 * 
		 * 	This function searches the mime dictionary via both key and 
		 * 	ext once.
		 * 
		 * 	@param $input
		 * 	@param getEntry		This variable determines wether the 
		 * 						function will return true and false 
		 * 						or if it will return the corresponding 
		 * 						mime / ext
		 * 	
		 * 	@return true		mime or ext found
		 * 	@return false		mime or ext not found
		 */
		public function searchMimeDict( $input , $getEntry = true ) {
					
			// Search Dict
			foreach( $this->Dict as $mime => $ext ) {
				
				//	Returning mime or ext
				if ( $getEntry ) {
					if ( $mime == $input )
						return $ext ;
					if ( $ext == $input ) 
						return $mime ;							
				} 
				// Returning found
				else {
					if ( $mime == $input || $ext == $input ) 
						return true ;
				}
			}	
			
			// Not found
			return false ;			
		}
		
		/**
		 * 	@name	decodeB64
		 * 
		 * 	This function decodes and stores a b64 encoded file
		 * 
		 * 	@param 	$mime
		 * 	@param 	$encoded
		 * 
		 * 	@return 0	Succesful file storage and recording
		 * 
		 * 	@return	1 	Usr not logged in	
		 * 	@return 2	mime not in dictionary
		 * 	@return 3	file already exists
		 *  @return 4 	File was not written
		 * 	@return 5 	File was not recorded 	
		 * 	@return 6 	Invalid encoding
		 */ 		
		public function decodeB64( $tmp ) {
			
			$mime = $tmp[ 'mime' ] ;
			$data = $tmp[ 'data' ] ;
			$encoded = $tmp[ 'encoded' ] ;
			
			if ( strtolower( $encoded ) != 'base64' )
				return 6 ;
				
			// check if user is signed in 
			if ( !defined( 'CURRENT_USER_ID' ) )
				return 1 ;
				
			//	mime check
			if ( !$this->searchMimeDict( $mime ) )
				return 2 ;

			// get extension 
			$ext = $this->searchMimeDict( $mime , true ) ;

			// generate target information
			$timeStamp = time( ) ;
			$filePath = $this->A[ 'D_ROOT' ] . 'www\\' ;
			$fileName = CURRENT_USER_ID . '_' . $timeStamp . '.' . $ext ;
			
			// target file check, File must not exist
			if ( file_exists( $filePath . $fileName ) ) 
				return 3 ;
				
			// begin file write	
			$fp = fopen( $filePath . $fileName , "wb" ) ; 
		
			// decode string
			$encoded = str_replace( ' ' , '+' , $encoded ) ;// deal with a php bug since 5.0.5
			$decoded = base64_decode( $encoded , true ) ;
			
			// write file
			fwrite( $fp , $decoded ) ; 
			
			fclose( $fp ) ; 
			
			// check if file was written
			if ( file_exists ( $filePath . $fileName ) ) {
				
				// update db
				if ( $this->record( $mime , $timeStamp , $filePath, $fileName ) )
					return 5 ;
					
				// Success
				return 0 ;
			}
			
			// file did not write
			return 4 ;
		}
		
		/**
		 * 	@name	record
		 * 	
		 * 	This function make a mysql file record of an uploaded file
		 * 
		 * 	@param 	$mime		The file mime type
		 * 	@param 	$timeStamp	The given file timestamp, matches written file
		 * 	@param 	$filePath	The Directory the file was written to
		 * 	@param 	$fileName	The file name that was written
		 * 
		 *  @return 0	Succesful record made
		 * 	@return 1	The user is not logged in
		 * 	@return 2	The mysql connection failed
		 */
		private function record( $mime , $timeStamp , $filePath, $fileName ) {
			
			// check if user is signed in 
			if ( !( defined( 'CURRENT_USER_ID' ) &&
				    defined( 'CURRENT_WEB_OR_MFA' ) &&
				    defined( 'CURRENT_SRC_ID' ) ) )
					return 1 ;
				
			// Try to connect to database
			try {	
				// attempt database connection
				$A = $this->A ;
				$A[ 'M_DB' ] = 'csr_d' ;
				$DB = new mysql( $A ) ;	
			}
			catch ( exception $e ) {
				// connection error
				return 2 ;
			}
			
			// Create keyPairs
			$keyPairs[ 'csr_d_f_usr_id' ] 	= CURRENT_USER_ID ;
			$keyPairs[ 'csr_d_f_time' ] 	= $timeStamp ;	
			$keyPairs[ 'csr_d_f_src' ] 		= CURRENT_WEB_OR_MFA ;
			$keyPairs[ 'csr_d_f_src_id' ] 	= CURRENT_SRC_ID ;	
			$keyPairs[ 'csr_d_f_mime' ] 	= $mime ;
			$keyPairs[ 'csr_d_f_path' ] 	= $filePath ;
			$keyPairs[ 'csr_d_f_name' ] 	= $fileName ;
			
			$table = 'csr_d_files' ;
			//	Insert into database
			$DB->insert( $table , $keyPairs ) ;
			
			return 0 ;
		}

	}
	

	/*
	// Resolving relative web paths

	$A[ 'W_ROOT' ] = 'josefflores.com/csr/' ;
	$A[ 'D_ROOT' ] = 'F:\\Github\\csr\\' ;
	$A[ 'SECURE' ] = false ;
	
	include( $A[ 'D_ROOT' ].'ini\\paths.php' ) ;
	include( $A[ 'D_TMP' ] . 'includes.php' ) ;

	errorsOn( true ) ;
	
	define( 'CURRENT_USER_ID' , 1 ) ;
	define( 'CURRENT_SRC_ID' , null ) ;
	define( 'CURRENT_WEB_OR_MFA' , 'WEB' ) ;

	$filename = './1.jpg' ;
	$file = new fManager( $A ) ;
	( $tmp = $file->encodeB64( $filename ) ) ;
	
	echo $file->decodeB64( $tmp ) ;
*/


	
?>
