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

					//foreach( $tag as $key => $pair ) {
						echo '
							<tr>
								<th>Firld</th>
							<td>value</td>
							</tr> 
						';
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
				//for( $i = $year[1] ; $i >= $year[0] ; --$i ) {	
					echo '<li class="time-line-year"> 
						<ul>
							<li class="time-line-year-months">
								
							</li>
						</ul>
					</li>';
			//	}
	echo'			</ul>
			</div>
		
		</div>
	</div>
</div>
';
?>
