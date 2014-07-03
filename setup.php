<?php
	
	//Update database
	$list = array( 'csr' , 'csr_d' ) ;
	$i = 0 ;
	
	foreach( $list as $item ) {
		exec( 'mysql -u ' . $_ENV[ 'CSR_MYSQL_USR' ] . ' -p' . $_ENV[ 'CSR_MYSQL_PWD' ] . ' ' . $item . ' < ./db/' . $item . '.sql' , $output , $return ) ;
		if( $return  ) {
			echo 'ERROR[ ' . ++$i . ' ] Database update: ' . $item ;
			return $i ;
		}
	}
	
	// navigate to documentation directory
	$doxygen = "C:\\Progra~2\\Jenkins\\workspace\\CSR application\\doc\\" ;
	
	// build documentation
	exec( 'doxygen "'. $doxygen .'api"' ) ;
	if( $return  ){
		echo 'ERROR[ ' . ++$i . ' ] Database update: ' . $item ;
		return $i ;
	}
	
	echo 'Setup complete ...' ;
	return 0 ;
?>
