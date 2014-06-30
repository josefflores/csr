package csrToken ;

import java.io.UnsupportedEncodingException ;
import java.security.MessageDigest ;
import java.security.NoSuchAlgorithmException ;
import java.lang.String ;
import javax.xml.bind.DatatypeConverter;

public class CSRToken {
	 
	////
	// Variables

	// Encoding Variables
	private String 	encryption ;// The encryption algorithm to use
	private String 	encoding ; 	// The encoding of the characters

	// Window validity length
	private int 	iteration ; // 1 is the current token, each increase goes back one precision
	private int 	precision ; // Gives a (2x) second maximum window with a life span of the value
	
	//	Device Values
	private String 	mfa_device_salt ;
	private String 	mfa_device_pepper ;
	private int 	mfa_device_pin ;
	private long 	mfa_device_date ;

	////
	// Functions
	 
	public static void main( String[] args ) {
		CSRToken token = new CSRToken() ;
		token.setMfaDeviceSalt( "ABC123kk" ) ;
		token.setMfaDevicePepper( "THEHALL2" ) ;
		token.setMfaDeviceDate( 123456789 ) ;
		token.setMfaDevicePin( 982091 ) ;
		
		System.out.printf( "%s" , token.genToken() ) ;
	}
	
	// Constructor 
	
	/**
	 * CSRToken
	 * 
	 * Default constructor
	 */
	public CSRToken( ) {
    	setEncryption( "SHA-256" ) ;
    	setEncoding( "UTF-8" ) ;  
    	setIteration( 1 ) ;
    	setPrecision( 15 ) ;  
    }
	
	/**
	 * CSRToken
	 * 
	 * Default constructor
	 * 
	 * @param 	encryption		The encryption algoritm
	 * @param 	encoding		The character encoding
	 * @param 	iteration		The number of cycles to check startting at 0
	 * @param 	precision		The time length of a cycle in seconds
	 */
    public CSRToken( String encryption , 	
    				 String encoding  , 
    				 int iteration  ,
    				 int precision  ) {
    	// Store variables 
    	setEncryption( encryption ) ;
    	setEncoding( encoding ) ;  
    	setIteration( iteration ) ;
    	setPrecision( precision ) ;  
    }   
    
    // Setters
    
    public void		setIteration( int iteration ){
    	this.iteration = iteration ;
    }
    public void		setPrecision( int precision ){
    	this.precision = precision ;
    }
    public void 	setMfaDevicePin( int mfa_device_pin ){
    	this.mfa_device_pin = mfa_device_pin ;
    }
    
    public void 	setEncryption( String encryption ) {
    	this.encryption = encryption ;
    }
    public void 	setEncoding( String encoding ) {
    	this.encoding = encoding ;
    }
    public void 	setMfaDeviceSalt( String mfa_device_salt ){
    	this.mfa_device_salt = mfa_device_salt ;
    }
    public void 	setMfaDevicePepper( String mfa_device_pepper ){
    	this.mfa_device_pepper = mfa_device_pepper ;
    }
    public void 	setMfaDeviceDate( long mfa_device_date ){
    	this.mfa_device_date = mfa_device_date ;
    }
    
    // Getters
    
    public int		getIteration( ){
    	return this.iteration ;
    }
    public int		getPrecision( ){
    	return this.precision ;
    }
    public int 		getMfaDevicePin( ){
    	return this.mfa_device_pin ;
    }
    
    public String 	getEncryption( ) {
    	return this.encryption ;
    }
    public String 	getEncoding( ) {
    	return this.encoding ;
    }
    public String 	getMfaDeviceSalt( ){
    	return this.mfa_device_salt ;
    }
    public String 	getMfaDevicePepper( ){
    	return this.mfa_device_pepper ;
    }
    public long 	getMfaDeviceDate( ){
    	return this.mfa_device_date ;
    }
   
    
    public long    	genTime( ) {
    	return System.currentTimeMillis() / 1000 ;
    }
    
    public String 	genToken( )  {
    	
    	long epoch = genTime() ;
    	
    	try {
    		MessageDigest md = MessageDigest.getInstance( this.encryption ) ;
   	    	
	    	String text = this.mfa_device_salt + 
				 this.mfa_device_date +
				 (int) ( ( epoch + ( this.iteration * this.precision ) ) / this.precision ) +
				 this.mfa_device_pin + 
				 this.mfa_device_pepper ;
	    	
	    	System.out.printf( "%s" , text + "\n" ) ;
	    			
	    	md.update( text.getBytes( this.encoding ) ) ; 
    	
	    	return DatatypeConverter.printHexBinary( md.digest() ) ;

	    	
    	} catch ( NoSuchAlgorithmException e ) {
    		System.err.println( "NoSuchAlgorithmException" ) ;
    	} catch ( UnsupportedEncodingException e) {
    		System.err.println( "UnsupportedEncodingException" ) ;
		}
    	return null ;
    }
};
