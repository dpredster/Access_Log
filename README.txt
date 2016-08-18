RosarioSIS Access Log Module
Developed by dpredster (dpredster@gmail.com)
Based on OpenSIS Log Details


PLEASE NOTE: THE FOLLOWING INDEX.PHP FILE IS FOR ROSARIOSIS VERSION 2.9.7 ONLY! 
USING IT IN ANY OTHER VERSIONS OF THE PROGRAM MAY RESULT IN ERRORS.

1.	Copy the Security folder into modules\. AccessLog.php would be your new access log module while Menu.php would add  sub-menu link to School Setup.

2.	The code below should be added above line 119 in index.php. This log successful login attempts by Administrator, Teachers and Parents.

		// Check User Profile for Access Log.	
		$profile_id = $login_RET[1]['PROFILE'];
		
		// Record successful User login in Access Log.		
       $ip = $_SERVER['REMOTE_ADDR'];

		DBQuery("INSERT INTO ACCESS_LOG 
			(SYEAR,USERNAME,PROFILE,LOGIN_TIME,IP_ADDRESS,STATUS)
			values('" . Config( 'SYEAR' ) . "',
			'" . $username . "',
			'" . $profile_id . "',
			CURRENT_TIMESTAMP,		
			'" . $ip . "',
			'Successful Login' )" );

3.	The code below should be added above lines 201 in index.php. This log successful login attempts by Students.					

		// Check Student Profile for Access Log.
		if ( $student_RET = 1 )
			{
				$student_profile_id = 'student';
			}
			
		// Record successful Student login in Access Log.			
        $ip = $_SERVER['REMOTE_ADDR'];

		DBQuery("INSERT INTO ACCESS_LOG 
			(SYEAR,USERNAME,PROFILE,LOGIN_TIME,IP_ADDRESS,STATUS)
			values('" . Config( 'SYEAR' ) . "',
			'" . $username . "',
			'" . $student_profile_id . "',
			CURRENT_TIMESTAMP,		
			'" . $ip . "',
			'Successful Login' )" );

4.	The code below should be added on lines 238 in index.php. This line logs failed login attempts by everyone.
		
		// Record all failed login in Access Log.			
        $ip = $_SERVER['REMOTE_ADDR'];
	
		DBQuery("INSERT INTO ACCESS_LOG 
			(SYEAR,USERNAME,PROFILE,LOGIN_TIME,IP_ADDRESS,STATUS)
			values('" . Config( 'SYEAR' ) . "',
			'" . $username . "',
			'" . $failed_profile_id . "',
			CURRENT_TIMESTAMP,		
			'" . $ip . "',
			'Failed Login' )" );

	See included index.php for reference.

5.	Go to School Setup > School Configuration > Modules and activate the Security Module.

That's it. You should now have a new submenu under School Setup > Security called Access Log.