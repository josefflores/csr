<?php

    //$A[ 'W_ROOT' ] = 'josefflores.com/csr/' ;
    //$A[ 'D_ROOT' ] = 'F:\\Github\\csr\\' ;
    //$A[ 'SECURE' ] = false ;

    //include( $A[ 'D_ROOT' ].'ini\\paths.php' ) ;
    //include( $A[ 'D_TMP' ] . 'includes.php' ) ;

    errorsOn( true ) ;

    // define( 'CURRENT_USER_ID' , 1 ) ;
    // define( 'CURRENT_SRC_ID' , null ) ;
    // define( 'CURRENT_WEB_OR_MFA' , 'WEB' ) ;

    // Get user information
    $DB = new mysql( $A , 'csr' ) ;
    $table = 'csr_usr_account' ;
    $keyPairs = array( 'id' =>  CURRENT_USER_ID ) ;
    $operators = array( '==') ;
    $result = $DB->select( $table , $keyPairs , $operators ) ;
    $row = $result->fetch_array( MYSQLI_ASSOC ) ;

    //  Get User Event information
    $E = new eventManager( $A ) ;
    $E->manage( 'SET_USER' , CURRENT_USER_ID ) ;
    $LIST = $E->manage( 'LIST' ) ;

    $EVENT = array() ;
    foreach ( $LIST as $e ) {

        $year = date( "Y" , $e ) ;
        $month = date( "F" , $e ) ;
        $day = date( "d" , $e ) ;

        if ( empty( $EVENT ) ||
             !isset( $EVENT[ $year ] ) ||
             !isset( $EVENT[ $year ][ $month ] ) ||
             !in_array( $day , $EVENT[ $year ][ $month ] ) )  {

                $EVENT[ $year ][ $month ][] = $day ;

        }

    }


    echo '<div class="pane-right">
            <h3>Statistics</h3>
        </div>';

    $F = new fManager( $A ) ;
    $file = $A[ 'D_USR' ] . $row[ 'id' ] . '/profile.jpg';
    $tmp = $F->encodeB64( $file ) ;

    echo '<div class="pane-left">
            <div class="profile-generator-id">

            <div class="profile-generator-picture">
                <img src="data:' , $tmp[ 'mime' ] , ';' , $tmp[ 'encoded' ] ,',', $tmp[ 'data' ] , '" alt="', $file ,'"  />

    </div>

                <div class="profile-generator-name-card">
                    <table>
                        <tr>
                            <th> PID </th>
                            <td>' , sprintf( "%010d", $row[ 'id' ] ) , '</td>

                        </tr>
                        <tr>
                            <th> Name </th>
                            <td style="text-transform:capitalize">' , $row[ 'usr_name_first' ] , ' ' , $row[ 'usr_name_middle' ] , ' ' , $row[ 'usr_name_last' ] , '</td>

                        </tr>
                        <tr>
                            <th> Email </th>
                            <td><a href="mailto:' , $row[ 'usr_email' ] , '">' , $row[ 'usr_email' ] , '</a></td>
                        </tr>
                        <tr>
                            <th> Phone</th>
                            <td>' ,$row[ 'usr_phone_country' ] , ' (' , $row[ 'usr_phone_area' ] , ') ' , $row[ 'usr_phone_number' ] , ' ' , $row[ 'usr_phone_ext' ] , '</td>
                        </tr>
                        <tr>
                            <th> DOB</th>
                            <td>' , date( 'M d, Y' , $row[ 'usr_dob_epoch' ] ) , '</td>
                        </tr>
                        <tr>
                            <th>Age</th>
                            <td>' , ( date( 'Y' , time() - $row[ 'usr_dob_epoch' ] ) ) - 1970 , '</td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>

        <div class="pane-right">
            <h3>Log</h3>
        </div>

        <div class="pane-center-input">
            <textarea></textarea><br/>
            <input type="file" id="fileinput"/>
            <div id="file"><button>Upload</button><span id="result"></span></div>
            <button id="btnLoad" onclick="handleFileSelect();">Submit</button>
            <div id="editor"></div>
        </div>

        <div class="pane-right">
            <h3>Events</h3> ';

    if ( count( $LIST ) ) {

        echo '<ul>' ;

        foreach ( array_reverse($EVENT,true) as $year => $month ) {

            echo '<li><a onClick="collapse( this , \'Y\' ); return false;">' , $year , '</a><ul>' ;

            foreach( array_reverse($month,true) as $m => $day ) {

                echo '<li><a onClick="collapse( this , \'M\' ); return false;" value="' , strtotime( '1-' . $m . '-' . $year ) , '">' , $m , '</a><ul>' ;

                foreach( array_reverse($day,true) as $d ) {

                    echo '<li><a onClick="collapse( this , \'D\' ); return false;" value="' , strtotime( $d . '-' . $m . '-' . $year ) , '">' , $d , '</a></li>' ;

                }

                echo '</ul></li>' ;
            }

            echo '</ul></li>' ;
        }
    } else {
        echo ' No Events ' ;
    }
    echo    '</ul>

        </div>



        <div class="pane-center"></div>' ;
?>

