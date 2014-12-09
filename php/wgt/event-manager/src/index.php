<?php

    $E = new eventManager( $A ) ;
    $E->manage( 'SET_USER' , CURRENT_USER_ID ) ;
    $E->manage( 'LIST' ) ;

    $RANGE = $E->manage( 'RANGE_EPOCH' , array( $WGT[ 'ARGV' ][ 0 ] , $WGT[ 'ARGV' ][ 1 ] ) ) ;
//var_dump( $RANGE ) ;
    if( count( $RANGE ) ) {

    for ( $i = count( $RANGE ) - 1 ; $i >= 0 ; --$i ){

        $j = 0 ;
        foreach ( $RANGE[ $i ] as $date => $arr ){

            echo "<div class='wrapper'><h3>" , date( 'l F jS, Y' , $date ) , ' at ' , date( 'g:i a' , $date ) ,"</h3>";

            if( isset( $arr[ 'FILE' ] ) ){
                //echo"<ul>" ;
                //echo "<li>MIME" , $arr[ 'FILE' ][ $j ][ 'MIME' ] , "</li>";
                //echo "<li>NAME" , $arr[ 'FILE' ][ $j ][ 'NAME' ] , "</li>";
                //echo "<li>PATH" , $arr[ 'FILE' ][ $j ][ 'PATH' ] , "</li>";

                $file = $A[ 'D_USR' ] . $arr[ 'FILE' ][ $j ][ 'PATH' ] . $arr[ 'FILE' ][ $j ][ 'NAME' ] ;
                $mime = explode( '/' , $arr[ 'FILE' ][ $j ][ 'MIME' ] ) ;

                //echo "<li>file" , $file , "</li>";
                //echo "<li>mime" , $mime[ 0 ] , "</li>";
                //echo"</ul>" ;
                if ( file_exists( $file ) ) {

                    if( $mime[ 0 ] == 'image' ){
                        echo "<div class='media-wrapper'>" ;
                        $F = new fManager( $A ) ;
                        $tmp = $F->encodeB64( $file ) ;
                        echo '<img src="data:' , $tmp[ 'mime' ] , ';' , $tmp[ 'encoded' ] ,',', $tmp[ 'data' ] , '"  />' ;
                        unset( $F ) ;

                        echo '<div class="img-title">' , $arr[ 'FILE' ][ $j ][ 'NAME' ] , '</div></div>' ;
                    }
                    else if( $mime[ 0 ] == 'application' ||
                             $mime[ 0 ] == 'text' ) {

                            echo "<div class='media-wrapper'>" ;
                            $val =  file_get_contents( $file  ) ;
                            echo '<pre>' , $val , '</pre>' ;
                            echo '<div class="img-title">' , $arr[ 'FILE' ][ $j ][ 'NAME' ] , '</div></div>' ;

                    }
                    else if( $mime[ 0 ] == 'video' ) {
                        echo "<div class='media-wrapper'>" ;
                        $F = new fManager( $A ) ;
                        $tmp = $F->encodeB64( $file ) ;
                        echo '<video width="602" height="450" controls>
                                <source src="data:' , $tmp[ 'mime' ] , ';' , $tmp[ 'encoded' ] ,',', $tmp[ 'data' ] , '" type="'. $mime[0] . '/' . $mime[1] .'" alt="' .$file. '">
                                    Your browser does not support the video tag.
                                </video>' ;
                        unset( $F ) ;
                        echo '<div class="img-title">' , $arr[ 'FILE' ][ $j ][ 'NAME' ] , '</div></div>' ;
                    }

                } else {
                    echo "ERROR " , $date ;
                }

                $j++ ;

            } else {
                echo "COUNT" , $arr[ 'COUNT' ] ;
            }

            echo '</div>' ;
        }
    }

}
else{
    echo '<h3> There are no entries for today</h3>';
}
?>
