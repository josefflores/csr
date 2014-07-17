<?php

$tag = array( 'Name' => 'Jose') ;
$years = array( 2013 , 2014 ) ;

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
                    $dbc = mysql_connect('localhost','root','sudhir');
                    if(!$dbc){
                        die("not connected : " . mysql_error());
                    }

                    //select database
                    $db_selected = mysql_select_db('csr_d',$dbc);
                    if(!$db_selected){
                        die("cant connect to database csr_d" . mysql_error());
                    }

                    //query the database and get results
                    $query = "SELECT csr_d_key, csr_d_val  from csr_d_key_pair";
                    $result = mysql_query($query);

                    while($row = mysql_fetch_array($result, MYSQL_BOTH)){
                        $key = $row['csr_d_key'];
                        $val = $row['csr_d_val'];

                        echo "
							<tr>
								<th>$key : </th>
							<td>$val</td>
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
				
		<div class = "current-month-table">
	
		</div>

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
				    <li class=\"time-line-year\">' .
                            $year;
                    }
                        echo
                    '<ul>
					    <li class=\"time-line-year-months\">' .
                        $month  .
                        '</li>
                    </ul>
                </li>';

                    $currentYear = $year;
                }

	echo'			</ul>
			</div>

		</div>
	</div>
</div>
';
?>
