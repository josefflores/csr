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
					
					$info = 'This will be your user name.' ;
					$str .= $this->input( $parent , 'Email' 			, $info ,		array( array( 'class' => 'input-text' , 'length' => 0 , 'id' => 'email' , 'type' => 'text' , 'required' => true , 'b' => '' , 'a' => '' ) ) ) ;
					
					$info = '' ;
					$str .= $this->input( $parent , 'First Name' 		, $info ,		array( array( 'class' => 'input-text' , 'length' => 0 ,'id' => 'first-name' , 'type' => 'text' , 'required' => true  , 'b' => '' , 'a' => '' ) ) ) ;
					
					$info = 'Middle names or Initial are optional, but they might help differentiate common names to staff upon quick visual inspection.' ;
					$str .= $this->input( $parent , 'Middle Name' 		, $info ,		array( array( 'class' => 'input-text' , 'length' => 0 ,'id' => 'middle-name' , 'type' => 'text' , 'required' => true  , 'b' => '' , 'a' => '') ) ) ;
					
					$info = '' ;
					$str .= $this->input( $parent , 'Last Name' 		, $info ,		array( array( 'class' => 'input-text' , 'length' => 0 ,'id' => 'last-name' , 'type' => 'text' , 'required' => true  , 'b' => '' , 'a' => '') ) ) ;
				
					$info = 'Passwords must include one lowercase letter, one capital letter, one special character, and one number. The password should be between 8 - 20 characters long.' ;
					$str .= $this->input( $parent , 'Password' 			, $info ,		array( array( 'class' => 'input-text' , 'length' => 0 ,'id' => 'password-1' , 'type' => 'password' , 'required' => true  , 'b' => '' , 'a' => '') ) ) ;
					
					$info = '' ;
					$str .= $this->input( $parent , 'Confirm Password' 	, $info ,		array( array( 'class' => 'input-text' , 'length' => 0 ,'id' => 'password-2' , 'type' => 'password' , 'required' => true  , 'b' => '' , 'a' => '') ) ) ;
					
					$info = 'The date of birth format should be MM/DD/YYYY.' ;
					$str .= $this->input( $parent , 'Date of birth ' 	, $info , 		array( array( 'class' => 'input-text-2' , 'length' => '2' ,'id' => 'date-month' , 'type' => 'text' , 'required' => true  , 'b' => '' , 'a' => ' / ') ,
																							array( 'class' => 'input-text-2' , 'length' => '2' ,'id' => 'date-day' , 'type' => 'text' , 'required' => true  , 'b' => '' , 'a' => ' / ') ,
																							array( 'class' => 'input-text-4' , 'length' => '4' ,'id' => 'date-year' , 'type' => 'text' , 'required' => true  , 'b' => '' , 'a' => '') ) ) ;
					
					$info = 'The contact phone number should include the country code, area code, and the seven digits phone number. The extension is optional.' ;
					$str .= $this->input( $parent , 'Contact phone '	, $info ,  		array( array( 'class' => 'input-text-3' , 'length' => '3' ,'id' => 'phone-country' , 'type' => 'text' , 'required' => true , 'b' => '' , 'a' => '' ) ,
																							array( 'class' => 'input-text-3' , 'length' => '3' ,'id' => 'phone-area' , 'type' => 'text' , 'required' => true  , 'b' => ' ( ' , 'a' => ' ) ') ,
																							array( 'class' => 'input-text-3' , 'length' => '3' ,'id' => 'phone-1' , 'type' => 'text' , 'required' => true , 'b' => '' , 'a' => '' ) ,
																							array( 'class' => 'input-text-4' , 'length' => '4' ,'id' => 'phone-2' , 'type' => 'text' , 'required' => true , 'b' => ' - ' , 'a' => '' ) ,
																							array( 'class' => 'input-text-4' , 'length' => '4' ,'id' => 'phone-ext' , 'type' => 'text' , 'required' => false , 'b' => ' EXT ' , 'a' => '' ) ) ) ;
																						 									
				$str .= '<tr class="sec-registration-line"><td><br/><button onclick="api.registerUser(); return false ; " >Register</button></td></tr></table>' ;
					
				return $str ;
			}
			
			private function input( $parent ,  $title ,$info , $items ) {
				$str =  '<tr class="sec-registration-line"><td>' . $title . '</td>';
				
				$str .= '<tr><td class="information">' . $info .'</td></tr>' ;
				
				$str .= '<tr class="sec-registration-line"><td>' ;
				
				foreach( $items as $item ){
					
					//if ( $item[ 'b'] != 0 )
						$str .= $item[ 'b' ] ;
					
					$str .= '<input class="'. $parent . $item[ 'class' ] ;
					
					if ( $item[ 'required' ]) 
						$str .= ' ' . $parent . 'required' ;
					
					$str .='"' ;
					
					if ( $item[ 'length' ] != 0 )
						$str .= ' maxlength="'.$item[ 'length' ].'" ' ;
						
						
					$str .= 'id="'. $parent . $item[ 'id' ] . '" name="'. $parent . $item[ 'id' ] . '" type="'. $item[ 'type' ] .'"/>' ;
					
					//if ( $item[ 'a'] != 0 )
						$str .= $item[ 'a' ] ;
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
