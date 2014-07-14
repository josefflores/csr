<?php
	
	if( !LOGGED_IN ){
		echo '<div class="sec-login">' ;
		$str = '<table class="form">' ;
				
		
		$str .= '<tr class="sec-registration-line">
					<td>Email</td>
					<td><input class="sec-login-input-text sec-login-required" id="sec-login-email" name="sec-login-email" type="text"/></td>
				</tr>' ;
		
		$str .= '<tr class="sec-registration-line">
					<td>Password</td>
					<td><input class="sec-login-input-text sec-login-required" id="sec-login-password-1" name="sec-login-password-1" type="password"/></td>
				</tr>' ;
				
		$str .= '<tr class="sec-registration-line">
					<td></td>
					<td><button onclick="api.authenticateUser(); return false ; ">Log in</button>
					<a class="button" href="'. $A[ 'W_ROOT' ] . 'register/">Register</a></td>
				</tr></table>' ;
		
		echo $str ;				
	}
	else{
		echo '<div class="sec-logout">' ;
		echo '<button onclick="api.deauthenticateUser(); return false ; ">Log out</button>';
	}
	echo '</div>' ;
	
?>
