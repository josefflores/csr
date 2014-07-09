<?php

	class debug {
		
		private $A ;
		
		public function	__construct( $A ){
			$this->A = $A ;
		}
		
		public static function callStack( $stacktrace ) {
			print str_repeat( "=" , 50 ) ."\n" ;
			$i = 1 ;
			foreach( $stacktrace as $node ) {
				echo $i , '. ' . basename( $node[ 'file' ]  ) , ':' . $node[ 'function' ] , '(' . $node[ 'line' ] , ")\n" ;
				++$i;
			}
		} 
		
		public function trace( ) {
			debug_print_backtrace() ;
		}
		
		public function log( $src , $str ) {
			$file = $A[ 'D_ROOT' ] . '/doc/log/log.txt';
			return file_put_contents ( $file  , time() . ' >> ' . $src . "\n\t" . $str  ) ;
		}
				
	}
?>
