<?php
/**
 * Security module Menu entries
 *
 * @uses $menu global var
 *
 * @see  Menu.php in root folder
 * 
 * @package RosarioSIS
 * @subpackage modules
 */

// Security programs
if ( $RosarioModules['School_Setup'] )
{
	$menu['School_Setup']['admin'] += array(
		2 => _( 'Security' ),
		'Access_Log/AccessLog.php' => _( 'Access Log' )
	);
}
