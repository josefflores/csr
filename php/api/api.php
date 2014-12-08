<?php
    /**
     *  @author     Jose Flores <jose.flores.152@gmail.com>
     *
     *  This api needs the library and configuration file to be included
     *  before it is.
     */

    define( 'API_EVENT_ID' , time() ) ;
    /**
     *  api
     *
     *  This is tha application API, It will be used for all
     *  application communications.
     */
    class api {

        //  VARIABLES

        private $A ;

        //  Functions

        /**
         *  @name       __construct
         *
         *  Requires authentication : false
         *
         *  The API constructor
         *
         *  $apiObj = new api( $A ) ;
         *
         *  @param  $A  The global configuration, needed for file path
         *              information
         */
        public function __construct( $A ) {
            $this->A = $A ;
            ini_set( "log_errors", 1);
            ini_set( "error_log", $A[ 'D_ROOT' ] . "php-error.log");

        }

        //  HIDDEN OR PRIVATE METHODS

        /**
         *  @name       setReturn
         *
         *  Requires authentication : false
         *
         *  This function generates the return messages for the api
         *
         *  $apiObj->setReturn( '200' ) ;
         *
         *  $apiObj->setReturn( '200' , array( val1 [ , ... ] ) ) ;
         *
         *  $apiObj->setReturn( '200' , array( val1 [ , ... ] ) , array( 'content' [ , ... ] ) ;
         *
         *  @param  $num        The response code
         *  @param  $val        Any return messages
         *  @param  $ret        Any return values
         *
         *  @return the return message array
         */
        public function setReturn( $num , $val = null , $ret = null ) {
            switch ( $num ) {

                //  Informational

                case 100 : $values = array( 100 , 'Continue' ) ; break ;
                case 101 : $values = array( 101 , 'Switching Protocols' ) ; break ;
                case 102 : $values = array( 102 , 'Processing' ) ; break ;

                //  Success

                case 200 : $values = array( 200 , 'OK' ) ; break ;
                case 201 : $values = array( 201 , 'Created' ) ; break ;
                case 202 : $values = array( 202 , 'Accepted' ) ; break ;
                case 203 : $values = array( 203 , 'Non-Authoritative Information' ) ; break ;
                case 204 : $values = array( 204 , 'No Content' ) ; break ;
                case 205 : $values = array( 205 , 'Reset Content' ) ; break ;
                case 206 : $values = array( 206 , 'Partial Content' ) ; break ;
                case 207 : $values = array( 207 , 'Multi-Status' ) ; break ;
                case 208 : $values = array( 208 , 'Already Reported' ) ; break ;
                case 226 : $values = array( 226 , 'IM Used' ) ; break ;

                //  Redirect

                case 300 : $values = array( 300 , 'Multiple Choices' ) ; break ;
                case 301 : $values = array( 301 , 'Moved Permanently' ) ; break ;
                case 303 : $values = array( 303 , 'See Other' ) ; break ;
                case 304 : $values = array( 304 , 'Not Modified' ) ; break ;
                case 305 : $values = array( 305 , 'Use Proxy' ) ; break ;
                case 306 : $values = array( 306 , 'Switch Proxy' ) ; break ;
                case 307 : $values = array( 307 , 'Temporary Redirect' ) ; break ;
                case 308 : $values = array( 308 , 'Permanent Redirect' ) ; break ;

                // Client Error

                case 400 : $values = array( 400 , 'Bad Request' ) ; break ;
                case 401 : $values = array( 401 , 'Unauthorized' ) ; break ;
                case 402 : $values = array( 402 , 'Payment Required' ) ; break ;
                case 403 : $values = array( 403 , 'Forbidden' ) ; break ;
                case 404 : $values = array( 404 , 'Not Found' ) ; break ;
                case 405 : $values = array( 405 , 'Method Not Allowed' ) ; break ;
                case 406 : $values = array( 406 , 'Not Acceptable' ) ; break ;
                case 407 : $values = array( 407 , 'Proxy Authentication Required' ) ; break ;
                case 408 : $values = array( 408 , 'Request Timeout' ) ; break ;
                case 409 : $values = array( 409 , 'Conflict' ) ; break ;
                case 410 : $values = array( 410 , 'Gone' ) ; break ;
                case 411 : $values = array( 411 , 'Length Required' ) ; break ;
                case 412 : $values = array( 412 , 'Precondition Failed' ) ; break ;
                case 413 : $values = array( 413 , 'Request Entity Too Large' ) ; break ;
                case 414 : $values = array( 414 , 'Request-URI Too Long' ) ; break ;
                case 415 : $values = array( 415 , 'Unsupported Media Type' ) ; break ;
                case 416 : $values = array( 416 , 'Requested Range Not Satisfiable' ) ; break ;
                case 417 : $values = array( 417 , 'Expectation Failed' ) ; break ;
                case 422 : $values = array( 422 , 'Unprocessable Entity' ) ; break ;
                case 423 : $values = array( 423 , 'Locked' ) ; break ;
                case 424 : $values = array( 424 , 'Failed Dependency' ) ; break ;
                case 426 : $values = array( 426 , 'Upgrade Required' ) ; break ;
                case 429 : $values = array( 429 , 'Too Many Requests' ) ; break ;
                case 431 : $values = array( 431 , 'Request Header Fields Too Large' ) ; break ;
                case 498 : $values = array( 498 , 'Token expired/invalid' ) ; break ;

                // Server Errors

                case 501 : $values = array( 501 , 'Not Implemented' ) ; break ;
                case 502 : $values = array( 502 , 'Bad Gateway' ) ; break ;
                case 503 : $values = array( 503 , 'Service Unavailable' ) ; break ;
                case 504 : $values = array( 504 , 'Gateway Timeout' ) ; break ;
                case 505 : $values = array( 505 , 'HTTP Version Not Supported' ) ; break ;
                case 506 : $values = array( 506 , 'Variant Also Negotiates' ) ; break ;
                case 507 : $values = array( 507 , 'Insufficient Storage' ) ; break ;
                case 508 : $values = array( 508 , 'Loop Detected' ) ; break ;
                case 510 : $values = array( 510 , 'Not Extended' ) ; break ;
                case 511 : $values = array( 511 , 'Network Authentication Required' ) ; break ;
                default:
                case 500 : $values = array( 500 , 'Internal Server Error' ) ; break ;
            }

            if ( $val != null ) array_push( $values , $val ) ;

            return array( 'code' => $values ,
                          'return' => $ret ) ;
        }

        /**
         *  @name       getWidgetInstance
         *
         *  Requires authentication : true
         *
         *  This function fetches a widget instance
         *
         *  $this->getWidgetInstance( array( 'wgtName' [ , array( param [ , ... ] ) ) ) ;
         *
         *  @param  $parameters[ 0 ]    The widget name
         *  @param  $parameters[ > 0 ]  The widget parameters
         *
         *  @return 200 The widget is found and being returned
         *  @return 401 Unauthorized
         *  @return 404 Bad request
         */
        private function getWidgetInstance( $parameters ) {
            // If user has been authenticated
            if ( ! defined( 'CURRENT_USER_ID' ) ) {
                return $this->setReturn( 401 , null , null ) ;
            }

            // attempt to find widget
            try {
                $widget = getWGT( $this->A , $parameters ) ;
            }
            catch ( Exception $e ) {
                $this->apiLog( $parameters , $e ) ;
                // failure to find widget
                return $this->setReturn( 404 , null , null ) ;
            }
            //return success
            return $this->setReturn( 200 , null ,  array( $widget ) ) ;
        }

        //  Public METHODS

        /**
         *  @name   getMethodList
         *
         *  Requires authentication : false
         *
         *  This function generates a list of all the available API methods
         *
         *  JSON=[
         *      {
         *          "order": 1,
         *          "call": "getMethodList",
         *                  "parameter": [
         *                  {
         *                          null
         *                      }
         *          ]
         *          }
         *  ]
         *
         *  @return 200     success and a list of available API methods
         */
        public function getMethodList() {

            //  List of public methods that are needed but are not part of API
            $blackList = array( '__construct' , 'setReturn') ;

            $result = array( ) ;

            //  Get all public methods from API
            $list = getPublicMethods( $this->A , 'api' ) ;

            // Check to see if there are no methods, should never
            // happen unless someone has deleted the api functions
            // except for this one or they have added all the other
            // functions to the black list
            if ( count( $list ) <= count( $blackList ) )
                $result[ 0 ] = null ;
            else
                foreach ( $list as $item )
                    // prevent deny values from pupulating
                    if ( !in_array( $item , $blackList ) )
                        array_push( $result , $item ) ;

            return $this->setReturn( 200 , null , $result ) ;
        }

        /**
         *  @name   sendMail
         *
         *  Requires authentication : false
         *
         *  This function sends email, intended for the admin
         *
         *  @param
         *
         *  @return 200     Success
         *  @return 400     Bad Parameters
         *  @return 500     Error mail failure 'admin@' . $this->A[ 'MAIL_FROM_DOMAIN']
         */
         public function sendMail( $parameters ) {

            if( !isset( $parameters[0][ 'EMAIL' ] ) &&
                !isset( $parameters[0][ 'NAME' ] ) &&
                !isset( $parameters[0][ 'SUBJECT' ] ) &&
                !isset( $parameters[0][ 'TEXT' ] ) )
                    return $this->setReturn( 400 , null , null ) ;

            $tmp[ 'from' ] = $this->A[ 'MAIL_FROM_USR']. '@' . $this->A[ 'MAIL_FROM_DOMAIN'] ;
            $tmp[ 'subject' ] = $parameters[0][ 'SUBJECT' ] ;
            $tmp[ 'text' ] = 'FROM: ' . $parameters[0][ 'NAME' ] .' , ' . $parameters[0][ 'EMAIL' ] . ' <br/><br/>' . $parameters[0][ 'TEXT' ];
            $tmp[ 'to' ] = array( 'EMAIL' => 'admin@csr.cs.uml.edu'  , 'NAME' => $parameters[0][ 'NAME' ] ) ;
            $email = new email( $this->A ) ;

            $ret = $email->send( $tmp[ 'from' ] , $tmp[ 'to' ] , $tmp[ 'subject' ] , $tmp[ 'text' ] ) ;

            if ( $ret == 0 ){
                // Succesfull write of the data and record was made
                return $this->setReturn( 200 , 'Mail sent.' , null ) ;
            }

            return $this->setReturn( 500 , 'Mail not sent' , null ) ;

         }
        /**
         *  @name   getWidget
         *
         *  Requires authentication : true
         *
         *  This function generates a success message with the html
         *  widget
         *
         *  JSON=[
         *      {
         *          "order": 1,
         *              "call": "getWidget",
         *                  "parameter": [
         *                  {
         *                          "widget name"
         *                          [ , ... ]
         *                      }
         *          ]
         *          }
         *  ]
         *
         *  @param  $parameters[ 0 ] The widget name
         *  @param  $parameters[ 1 ] optional widget parameters
         *
         *  @return 200     Succes, with widget html
         *  @return 400     Bad Request
         *  @return 401     Unauthorized
         *  @return 404     Resource not found
         */
        public function getWidget( $parameters ) {
            if ( ! defined( 'CURRENT_USER_ID' ) ) {
                return $this->setReturn( 401 , null , null ) ;
            }

            // error checking parameters
            if ( is_array( $parameters ) ) {
                $arr = $parameters ;
            }
            // the arguments were not in an array
            else {
                $arr[ 0 ] = $parameters ;
                $arr[ 1 ] = null ;
            }
            switch ( trim( $arr[ 0 ] ) ) {
                // Missing WGT name
                case '' :
                    return $this->setReturn( 400 , null , null ) ;

                // Returning available widgets
                case 'getWidgetList' :
                    return $this->setReturn( 200 , null , getDirectoryList( $this->A , $this->A[ 'D_WGT' ]) ) ;

                // Finding Widget
                default :
                    //  Including specified widget from generated list
                    $arrOfWidgets = getDirectoryList( $this->A , $this->A[ 'D_WGT' ] ) ;

                    // parse widget list
                    foreach( $arrOfWidgets as $value ) {
                        //  If the widget isfound
                        if ( $value == $arr[ 0 ] ) {
                            // return the widget and codes
                            return $this->getWidgetInstance( $arr ) ;
                        }
                    }

                    //  Widget was not found status being returned
                    return $this->setReturn( 404 , null , null ) ;
            }
        }

        // DATA METHODS

        /**
         *  @name   storeData
         *
         *  Requires authentication : true
         *
         *  This function saves data to the application
         *  data database, allowing the user to chose which table
         *
         *  JSON=[
         *      {
         *          "order": 1,
         *          "call": "storeData",
         *          "parameter": [
         *              {
         *                  "TABLE":"table" ,
         *                  "KEYPAIR":[
         *                      {
         *                          "keyname" : "value"
         *                      }
         *                  ]
         *
         *              }
         *          ]
         *      }
         *  ]
         *
         *  @param  $parameters[ 'TABLE' => 'tableName' , 'KEYPAIR' => array( 'keyName' => 'value' ) ;
         *
         *  @return 201     Created
         *  @return 400     Bad request
         *  @return 401     Unauthorized
         *  @return 404     Not Found
         *  @return 500     Server error
         */
        public function storeData( $parameters ) {
            if ( ! defined( 'CURRENT_USER_ID' ) ) {
                return $this->setReturn( 401 , null , null ) ;
            }

            if( !isset( $parameters[0][ 'TABLE' ] ) &&
                !isset( $parameters[0][ 'KEYPAIR' ] ) )
                    return $this->setReturn( 400 , null , null ) ;


            // Check database connection
            $this->A[ 'M_DB' ] = 'csr_d' ;
            try {
                $tmp = new mysql( $this->A ) ;
            }
            catch ( Exception $e ) {
                // connection error
                return $this->setReturn( 500 , null , null ) ;
            }


            // check table exists
            $table = $parameters[0][ 'TABLE' ] ;
            if ( !$tmp->isTable( $table ) ) {
                // table does not exist
                return $this->setReturn( 404 , null , null ) ;
            }

            // Extract key and value
            $key = key( $parameters[0][ 'KEYPAIR' ][ 0 ]  ) ;
            $value = $parameters[0][ 'KEYPAIR' ][ 0 ][ $key ] ;

            //  Preparing data for storage
            $id = CURRENT_USER_ID ;
            $time = time() ;
            $src = CURRENT_WEB_OR_MFA ;
            $srcId = CURRENT_SRC_ID ;


            // prepare array
            $values = array( 'csr_d_usr_id' => $id ,
                             'csr_d_time' => $time ,
                             'csr_d_src' => $src ,
                             'csr_d_src_id' => $srcId ,
                             'csr_d_key' => $key ,
                             'csr_d_val' => $value ,
                             'csr_d_event_id' => API_EVENT_ID ) ;


            $tmp->insert( $table , $values ) ;

            // Final check for success or failure
            if ( $tmp === 0 ) {
                // Success
                return $this->setReturn( 201 , null , null ) ;
            }
            else {
                return $this->setReturn( 500 , null , null ) ;
            }
        }


        /**
         *  @name   storeFile
         *
         *  Requires authentication : true
         *
         *  This function saves encoded files to the user folder and makes
         *  a record of the transaction in the database file database
         *
         *  JSON=[
         *      {
         *          "order": 1,
         *              "call": "authenticateMFA",
         *                  "parameter": [
         *                  {
         *                          "USR_PHONE": "123456780",
         *                          "USR_TOKEN": "ASDFASDFSADGDRSGDFSDFDFSGSDGSDFGDFGSDFGSDFGSDFGSDFGSDFG"
         *                      }
         *          ]
         *      },
         *      {
         *          "order": 2,
         *          "call": "storeFile",
         *          "parameter": [
         *              {
         *                  "MIME":"mime/type" ,
         *                  "DATA": "ASFDSGSDGSDFGDF...." ,
         *                  "ENCODING": "base64"
         *              }
         *          ]
         *      }
         *  ]
         *
         *  @param  $parameters[0][ 'MIME' ]        mimetype
         *  @param  $parameters[0][ 'DATA' ]        the encoded file
         *  @param  $parameters[0][ 'ENCODING' ]    the encoding used
         *
         *  @return 201     Created
         *  @return 400     Bad request
         *  @return 401     Unauthorized
         *  @return 409     Conflict
         *  @return 415     Invalid File Type
         *  @return 500     Server error
         */
        public function storeFile( $parameters ) {
            file_put_contents( $this->A[ 'D_ROOT' ] . "file.log" ,  var_inspect($parameters[0][ 'MIME' ]) );
            //file_put_contents( $this->A[ 'D_ROOT' ] . "file.log" ,  var_inspect($parameters[0][ 'DATA' ]) );
            //file_put_contents( $this->A[ 'D_ROOT' ] . "file.log" ,  var_inspect($parameters[0][ 'ENCODING' ]) );

            if ( ! defined( 'CURRENT_USER_ID' ) ) {
                return $this->setReturn( 401 , null , null ) ;
            }


            if( !isset( $parameters[0][ 'MIME' ] ) &&
                !isset( $parameters[0][ 'DATA' ] ) &&
                !isset( $parameters[0][ 'ENCODING' ] ) )
                    return $this->setReturn( 400 , null , null ) ;

            $tmp[ 'mime' ] = $parameters[0][ 'MIME' ] ;
            $tmp[ 'data' ] = $parameters[0][ 'DATA' ] ;
            $tmp[ 'encoded' ] = $parameters[0][ 'ENCODING' ] ;

            $file = new fManager( $this->A ) ;

            $ret = $file->decodeB64( $tmp ) ;

            if ( $ret == 0 ){
                // Succesfull write of the data and record was made
                return $this->setReturn( 201 , null , null ) ;
            } else if ( $ret == 1 ) {
                // User not logged in
                return $this->setReturn( 401 , null , null ) ;
            } else if ( $ret == 2 ) {
                //mime not in dictionary
                return $this->setReturn( 415 , array( 'Invalid file type, please make a request for filetype to be added.' ) , null ) ;
            } else if ( $ret == 3 ) {
                //file already exists
                return $this->setReturn( 409 , array( 'File exists' ) , null ) ;
            } else if ( $ret == 4 ) {
                // File was not written
                return $this->setReturn( 500 , array( 'File Could not be written.') , null ) ;
            } else if ( $ret == 5 ) {
                // File was not recorded
                return $this->setReturn( 500 , array( 'File Could not be recorded in database.')  , null ) ;
            } else if ( $ret == 6 ) {
                //Invalid encoding
                return $this->setReturn( 400 , array( 'Invalid encoding, only "base64" allowed' ) , null ) ;
            } else {
                // Unknown response
                return $this->setReturn( 500 , null , null ) ;
            }


        }

        //  USER METHODS

        /**
         *  @name       registerUser
         *
         *  Requires authentication : false
         *
         *  This function registers a user to the application
         *
         *  JSON=[
         *      {
         *          "order": 1,
         *              "call": "registerUser",
         *                  "parameter": [
         *                  {
         *                          "usr_email": "email",
         *                          "usr_name_first": "john",
         *                          "usr_name_middle": "fedrick",
         *                          "usr_name_last": "doe",
         *                          "usr_phone_country": "1",
         *                          "usr_phone_area": "234",
         *                          "usr_phone_number": "5556666",
         *                          "usr_phone_ext": "4444",
         *                          "usr_pwd_1": "Password1",
         *                          "usr_pwd_2": "Password1",
         *                          "usr_dob": "2007-12-31"
         *                      }
         *          ]
         *          }
         *  ]
         *
         *
         * `For regexes Used see user.php, Regex were removed because the were
         *  conflicting with doxygen
         *
         *  @param $parameters[ 0 ][ 'usr_email' ]      The User email
         *  @param $parameters[ 0 ][ 'usr_name_first' ]     The First Name
         *  @param $parameters[ 0 ][ 'usr_name_middle' ]        Middle Name | Initial | Null
         *  @param $parameters[ 0 ][ 'usr_name_last' ]      Last Name
         *  @param $parameters[ 0 ][ 'usr_phone_country' ]  1 - 3 digits
         *  @param $parameters[ 0 ][ 'usr_phone_area' ]     3 digits
         *  @param $parameters[ 0 ][ 'usr_phone_number' ]   7 digits
         *  @param $parameters[ 0 ][ 'usr_phone_ext' ]      1 - 4 digits | Null
         *  @param $parameters[ 0 ][ 'usr_pwd_1' ]      Password String
         *  @param $parameters[ 0 ][ 'usr_pwd_2' ]      Password String Copy for verification
         *  @param $parameters[ 0 ][ 'usr_dob' ]            YYYY-MM-DD
         *
         *  @return 204             Success
         *  @return 400             Bad request
         *  @return 500             Failure
         */
         public function registerUser( $parameters ) {
             if( !isset( $parameters[0][ 'usr_email' ] ) &&
                 !isset( $parameters[0][ 'usr_name_first' ] ) &&
                 !isset( $parameters[0][ 'usr_name_middle' ] ) &&
                 !isset( $parameters[0][ 'usr_name_last' ] ) &&
                 !isset( $parameters[0][ 'usr_phone_country' ] ) &&
                 !isset( $parameters[0][ 'usr_phone_area' ] ) &&
                 !isset( $parameters[0][ 'usr_phone_number' ] ) &&
                 !isset( $parameters[0][ 'usr_phone_ext' ] ) &&
                 !isset( $parameters[0][ 'usr_dob' ] ) &&
                 !isset( $parameters[0][ 'usr_pwd_1' ] ) &&
                 !isset( $parameters[0][ 'usr_pwd_2' ] ) )
                    return $this->setReturn( 400 , null , null ) ;

            $user = new user( $this->A , $parameters[0] ) ;
            $tmp = $user->manage( 'REGISTER' ) ;

            if ($tmp == 2 ) {
                return $this->setReturn( 400 , 'Bad Syntax' , null ) ;
            }

            if ( $tmp === 0 ) {
                // registration succesfull
                return $this->setReturn( 204 , 'Registration succesful' , null ) ;
            }
            // failure
            return $this->setReturn( 500 , 'Registration Failed' , null ) ;
         }

         /**
         *  @name       authenticateUser
         *
         *  Requires authentication : false
         *
         *  This function logs a user in to the website
         *
         *  JSON=[
         *      {
         *          "order": 1,
         *              "call": "authenticateUser",
         *                  "parameter": [
         *                  {
         *                          "usr_email": "email",
         *                          "usr_pwd_1": "Password1",
         *                      }
         *          ]
         *          }
         *  ]
         *
         *  @param $parameters[ 0 ][ 'usr_email' ]  The User email
         *  @param $parameters[ 0 ][ 'usr_pwd_1' ]  Password String
         *
         *  @return 204             Success
         *  @return 400             Bad request
         *  @return 500             Failure
         */
         public function authenticateUser( $parameters ) {
             if( !isset( $parameters[0][ 'usr_email' ] ) &&
                 !isset( $parameters[0][ 'usr_pwd_1' ] ) )
                    return $this->setReturn( 400 , null , null ) ;

            $user = new user( $this->A , $parameters[0] ) ;
            $tmp = $user->manage( 'LOGIN' ) ;

            if ( $tmp === 0 ) {
                // registration succesfull
                $user->manage( 'SESSION' , 'START' ) ;
                return $this->setReturn( 204 , array( 'Authentication succesful' , 'Session started' ) , null ) ;
            }
            // failure
            return $this->setReturn( 500 , 'Authentication failed' , $tmp ) ;
         }

        /**
         *  @name       setPermssions
         *
         *  Requires authentication : true
         *
         *  This function allows a user to manage their permissions
         *
         *  @parameters[ 0 ][ 'TARGET' ]    The user permissions are
         *                                  being given to
         *  @parameters[ 0 ][ 'READ' ]      ( bool ) Read access
         *  @parameters[ 0 ][ 'WRITE' ]     ( bool ) Write access
         *
         *  @return 204     Succes
         *  @return 400     parameter error
         *  @return 401     not authorized
         *  @return 500     Mysql error or server error
         */
         public function setPermissions( $parameters ) {

            if ( ! defined( 'CURRENT_USER_ID' ) ) {
                return $this->setReturn( 401 , null , null ) ;
            }

            if( !isset( $parameters[0][ 'TARGET' ] ) &&
                !isset( $parameters[0][ 'READ' ] ) &&
                !isset( $parameters[0][ 'WRITE' ] ) )
                    return $this->setReturn( 400 , null , null ) ;


            $p[ 'target' ] = $parameters[0][ 'TARGET' ] ;
            $p[ 'read' ] = $parameters[0][ 'READ' ] ;
            $p[ 'write' ] = $parameters[0][ 'WRITE' ] ;

            $tmp = new permissions(  $this->A ) ;
            $ret = $tmp->manage( $p )  ;

            if ( $ret == -1 ) {
                //
                return $this->setReturn( 400 , null , null ) ;
            }
            else if ( $ret == 0 ) {
                // Success
                return $this->setReturn( 204 , 'Registration succesful' , null ) ;
            }
            else if ( $ret == 1 ) {
                // failure
                return $this->setReturn( 500 , 'MySQL connection error' , null ) ;
            }

            // failure
            return $this->setReturn( 500 , null , null ) ;

         }

        /**
         *  @name       getPermissions
         *
         *  This function allows a user to view their acces permissions
         *
         *  @return 200     Succes and the permission list, null if none
         *  @return 401     Not Authorized
         *  @return 500     Mysql Error or server error
         */
         public function getPermissions( ) {

            if ( ! defined( 'CURRENT_USER_ID' ) ) {
                return $this->setReturn( 401 , null , null ) ;
            }


            $tmp = new permissions(  $this->A ) ;
            $ret = $tmp->manage( 'GET' )  ;

            if ( is_array( $ret ) || $ret == null ) {
                // Success
                return $this->setReturn( 200 , 'Permissions found' , $ret ) ;
            }
            if ( $ret == -1 ) {
                //
                return $this->setReturn( 401 , null , null ) ;
            }
            else if ( $ret == 1 ) {
                // failure
                return $this->setReturn( 500 , 'MySQL connection error' , null ) ;
            }

            // failure
            return $this->setReturn( 500 , null , null ) ;

         }


        /**
         *  @name       deauthenticateUser
         *
         *  Requires authentication : false
         *
         *  This function logs a user iout of the website
         *
         *  JSON=[
         *      {
         *          "order": 1,
         *              "call": "deauthenticateUser",
         *                  "parameter": [
         *                  {
         *                          null
         *                      }
         *          ]
         *          }
         *  ]
         *
         *  @return 204             Success
         */
         public function deauthenticateUser( $parameters ) {

            $user = new user( $this->A , null ) ;
            $tmp = $user->manage( 'SESSION' , 'STOP' ) ;

            return $this->setReturn( 204 , array( 'Deauthentication succesful' , 'Session ended' ) , null ) ;

         }

        // MFA METHODS

        /**
         *  @name   registerMFA
         *
         *  Requires authentication : false
         *
         *  This function registers an MFA device to the application
         *
         *  JSON=[
         *      {
         *          "order": 1,
         *          "call": "registerMFA",
         *                  "parameter": [
         *                  {
         *                      'USR_PHONE':123456780 ,
         *                      'USR_EMAIL':'email' ,
         *                      //'USR_PWD':'pwd'
         *                  }
         *          ]
         *          }
         *  ]
         *
         *  @param $parameters[ 0 ][ 'USR_PHONE' ]      the dievice MAC
         *  @param $parameters[ 0 ][ 'USR_EMAIL' ]      the users email
         *  @param $parameters[ 0 ][ 'USR_PWD' ]        the user password
         *
         *  @return 200             Success, data returned is  salt and pepper
         *  @return 400             Bad Request
         *  @return 401             Failure
         */
        public function registerMFA( $parameters ) {

            if( !isset( $parameters[ 0 ][ 'USR_PHONE' ] ) &&
                !isset( $parameters[ 0 ][ 'USR_PWd' ] ) &&
                !isset( $parameters[ 0 ][ 'USR_EMAIL' ] ) )
                //!isset( $parameters[ 'USR_PWD' ] ) )
                    return $this->setReturn( 400 , null , null ) ;

            $mfa = new mfa( $this->A , $parameters[ 0 ] ) ;
            $tmp = $mfa->manage( 'REGISTER' ) ;

            if ( is_array( $tmp ) )
                return $this->setReturn( 200 , null , $tmp ) ;
            else if ( $tmp == 1 )
                return $this->setReturn( 401 , 'User | Password is incorect, or not registered.' , null ) ;
            else if ( $tmp == 2 )
                return $this->setReturn( 401 , 'Device is already registered.' , null )  ;
        }

        /**
         *  @name       activateMFA ;
         *
         *  Requires authentication : false
         *
         *  This function activates an MFA device
         *
         *  JSON=[
         *      {
         *          "order": 1,
         *              "call": "activateMFA",
         *                  "parameter": [
         *                  {
         *                          "USR_PHONE": "123456780",
         *                          "USR_PIN": "123456"
         *                      }
         *          ]
         *          }
         *  ]
         *
         *  @param $parameters[ 0 ][ 'USR_PHONE' ]  the dievice MAC
         *  @param $parameters[ 0 ][ 'USR_PIN' ]    the emailed pin
         *
         *  @return     204     Success
         *  @return     400     Bad request
         *  @return     401     Unauthorized
         *  @return     403     Forbidden
         */
        public function activateMFA( $parameters) {
            if( !isset( $parameters[0][ 'USR_PHONE' ] ) &&
                !isset( $parameters[0][ 'USR_PIN' ] ) )
                    return $this->setReturn( 400 , null , null ) ;

            $mfa = new mfa( $this->A , $parameters[0] ) ;
            $tmp = $mfa->manage( 'ACTIVATE' ) ;

            if ( $tmp == 0 )
                return $this->setReturn( 204 , 'Device was Activated' , null ) ;
            else if ( $tmp == 1 )
                return $this->setReturn( 401 , 'Device is not registered , or is already active.' , null ) ;
            else if ( $tmp == 2 )
                return $this->setReturn( 403 , 'Device was Banned.' , null )  ;
            else if ( $tmp == 3 )
                return $this->setReturn( 400 , 'Device was not Activated.' , null )  ;
        }

        /**
         *  @name   authenticateMFA
         *
         *  Requires authentication : false
         *
         *  This function authenticates an MFA device
         *
         *  JSON=[
         *      {
         *          "order": 1,
         *              "call": "authenticateMFA",
         *                  "parameter": [
         *                  {
         *                          "USR_PHONE": "123456780",
         *                          "USR_TOKEN": "ASDFASDFSADGDRSGDFSDFDFSGSDGSDFGDFGSDFGSDFGSDFGSDFGSDFG"
         *                      }
         *          ]
         *          }
         *  ]
         *
         *
         *
         *  @param  $parameters[ 0 ][ 'USR_PHONE' ] the device MAC
         *  @param  $parameters[ 0 ][ 'USR_TOKEN' ] the device token
         *
         *  @return 400     Bad request
         *  @return 204     Succces
         *  @return 401     Not authorized
         *  @return 403     Forbidden
         */
        public function authenticateMFA( $parameters) {
            if( !isset( $parameters[0][ 'USR_PHONE' ] ) &&
                !isset( $parameters[0][ 'USR_TOKEN' ] ) )
                    return $this->setReturn( 400 , null , null ) ;

            $mfa = new mfa( $this->A , $parameters[0] ) ;
            $tmp = $mfa->manage( 'AUTHENTICATE' ) ;

            if ( $tmp == 0 )
                return $this->setReturn( 204 , 'Device was Authenticated' , null ) ;
            else if ( $tmp == 1 )
                return $this->setReturn( 401 , 'Device is not registered.' , null ) ;
            else if ( $tmp == 2 )
                return $this->setReturn( 403 , 'Device was Banned.' , null )  ;
            else if ( $tmp == 3 )
                return $this->setReturn( 400 , 'Device was not Authenticated.' , null )  ;
        }

    }



?>
