<?php

	/**
	 * This file contains the widget class
	 */
	
	if ( !defined( 'secRegistration' ) )  {
		
		define( 'secRegistration' , TRUE ) ;
		
		class secRegistration {
			private $form ;
			private $name ;
			
			public function __construct(  ) {
			
			}
			
			public function getForm( $name , $form ) {
				$str = $this->startForm( $name ) ;
				$str.= $this->genForm( $form ) ;
				$str.= $this->endForm() ;
				return $str ;
			}
			public function startForm( $name ) {
				$str = '' ;
				$str .= '<form name="' . $name . '" id="' . $name . '" >' ;
				return $str ;
			}
			
			public function genForm( $form ) {
				$parent = 'sec-registration-' ;
				
				$str = '' ;
				
				$str .= '<table class="form">' ;
				
				$str .= '<tr class="sec-registration-line">	<td colspan="2"><h3> Register</h3></td></tr>' ;
					
					$str .= $this->input( $parent , 'Email' 					, array( array( 'class' => 'input-text' , 'id' => 'email' , 'type' => 'text' , 'required' => true ) ) ) ;
					$str .= $this->input( $parent , 'First Name' 				, array( array( 'class' => 'input-text' , 'id' => 'first-name' , 'type' => 'text' , 'required' => true ) ) ) ;
					$str .= $this->input( $parent , 'Middle Name' 				, array( array( 'class' => 'input-text' , 'id' => 'middle-name' , 'type' => 'text' , 'required' => true ) ) ) ;
					$str .= $this->input( $parent , 'Last Name' 				, array( array( 'class' => 'input-text' , 'id' => 'last-name' , 'type' => 'text' , 'required' => true ) ) ) ;
				
					$str .= $this->input( $parent , 'Password' 					, array( array( 'class' => 'input-text' , 'id' => 'password-1' , 'type' => 'password' , 'required' => true ) ) ) ;
					$str .= $this->input( $parent , 'Confirm Password' 			, array( array( 'class' => 'input-text' , 'id' => 'password-2' , 'type' => 'password' , 'required' => true ) ) ) ;
					
					$str .= $this->input( $parent , 'Date of Birth MM DD YYYY ' , array( array( 'class' => 'input-text-2' , 'id' => 'date-month' , 'type' => 'text' , 'required' => true ) ,
																						 array( 'class' => 'input-text-2' , 'id' => 'date-day' , 'type' => 'text' , 'required' => true ) ,
																						 array( 'class' => 'input-text-4' , 'id' => 'date-year' , 'type' => 'text' , 'required' => true ) ) ) ;
					
					$str .= $this->input( $parent , 'Phone #(###)###-####X#### ', array( array( 'class' => 'input-text-3' , 'id' => 'phone-country' , 'type' => 'text' , 'required' => true ) ,
																						 array( 'class' => 'input-text-3' , 'id' => 'phone-area' , 'type' => 'text' , 'required' => true ) ,
																						 array( 'class' => 'input-text-3' , 'id' => 'phone-1' , 'type' => 'text' , 'required' => true ) ,
																						 array( 'class' => 'input-text-4' , 'id' => 'phone-2' , 'type' => 'text' , 'required' => true ) ,
																						 array( 'class' => 'input-text-4' , 'id' => 'phone-ext' , 'type' => 'text' , 'required' => false ) ) ) ;
																						 									
				$str .= '<tr class="sec-registration-line"><td></td><td><button onclick="api.registerUser(); return false ; " >Register</button></td></tr></table>' ;
					
				return $str ;
			}
			
			private function input( $parent , $title , $items ) {
				$str =  '<tr class="sec-registration-line"><td>' . $title . '</td><td>' ;
				
				foreach( $items as $item ){
					
					$str .= '<input class="'. $parent . $item[ 'class' ] ;
					if ( $item[ 'required' ]) 
						$str .= ' ' . $parent . 'required' ;
					$str .='" id="'. $parent . $item[ 'id' ] . '" name="'. $parent . $item[ 'id' ] . '" type="'. $item[ 'type' ] .'"/>' ;
				}
				
				$str .= '</td></tr>' ;
				
				return $str ;
			}
			
			public function endForm() {
				$str = '' ;
				$str .= '</form>' ;
				return $str ;
			}
		}
	}
	
	// create an instance of the widget
	
	$WGT['OBJ'] = new secRegistration() ;
