<?php


// start sessions
function gowest_session_start() {
    if ( !session_id() ) {
        session_start();
    }

	// set up a global for the sf_url
	global $sf_url;

	// use the live salesforce URL.
	if ( $_SERVER['HTTP_HOST'] == 'gowest.jpederson.io' ) {
		$sf_url = "https://nwcua--staging.sandbox.my.site.com/s/";
	} else if ( $_SERVER['HTTP_HOST'] == 'gowestfoundation.jpederson.io' || is_foundation() ) {
		$sf_url = "https://gowest.my.site.com/foundation/s/login/?startURL=https%3A%2F%2Fgowestfoundation.org%2Fboard-portal%2F";
	} else {
		$sf_url = "https://members.gowest.org/s/";
	}

	
	// get the request URI and remove the query string
	$request = parse_query_string();
	
	// check if this is an auth request.
	if ( substr( $_SERVER['REQUEST_URI'], 0, 5 ) == '/auth' && substr( $_SERVER['REQUEST_URI'], 0, 7 ) != '/author'  ) {
	
		// log the auth request
		// $logfile = $_SERVER["DOCUMENT_ROOT"] . '/wp-content/uploads/logs/auth.log';
		//$logfile = '../logs/auth.log';
		//file_put_contents( $logfile, "\r\n" . $_SERVER['REQUEST_URI'], FILE_APPEND );

		// set session
		$_SESSION['sf_user'] = $request;
		$_SESSION['sf_user']['board'] = ( $_SESSION['sf_user']['board'] === 'true' ? true : false );
	
		// log them in as 'member'
		if ( !is_user_logged_in() ) {
			wp_set_auth_cookie( 8, false );
		}
	
		// redirect to infosight
		if ( $_SERVER['HTTP_HOST'] == 'gowestfoundation.jpederson.io' || is_foundation() ) {
			wp_redirect( '/board-portal/' );
		} else {
			wp_redirect( 'https://gowestassociation.leagueinfosight.com/admin/client/is/frontend/gowest_sso.php?' . http_build_query( $request ) );
		}
		exit;
	
	}
	
	// handle logout requests
	if ( substr( $_SERVER['REQUEST_URI'], 0, 7 ) == '/logout' ) {
		
		// log the user out of wordpress as well.
		wp_logout();
	
		// redirect to the homepage and exit
		wp_redirect( 'https://members.gowest.org/secur/logout.jsp' );
		exit;
		
	}
}
add_action( 'init', 'gowest_session_start', 1 );




// function to end the session
function gowest_session_end() {
    session_destroy();
}
add_action( 'wp_logout', 'gowest_session_end' );
add_action( 'wp_login', 'gowest_session_end' );


// [cal-link] shortcode handler
function cal_link() {

	// use the WP user if they're an admin
	if ( isset( $_SESSION['sf_user'] ) ) {

		// piece together the user information from SF to pass along to CAL
		$email = $_SESSION['sf_user']['email'];
		$first_name = $_SESSION['sf_user']['firstname'];
		$last_name = $_SESSION['sf_user']['lastname'];

	} else if ( is_user_logged_in() && current_user_can( 'administrator' ) ) {

		// get the WP user if it's an admin
		$user_info = wp_get_current_user();
		$user_meta = get_user_meta( $user_info->data->ID );
		$first_name = $user_meta['first_name'][0];
		$last_name = $user_meta['last_name'][0];
		$email = $user_info->data->user_email;

	}

	// generate a guid from the token, date, and email
	$guid = md5( CAL_TOKEN . date( 'n/j/Y') . $email );

	$redirect = urlencode( 'http://www.fuzeqna.com/nwcua/ext/kbdetail.aspx?kbid=468' );

	if ( isset( $email ) ) {
		return '<div class="buttons"><a href="https://www.fuzeqna.com/nwcua/membership/consumer/signon.asp?auth=' . $guid . '&uid=' . $email . '&email=' . $email . '&fname=' . $first_name . '&lname=' . $last_name . '&redir=' . $redirect . '" class="btn orange" target="_blank">Visit CAL</a></div>';
	} else {
		return "<strong>Please log in to access CAL.</strong>";
	}

}
add_shortcode( 'cal-link', 'cal_link' );


// only show the admin toolbar for admin users.
add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() {
	if ( !current_user_can('administrator') && !is_admin() ) {
		show_admin_bar( false );
	}
}


