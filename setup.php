<?php
	
	//Update database
	$list = array( 'csr' , 'csr_d' ) ;
	$i = 0 ;
	
	foreach( $list as $item ) {
		exec( 'mysql -u ' . $_ENV[ 'CSR_MYSQL_USR' ] . ' -p' . $_ENV[ 'CSR_MYSQL_PWD' ] . ' ' . $item . ' < ./db/' . $item . '.sql' , $output , $return ) ;
		if( $return  )
			return ++$i ;
	}
	
	return 0 ;
?>
