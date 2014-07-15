/**
 *  @File			library.js
 * 	@Authors		Jose Flores
 * 					jose.flores.152@gmail.com
 * 	
 * 	@Description	This is JavaScript/ jQuery custom library, it contains 
 * 					the function for this application
 * 
 * 	@changelog		
 * 	4/20/14			Wrote library.js, API class, converted addTab to use 
 * 					API
 */
 
/**
 * 	@name Api
 * 
 * 	This class holds the API
 */
function Api( apiPath ) {
	// 	Variables
	var path = apiPath ;
	var lastCall =  null ;
	var lastResponse = null ;	
	
	// 	FUNCTIONS
	
	/**
	 * 
	 * 	call
	 * 
	 * 	This function generates a JSON API string and submits it to the 
	 * 	API
	 * 
	 * 	@true	succesful cal
	 * 
	 * 	@false	api error
	 */
	this.call = function ( order , call , argv ) {
		//	VARIABLES
		var request ;	// Will hold the JSON string request
		
		//	Generate andd store call
		lastCall = [{"order":order,"call":call,"parameter":argv}] ;

		// 	Send API request
		$.ajax({
			type: "POST",
			url: path , 				// 	Target API
			dataType : 'json',
			data: { JSON : lastCall } ,			//	The API string
			async: false ,				// 	Wait for a response
			cache: false 				//	Do not store results
		})
		//	Upon completion of the request
		.done( function( tmp ) {		
			// 	Store results
			lastResponse = tmp ;	
		}) ;

		if ( this.state() == STATE.OK ) 
			return true ;
		else
			return false ;			
	} ;
	
	/**
	 * 	state
	 * 
	 * 	This function determines wether the last API call was succesful
	 * 	or not, it also logs the response code to the console
	 * 
	 * 	@return		NONE			The API has not been called yer
	 * 	@return 	OK				The return code was that of success
	 * 	@return 	ERROR			The return code signifies an error	
	 */
	this.state = function () {
		var json ;
		// 	Check if the API is still in the initial state
		if ( lastResponse == null )
			return STATE.NONE ;
		
		//	store the obj in a tmp object
		json = lastResponse ;
		
		// Log response
		console.log( 'API  >> ' + json[0][ 'code' ] ) ;
		
		// 	Check if the api had returned success
		if ( json[0][ 'code' ][0] >= 200 &&
			 json[0][ 'code' ][0] < 300 )
				// reurn succes
				return STATE.OK ;
		
		// 	Notify of Error
		return STATE.ERROR ;
	} ;
	
	/**
	 * 	@name	data
	 * 
	 * 	This function gets the returned data
	 * 
	 * 	@return true, size, data	There are [size] elements of data 
	 * 								returned
	 * 	@return false, null, null	There was no data returned
	 */
	this.data = function (){
		
		// 	Set default return 
		var arr = [ false , 
					null ,
					null ] ;

		//	store the obj in a tmp object
		json = lastResponse ;
		
		//	Check to make sure there is a returned value
		if ( lastResponse[0]['code'][0] == 200 ) {
			
			// 	The success indicator
			arr[ 0 ] = true ;
			
			// 	Getting the number of values, due to a string being an 
			// 	array  .lenght can not simply be used. rather the implicit 
			//	array check must be used. followed by a manual setting of 
			//	1 to indicate an array of 1 string
			if ( json[0]['values']  instanceof Array ) {
				arr[ 1 ] = json[0]['values'].length ;
			}
			else {
				arr[ 1 ] = 1 ;
			}
			
			//	Storing the data
			arr[ 2 ] = json[0]['values'] ;
		}
		
		return arr ;
	} ;

	/**
	 *	@name	registerUser 	
	 * 
	 * 	This function registers a user through the apo
	 * 
	 * 	@return 0	Success
	 * 	@return 1	Failure validating form
	 * 	@return 2	Rejected by api
	 */
	this.registerUser = function() {
		
		// Get Registration Form
		var parent = 'sec-registration-' ;
		
		var email 				= $.trim( $( '#' + parent + 'email' ).val() ) ;
		var usr_name_first 		= $.trim( $( '#' + parent + 'first-name' ).val() ) ;
		var usr_name_middle 	= $.trim( $( '#' + parent + 'middle-name' ).val() ) ;
		var usr_name_last 		= $.trim( $( '#' + parent + 'last-name' ).val() ) ;
		var usr_phone_country 	= $.trim( $( '#' + parent + 'phone-country' ).val() ) ;
		var usr_phone_area 		= $.trim( $( '#' + parent + 'phone-area' ).val() ) ;
		var usr_phone_number_1 	= $.trim( $( '#' + parent + 'phone-1' ).val() ) ;
		var usr_phone_number_2 	= $.trim( $( '#' + parent + 'phone-2' ).val() ) ;
		var usr_phone_ext 		= $.trim( $( '#' + parent + 'phone-ext' ).val() ) ;
		var usr_pwd_1 			= $.trim( $( '#' + parent + 'password-1' ).val() ) ;
		var usr_pwd_2 			= $.trim( $( '#' + parent + 'password-2' ).val() ) ;
		var usr_dob_1 			= $.trim( $( '#' + parent + 'date-month' ).val() ) ;
		var usr_dob_2 			= $.trim( $( '#' + parent + 'date-day' ).val() ) ;
		var usr_dob_3 			= $.trim( $( '#' + parent + 'date-year' ).val() ) ;
		
	
		// Validate Fields
		var ret = false ;
		
		// reset borders
		
		// Validate email
		if( !this.validateField( parent ,
							'email' ,
							email ,
							'regexEmail' ) ) 
								ret = true ;
			
		// Validate Name
		if( !this.validateField( parent ,
							'first-name' , 
							usr_name_first , 						
							'regexText' ) ) 
								ret = true ;
			
		if( usr_name_middle != '' &&
			!this.validateField( parent ,
							'middle-name' ,
							usr_name_middle , 
							'regexText' ) ) 
								ret = true ;
			
		if( !this.validateField( parent ,
							'last-name' , 
							usr_name_last , 
							'regexText' ) ) 
								ret = true ;
		
		// Validate Phone
		if( !this.validateField( parent ,
							'phone-country' , 
							usr_phone_country , 
							'regexNumber1to3' ) ) 
								ret = true ;
			
		if( !this.validateField( parent ,
							'phone-area' , 
							usr_phone_area , 
							'regexNumber3' ) ) 
								ret = true ;
			
		if( !this.validateField( parent ,
							'phone-1' ,
							usr_phone_number_1 ,
							'regexNumber3' ) ) 
								ret = true ;
								
		if( !this.validateField( parent ,
							'phone-2' ,
							usr_phone_number_2 , 
							'regexNumber4' ) ) 
								ret = true ;
				
		if( !this.validateField( parent ,
							'phone-ext' , 
							usr_phone_ext , 
							'regexNumber0to4' ) ) 
								ret = true ;
			
		// Validate Password
		if( !this.validateField( parent ,
							'password-1' , 
							usr_pwd_1 , 
							'regexPassword' ) ) 
								ret = true ;
			
		if( !this.validateField( parent ,
							'password-2' , 
							usr_pwd_2 , 
							'regexPassword' ) ) 
								ret = true ;

		$( '#' + parent + 'password-1' ).removeClass('input-error');
		$( '#' + parent + 'password-2' ).removeClass('input-error');
		
		if ( usr_pwd_1 == '' ) {
			$( '#' + parent + 'password-1' ).addClass('input-error');
			ret = true ;
		}
		

		if ( usr_pwd_2 == '' ) {
			$( '#' + parent + 'password-2' ).addClass('input-error');
			ret = true ;
		}
			

		if ( usr_pwd_1 != usr_pwd_2 ) {	
				$( '#' + parent + 'password-1' ).addClass('input-error');
				$( '#' + parent + 'password-2' ).addClass('input-error');
				ret = true ;
		}
			
		// Validate DOB	
		if( !this.validateField( parent ,
							'date-month' ,
							usr_dob_1 , 
							'regexDateMonth' ) ) 
								ret = true ;
								
		if( !this.validateField( parent ,
							'date-day' ,
							usr_dob_2 , 
							'regexDateDay' ) ) 
								ret = true ;
		
		if( !this.validateField( parent ,
							'date-year' ,
							usr_dob_3 , 
							'regexDateYear' ) ) 
								ret = true ;
		// Respond with Error
		if ( ret ) { 
			console.log( 'ERROR >> api.registerUser >> 1' ) ;
			$( "#dialog" ).html( '<P> <span class="ui-icon ui-icon-alert"></span> Error Processing Form. </p>' ) ;
			$( "#dialog" ).dialog('option', 'title', 'Error');
			$( '#dialog p' ).addClass('ui-state-error') ;
			$( "#dialog" ).dialog("open") ;
			return 1 ;
		}
		
		// Submit Fields
		var order = 1 ;
		var call = "registerUser" ;
		var parameters = [{ "usr_email" : email , 
			               "usr_name_first" : usr_name_first ,
				           "usr_name_middle" : usr_name_middle ,
			               "usr_name_last" : usr_name_last ,
				           "usr_phone_country" : usr_phone_country ,
			               "usr_phone_area" : usr_phone_area ,
			               "usr_phone_number" : usr_phone_number_1 + usr_phone_number_2 ,
			               "usr_phone_ext" : usr_phone_ext ,
			               "usr_pwd_1" : usr_pwd_1 ,
			               "usr_pwd_2" : usr_pwd_2 ,
			               "usr_dob" : usr_dob_3 + '-' + usr_dob_1 + '-' + usr_dob_2 }] ;
		
		// Process return 	               
		if ( this.call( order , call , parameters ) ) {
			// User Registered
			$( "#dialog" ).html( '<P> User was succesfully registered. </p>' ) ;
			$( "#dialog" ).dialog('option', 'title', 'Confirmation');
			$( '#dialog p' ).removeClass('ui-state-error') ;
		$( "#dialog" ).dialog("open") ;
			return 0 ;
		}
		
		// User Notification
		$( "#dialog" ).html( '<P> <span class="ui-icon ui-icon-alert"></span> User could not be registered. </p>' ) ;
		$( '#dialog p' ).addClass('ui-state-error') ;
		$( "#dialog" ).dialog('option', 'title', 'Error');
		$( "#dialog" ).dialog("open") ;
		console.log( 'ERROR >> api.registerUser >> 2' ) ;
		return 2 ;
			
		
	} ;
	
	/**
	 * 	@name 	validateField
	 * 
	 * 	This function validates inputs througha  regex
	 * 
	 * 	@param	parent	the holding form extension
	 * 	@param 	id		The input id
	 *  @param	data	The value of the input
	 * 	@param 	regex	The regex to use for validation
	 * 
	 * 	@return	true	Validated input
	 * 	@return false	Invalid input
	 */
	this.validateField = function( parent , id , data , regex ) {
		
		var regexEmail 				= new RegExp( "^([a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?)$" ) ;
		var regexNumber1to3 		= new RegExp( '^(\\d{1,3})$' ) ;
		var regexNumber3 			= new RegExp( '^(\\d{3})$' ) ;
		var regexNumber4 			= new RegExp( '^(\\d{4})$' ) ;
		var regexNumber7 			= new RegExp( '^(\\d{7})$' ) ;
		var regexNumber0to4		 	= new RegExp( '^(\\d{0,4})$' ) ;
		var regexPassword 			= new RegExp( '^(?=.*[0-9])(?=.*[!@#$%^&*])(?=.*[A-Z])[a-zA-Z0-9!@#$%^&*]{8,20}$' ) ;
		var regexDate 				= new RegExp( '^(0[1-9]|1[012])(0[1-9]|[12][0-9]|3[01])((19|20)[0-9][0-9])$' ) ;
		var regexDateMonth			= new RegExp( '^(0[1-9]|1[012])$' ) ;
		var regexDateDay			= new RegExp( '^(0[1-9]|[12][0-9]|3[01])$' ) ;
		var regexDateYear			= new RegExp( '^((19|20)[0-9][0-9])$' ) ;
		var regexText 				= new RegExp( '^(?!\s*$).+' ) ;
		
		switch ( regex ) {
		case 'regexEmail' : 
			regex = regexEmail ;
			break ;
		case 'regexNumber1to3' : 
			regex = regexNumber1to3 ;
			break ;
		case 'regexNumber3' : 
			regex = regexNumber3 ;
			break ;
		case 'regexNumber4' : 
			regex = regexNumber4 ;
			break ;
		case 'regexNumber7' : 
			regex = regexNumber7 ;
			break ;
		case 'regexNumber0to4' :
			regex = regexNumber0to4 ;
			break ;
		case 'regexPassword' : 
			regex = regexPassword ;
			break ;
		case 'regexDate' : 
			regex = regexDate ;
			break ;
		case 'regexDateMonth' : 
			regex = regexDateMonth ;
			break ;
		case 'regexDateDay' : 
			regex = regexDateDay ;
			break ;
		case 'regexDateYear' : 
			regex = regexDateYear ;
			break ;
		case 'regexText' : 			
			regex = regexText ;
			break ;
		default :
			return false ;
		}
		
		$( '#' + parent + id ).removeClass('input-error');
		// Check against regex
		if( !regex.test( data ) ) {
			// log error
			$( '#' + parent + id ).addClass('input-error');
			console.log( 'ERROR: ' + id + ' : ' + data ) ;
			return false ;
		} else {
			// success
			return true ;
		}	
	} ;
	
	/**
	 *  @name authenticateUser
	 * 
	 * 	This function logs a user in
	 * 
	 * 	@return	true	user was logged in 
	 * 	@return false	User was not logged in
	 */
	this.authenticateUser = function( parameters ) {
		
		// Get Registration Form
		var parent = 'sec-login-' ;
		
		//get fields
		var usr_pwd_1 			= $.trim( $( '#' + parent + 'password-1' ).val() ) ;
		var email 				= $.trim( $( '#' + parent + 'email' ).val() ) ;

		// Validate Fields
		var ret = false ;
		
		// Validate email
		if( !this.validateField( parent ,
							'email' ,
							email ,
							'regexEmail' ) ) 
								ret = true ;
		// validate password
		if( !this.validateField( parent ,
							'password-1' , 
							usr_pwd_1 , 
							'regexPassword' ) ) 
								ret = true ;
		
		// respond with error
		if ( ret ) { 
			console.log( 'ERROR >> api.authenticateUser >> 1' ) ;
			$( "#dialog" ).html( '<P> <span class="ui-icon ui-icon-alert"></span> Error Processing Form. </p>' ) ;
			$( "#dialog" ).dialog('option', 'title', 'Error');
			$( '#dialog p' ).addClass('ui-state-error') ;
			$( "#dialog" ).dialog("open") ;
			return 1 ;
		}
														 
		var order = 1 ;
		var call = 'authenticateUser' ;
		var parameters = [{ "usr_email" : email , 
			               "usr_pwd_1" : usr_pwd_1 }] ;
		
		// Process return 	               
		if ( this.call( order , call , parameters ) ) {
			// User Registered
			$( "#dialog" ).html( '<P> User was succesfully logged in. </p>' ) ;
			$( "#dialog" ).dialog('option', 'title', 'Confirmation');
			$( '#dialog p' ).removeClass('ui-state-error') ;
			$( '#dialog' ).bind( 'dialogclose', function( event ) {
				window.location.replace( webRoot + 'profile/' ) ;
			} ) ;
			$( "#dialog" ).dialog("open") ;
			return 0 ;
		}
		
		// User Notification
		$( "#dialog" ).html( '<P> <span class="ui-icon ui-icon-alert"></span> User could not be logged in. </p>' ) ;
		$( "#dialog" ).dialog('option', 'title', 'Error');
		$( '#dialog p' ).addClass('ui-state-error') ;
		$( "#dialog" ).dialog("open") ;
		console.log( 'ERROR >> api.authenticateUser >> 2' ) ;
		return 2 ;
	} ;
	
	/**
	 *  @name deauthenticateUser
	 * 
	 * 	This function logs a user out
	 * 
	 * 	@return	0		user was logged out
	 * 	@return 1		User was not logget out
	 */
	this.deauthenticateUser = function() {
																 
		var order = 1 ;
		var call = 'deauthenticateUser' ;
		var parameters = null ;
		
		// Process return 	               
		if ( this.call( order , call , parameters ) ) {
			// User Registered
			$( "#dialog" ).html( '<P> User was succesfully logged out . </p>' ) ;
			$( "#dialog" ).dialog('option', 'title', 'Confirmation');
			$( '#dialog p' ).removeClass('ui-state-error') ;
			$( '#dialog' ).bind( 'dialogclose', function( event ) {
				window.location.replace( webRoot ) ;
			} ) ;
			$( "#dialog" ).dialog("open") ;
			return 0 ;
		}
		
		// User Notification
		$( "#dialog" ).html( '<P> <span class="ui-icon ui-icon-alert"></span> User could not be logged out. </p>' ) ;
		$( "#dialog" ).dialog('option', 'title', 'Error');
		$( '#dialog p' ).addClass('ui-state-error') ;
		$( "#dialog" ).dialog("open") ;
		console.log( 'ERROR >> api.deauthenticateUser >> 1' ) ;
		return 2 ;
	} ;
	
	/**
	 * 	@name 	sendmail
	 * 	
	 * 	This function sends a contact form email
	 * 
	 * 	@return	0	Success
	 * 	@return	1	bad form
	 * 	@return 2	api error
	 */
	this.sendMail = function( ) {
		var name = $( '#contact-form-name' ).val() ;
		var email = $( '#contact-form-email' ).val() ;
		var subject = $( '#contact-form-subject' ).val() ;
		var text = $( '#contact-form-text' ).val() ;
		
		var parent = 'contact-form-' ;
		var ret = false ;
		
		// Validate email
		if( !this.validateField( parent ,
								'email' ,
								email ,
								'regexEmail' ) ) 
									ret = true ;
										
		// Validate name
		if( !this.validateField( parent ,
								'name' ,
								name ,
								'regexText' ) ) 
									ret = true ;
									
		// Validate subject
		if( !this.validateField( parent ,
								'subject' ,
								subject ,
								'regexText' ) ) 
									ret = true ;
									
		// Validate name
		if( !this.validateField( parent ,
								'text' ,
								text ,
								'regexText' ) ) 
									ret = true ;
		
		// respond with error
		if ( ret ) { 
			console.log( 'ERROR >> api.sendMail >> 1' ) ;
			$( "#dialog" ).html( '<P> <span class="ui-icon ui-icon-alert"></span> Error processing contact form. </p>' ) ;
			$( "#dialog" ).dialog('option', 'title', 'Error');
			$( '#dialog p' ).addClass('ui-state-error') ;
			$( "#dialog" ).dialog("open") ;
			return 1 ;
		}
														 
		var order = 1 ;
		var call = 'sendMail' ;
		var parameters = [{ "email" : email , 
							"name"	: name ,
							"subject" : subject ,
							"text" : text   }] ;
		
		// Process return 	               
		if ( this.call( order , call , parameters ) ) {
			// User Registered
			$( "#dialog" ).html( '<P> Mail was sent. </p>' ) ;
			$( "#dialog" ).dialog('option', 'title', 'Confirmation');
			$( '#dialog p' ).removeClass('ui-state-error') ;
			$( "#dialog" ).dialog("open") ;
			return 0 ;
		}
		
		// User Notification
		$( "#dialog" ).html( '<P> <span class="ui-icon ui-icon-alert"></span> Mail could not be sent. </p>' ) ;
		$( "#dialog" ).dialog('option', 'title', 'Error');
		$( '#dialog p' ).addClass('ui-state-error') ;
		$( "#dialog" ).dialog("open") ;
		console.log( 'ERROR >> api.sendMail >> 2' ) ;
		return 2 ;
	} ;
}

