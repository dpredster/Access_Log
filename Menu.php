<?php
/**
 * Security module Menu entries
 *
 * @uses $menu global var
 *
 * @see  Menu.php in root folder
 *
 * @package RosarioSIS
 * @subpackage Access_Log modules
 */

// Security programs
if ( $RosarioModules['School_Setup'] )
{
	$menu['School_Setup']['admin'] += array(
		2 => dgettext( 'Access_Log', 'Security' ),
		'Access_Log/AccessLog.php' => dgettext( 'Access_Log', 'Access Log' ),
	);
}
