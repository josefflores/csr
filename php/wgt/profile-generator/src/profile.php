<?php

$tag = array( 'Name' => 'Jose') ;
$years = array( 2013 , 2014 ) ;

$A['W_ROOT']  = "localhost/DietaryWebApp/";
$A[ 'D_ROOT' ] = 'D:\\DietitianSite\\csr\\' ;
$A[ 'SECURE' ] = false ;
/*
include( $A[ 'D_ROOT' ].'ini\\paths.php' ) ;
include( $A[ 'D_TMP' ] . 'includes.php' ) ;

errorsOn( true ) ;

$E = new eventManager($A );
$E->manage('SET_USER', 1);
$list = $E->manage('LIST');

echo '<pre>' , var_dump( $LIST ) , '</pre>' ;
*/

include 'Calendar.php';


echo'
<div class="profile-generator">
	<div class="profile-generator-left">

		<div class="profile-generator-id">

			<div class="profile-generator-picture">
				<image src="profile-generator-pic" />
			</div>

			<div class="profile-generator-name-card1">
				<table>';

                    //open connection to mysql server
                    $dbc = mysqli_connect('localhost','root','sudhir', 'csr');
                    if(!$dbc){
                        die("not connected : " . mysql_error());
                    }

                    //query the database and get results
                    $query = "SELECT usr_name_first, usr_name_last,
                                     usr_email, usr_phone_country,
                                     usr_phone_area, usr_phone_number,
                                     usr_phone_ext, usr_dob_epoch from csr_usr_account where id = 1";
                    $result = mysqli_query($dbc, $query);

                    while($row = mysqli_fetch_array($result, MYSQL_BOTH)){
                        $firstName = $row['usr_name_first'];
                        $lastName = $row['usr_name_last'];
                        $email = $row['usr_email'];
                        $phoneNo = "+" . $row['usr_phone_country']. $row['usr_phone_area']
                                        . $row['usr_phone_number'] . $row['usr_phone_ext'];
                        $dob = $row['usr_dob_epoch'];

                        echo "
							<tr>
								<th> Name: </th>
							    <td>$firstName &nbsp $lastName</td>
							</tr>

							<tr>
							    <th> Email: </th>
							    <td> $email </td>
							</tr>

							<tr>
							    <th> Phone No: </th>
							    <td> $phoneNo </td>
							</tr>

                            <tr>
							    <th> Date of Birth: </th>
							    <td> $dob </td>
							</tr>
						";

                    }

					//foreach( $tag as $key => $pair ) {

				//	}

				echo '</table>
			</div>
		</div>

		<div class="profile-generator-log">

			<div class="profile-generator-log-entry">
			</div>

		</div>

	</div>

	<div class="profile-generator-center-line">
	</div>

	<div class = "profile-generator-center-pane" >
				
		<div class = "current-month-table">';
        $calendar = new Calendar();
        echo $calendar->show();
echo '</div>

	</div>


	<div class="profile-generator-right-panel">

		<div class="profile-generator-right-line">
		</div>

		<div class="profile-generator-right">
			
			<div class = "time-line" >
				<ul>';
                /*
                 * Create interval, start date and end date(which is current day)
                 * and then out put a range of months
                 */
                $start = new DateTime('2013-07-01');
                $end = new DateTime();
                $inc = new DateInterval("P1M");

                $p = new DatePeriod($start,$inc,$end);

                $out = array();

                foreach ($p as $d){
                    $out[] = array(
                        'month' => $d->format('M'),
                        'year' => $d->format('Y'),
                        'month_year' => $d->format('F Y')
                    );
                }

                $out = array_reverse($out);
                $currentYear = 0;
                foreach ($out as $o){

                    $month = $o['month'];
                    $year = $o['year'] ;

                    if($currentYear!= $year){
                        echo '
				    <li class=\"time-line-year\"> <a href = "#">' .
                            $year;
                    }
                        echo
                    '<ul>
					    <li class=\"time-line-year-months\"><a href = "#">' .
                        $month  .
                        ' </a></li>
                    </ul>
                </a></li>';

                    $currentYear = $year;
                }

	echo'			</ul>
			</div>

		</div>
	</div>
</div>
';
?>