/**
 * 	@name	toolbar_menu_item
 * 
 * 	This is the toolbar menu function switch, it handles the operations
 * 	in the toolbar-menu PHP widget.
 * 
 * 	@param 	0			Add a tab to the profile
 * 	@param 	*			Do nothing
 */
function toolbar_menu_item( item ) {
	// Determine operation
	switch( item ) { 
		// Create a tab
		case '0' :
			addTab();
			break ;
			
		
		// Do nothing
		default : 
			break ;
	}
}

/**
 * 	@name	addTab
 * 
 * 	This function adds a tab to the profile 
 */
function addTab() {
	
	// 	Call the profile-generator widget
	api.call( 1 , 'getWidget' , [ 'profile-generator' ] , null ) ;
	
	// 	Get the data returned
	var tmp = api.data() ;
	
	// 	Generate the tab button
	var msg = '' ,		
		label = tabCounter,
		id = "tabs-" + tabCounter,
		li = $( tabTemplate.replace( /#\{linkId\}/g, "link-" + id ).replace( /#\{href\}/g, "#" + id ).replace( /#\{label\}/g, label ) );	

	// 	Attach the profile
	tabs.find( ".ui-tabs-nav" ).append( li );
	tabs.append( "<div id='" + id + "'>" + tmp[2] + "</div>" );
	tabs.tabs( "refresh" );
	
	// 	Set focus to newest tab created
	$("#link-" + id).trigger('click');
	
	// update the number of tabs created
	tabCounter++;
}


