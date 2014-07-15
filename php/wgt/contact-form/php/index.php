<?php

	/**
	 * This file contains the widget class
	 */
	
	if ( !defined( 'contactForm' ) )  {
		
		define( 'contactForm' , TRUE ) ;
		
		class contactForm {
			
			public function __construct( ) {
				
			}
			
			public function getForm(  $formLines , $formId ){
				
				$str =  '<div class="formInput">' ;
				
				foreach ( $formLines as $tmp ) {
					$str .=	$this->getFormLine( $tmp[0] , $formId.'-'.$tmp[1] , $tmp[2] ) ;
				}
				
				$str .=	'</div>' ;
					
				$str .= $this->getFormBox( $formId.'-text' ) ;
				
				$str .= $this->getSubmitButton( 'Submit' , $formId.'-submit' , 'api.sendMail(); return false' ) ;
				return  $str ;
						
			}
			public function getFormLine( $title , $id , $hidden ) {
				if( $hidden ) $str = '<input type="hidden" id="'.$id.'" name="'.$id.'" />' ;
				else $str = '<div class="formLine"><div class="formTitle">'.$title.'</div><input id="'.$id.'" name="'.$id.'" /></div>' ;
				return $str ;	
			}
			public function getFormBox( $id ) {
				$str = '<br/><textarea id="'.$id.'" name="'.$id.'"></textarea>';
				return $str ;	
			}
			
			public function getSubmitButton( $title , $id , $onClick ) {
				$str = '<div class=\"formSubmission\"><br/><button id="'.$id.'" onclick="'.$onClick.';">'.$title.'</button></div>' ;
				return $str ;
			}
		}
	}
	
	// create an instance of the widget
	
	$WGT['OBJ'] = new contactForm ;
?>