// display the my account/login links based on user state.
function account_buttons() {

	// let's get the URL
	global $sf_url;

	// get the referer
	$referer = ( isset( $_SERVER['HTTPS'] ) ? 'https://' : 'http://' ) . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];

	// if the user is logged in.
	if ( isset( $_SESSION['sf_user'] ) || is_user_logged_in() ) {
		?><a href="<?php print $sf_url ?>my-account" class='btn green account'>My Account</a> <a href="/logout" class="btn grey-light">Logout</a><?php
	} else {
		?><a href="<?php print $sf_url ?>redirect-with-url-params?url=<?php print $referer ?>" class='btn green account'>Log In</a> <a href="https://members.gowest.org/s/login/SelfRegister" class="btn navy">First Time User</a><?php 
	}

}


// membership check - boolean function, that checks to see if there were previous access roles and adds the appropriate new meta.
function is_member() {

	global $post;

	// see if there is a member's only value
	if ( has_cmb_value( 'member-only' )  ) {

		// if the content requires membership
		if ( get_cmb_value( 'member-only' ) == 'on' ) {

			// if they're an admin, let them in automatically
			return user_has_membership();

		} else {

			// members only checkbox exists and is unchecked, they can access
			return true;
		}

	} else {

		// there's no value available for the member's only checkbox, they can access.
		return true;
	}

}


// new function to determine if the currently logged in user has a membership.
function user_has_membership() {

	// override so administrator accounts can view all content.
	if ( current_user_can( 'administrator' ) ) { 
		return true;
	}

	// array of acceptable membership types
	$accepted_memberships = array( 'Member', 'Associate Member' , 'Trial Member' );

	// check if we've got a salesforce user logged in
	if ( isset( $_SESSION['sf_user'] ) ) {

		// see if the user is a member
		if ( in_array( $_SESSION['sf_user']['membershiptype'], $accepted_memberships ) ) return true;

	}

	// otherwise, the user isn't a member
	return false;

}


// member error
function do_member_error() {

	// lets get the url
	global $sf_url;
	
	// set the referrer
	$referer = ( isset( $_SERVER['HTTPS'] ) ? 'https://' : 'http://' ) . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
	?>
	<div class="member-notice content-wide">
		<?php
		if ( isset( $_SESSION['sf_user'] ) ) {
			?>
		<h3>Your membership still needs approval.</h3>
		<p>You've successfully created your account and logged in, but association staff still needs to approve your membership. Get in touch with us to get assistance accessing our member resources.</p>
		<p>To check and see if your membership has been approved, please <a href="/logout">log out</a> and back in.</p>
			<?php
		} else {
			if ( $_SERVER['HTTP_HOST'] == 'gowestfoundation.jpederson.io' || is_foundation() ) {
				$login_link = '<a href="' . $sf_url . '">log in</a>';
			} else {
				$login_link = '<a href="' . $sf_url . 'redirect-with-url-params?url=' . $referer . '">log in</a>';
			}
			print str_replace( '[login-link]', $login_link, get_snippet( 'member-error' ) );
			// <iframe src="https://members.gowest.org/secur/logout.jsp" style="width: 0; height: 0;"></iframe>
		}
		?>
	</div>
	<?php
}


// membership check - boolean function, that checks to see if there were previous access roles and adds the appropriate new meta.
function is_board() {

	global $post;

	// see if there is a member's only value
	if ( has_cmb_value( 'board-only' )  ) {

		// if they're an admin, let them in automatically
		if ( current_user_can( 'administrator' ) ) { 
			return true;
		}
	
		// if the content requires membership
		if ( get_cmb_value( 'board-only' ) == 'on' ) {

			// if they're a board member in salesforce
			if ( isset( $_SESSION['sf_user']['board'] ) ) {
				if ( $_SESSION['sf_user']['board'] ) {
					return true;
				}
			}

			// they don't have any of the required roles, they can't access it.
			return false;

		} else {

			// members only checkbox exists and is unchecked, they can access
			return true;
		}

	} else {

		// there's no value available for the member's only checkbox, they can access.
		return true;
	}

}


function member_debug() {
	$return = '<hr>';

	if ( isset( $_SESSION['sf_user'] ) ) {
		$return .= '<p><strong>Name:</strong> ' . $_SESSION['sf_user']['name'] . '<br>';
		$return .= '<strong>Email:</strong> ' . $_SESSION['sf_user']['email'] . '<br>';
		$return .= '<strong>User ID:</strong> ' . $_SESSION['sf_user']['nwcua_id'] . '<br>';
		$return .= '<strong>Membership Type:</strong> ' . $_SESSION['sf_user']['membershiptype'] . '<br>';
		$return .= '<strong>Board Member:</strong> ' . ( $_SESSION['sf_user']['board'] ? 'Yes' : 'No' ) . '</p>';
	} else {
		$return .= '<hr>Member not logged into Salesforce<hr>';
	}
	$return .= '<hr>';
	return $return;
}
add_shortcode( 'member-debug', 'member_debug' );

