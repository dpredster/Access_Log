<?php
/**
 * Module Functions / Actions
 * (Loaded on index.php)
 *
 * @package Access Log module
 */


/**
 * Record login in Access Log..
 *
 * @uses index.php|login_check hook
 *
 */
function AccessLogRecord()
{
	global $username;

	if	( $_SESSION['STUDENT_ID']
		|| $_SESSION['STAFF_ID'] )
	{
		// Successful Login.
		$login_status = 'Y';
	}
	else
	{
		// Failed Login.
		$login_status = '';
	}

	$profile_id = User( 'PROFILE' );

	if ( isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) )
	{
		$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
	}
	else
	{
		$ip = $_SERVER['REMOTE_ADDR'];
	}

	DBQuery("INSERT INTO ACCESS_LOG
		(SYEAR,USERNAME,PROFILE,LOGIN_TIME,IP_ADDRESS,STATUS)
		values('" . Config( 'SYEAR' ) . "',
		'" . $username . "',
		'" . $profile_id . "',
		CURRENT_TIMESTAMP,
		'" . $ip . "',
		'" . $login_status . "' )" );
}

add_action( 'index.php|login_check', 'AccessLogRecord', 0 );
