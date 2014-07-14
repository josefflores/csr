<?php

	
	
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
	$LIST = $E->manage( 'LIST' ) ;
	
	//var_dump( $LIST ) ;
	
	$RANGE = $E->manage( 'RANGE_INDEX' , array( 0 , count ( $LIST ) ) ) ;
	//rSort( $LIST ) ;
	//rsort( $RANGE ) ;

	//echo '<pre>' , var_dump( $RANGE ) , '</pre>' ;

	for( $j = count( $LIST ) - 1 ; $j >= 0 ; --$j ) {
		
		
		echo 	'<div class="event"> <div class="date"> ' , date( 'r' , time() ) , ' </div> ' ;
		//echo $RANGE[0][ $eventEntry ] ;
		for ( $i = 0 ; $i < $RANGE[ $j ][ $LIST[ $j ] ][ 'FILE' ][ 'COUNT' ] ; ++$i ) {
				//echo 	'<pre>' ; var_dump( $RANGE[ $eventEntry ] ) ; echo  '</pre>' ;
				echo 	'<div class="media"> ' ; 
						
				$mime = explode( '/' , $RANGE[ $j ][ $LIST[ $j ] ][ 'FILE' ][ $i ][ 'MIME' ] ) ;
				
				$file = $RANGE[ $j ][ $LIST[ $j ] ][ 'FILE' ][ $i ][ 'PATH' ] .
						$RANGE[ $j ][ $LIST[ $j ] ][ 'FILE' ][ $i ][ 'NAME' ] ;
				if( $mime[ 0 ] == 'image' ){
					
					$F = new fManager( $A ) ;
					$arr = $F->encodeB64( $file ) ;
					echo '<img src="data:' , $arr[ 'mime' ] , ';' , $arr[ 'encoded' ] ,',', $arr[ 'data' ] , ' alt="'. $RANGE[ $j ][ $LIST[ $j ] ][ 'FILE' ][ $i ][ 'NAME' ] .'"  />' ;
					unset( $F ) ;
				}
				if( $mime[ 0 ] == 'video' ){ 
					echo '<video width="320" height="240" controls>
							<source src="data:' , $arr[ 'mime' ] , ';' , $arr[ 'encoded' ] ,',', $arr[ 'data' ] , ' alt="'. $RANGE[ $j ][ $LIST[ $j ] ][ 'FILE' ][ $i ][ 'NAME' ] .'" type="'. $mime[0] . '/' . $mime[1] .'">
								Your browser does not support the video tag.
							</video>' ; 
				}
				
				
				
				echo 	'</div>' ;
		}
		echo '</div>' ;
	}
