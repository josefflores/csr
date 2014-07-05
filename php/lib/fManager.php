<?php

	/**
     *  @file           file.php
     *  @author        	Jose Flores <jose.flores.152@gmail.com>
     *  
     *  This file holds the file class, it manages file upload and downloads
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
		/**
		 * 	@name __construct
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
		 * 	@name upload
		 * 
		 * 	This function uploads a file
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
			// Try to connect to database
			try {	
				// attempt database connection
				$A = $this->A ;
				$A[ 'M_DB' ] = 'csr_d' ;
				$DB = new mysql( $A ) ;	
			}
			catch ( exception $e ) {
				// connection error
				return 9 ;
			}
			
			// Create keyPairs
			$keyPairs[ 'csr_d_f_usr_id' ] 	= CURRENT_USER_ID ;
			$keyPairs[ 'csr_d_f_time' ] 	= $timeStamp ;	
			$keyPairs[ 'csr_d_f_src' ] 		= CURRENT_WEB_OR_MFA ;
			$keyPairs[ 'csr_d_f_src_id' ] 	= CURRENT_SRC_ID ;	
			$keyPairs[ 'csr_d_f_mime' ] 	= $files[ 'file' ][ 'type' ] ;	
			$keyPairs[ 'csr_d_f_path' ] 	= $filePath ;
			$keyPairs[ 'csr_d_f_name' ] 	= $fileName ;
			
			$table = 'csr_d_files' ;
			//	Insert into database
			$DB->insert( $table , $keyPairs ) ;

			// Success
			return 0 ; 
		}
		
		/**
		 * 	@name download
		 * 
		 * 	This function downloads a file
		 * 
		 */
		public function download( ){}
	}
	

	/*
	// Resolving relative web paths
	
	$A[ 'W_ROOT' ] = 'josefflores.com/csr/' ;
	$A[ 'D_ROOT' ] = 'F:\\Github\\csr\\' ;

	
	$A[ 'SECURE' ] = false ;
	include( '..\\ini\\paths.php' ) ;
	include( $A[ 'D_TMP' ] . 'includes.php' ) ;

	errorsOn( true) ;
	
	define( 'CURRENT_USER_ID' , 1 ) ;
	define( 'CURRENT_SRC_ID' , null ) ;
	define( 'CURRENT_WEB_OR_MFA' , 'WEB' ) ;


	var_dump( $_FILES ) ;
	$file = new fManager( $A ) ;
	echo  $file->upload( $_FILES[ 'file' ][ 'name' ] ) ;
*/


	
?>
