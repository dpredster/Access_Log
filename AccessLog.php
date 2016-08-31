<?php
DrawHeader( ProgramTitle() );

	// Set start date as the 1st of the month and end date as current day.
        $search_start_date = date( 'Y-m' ) . '-01';
		$search_end_date = DBDate();

	// Set start date.
	if ( $_REQUEST['day_start']
		&& $_REQUEST['month_start']
		&& $_REQUEST['year_start'] )
	{
		$start_date = RequestedDate(
			$_REQUEST['year_start'],
			$_REQUEST['month_start'],
			$_REQUEST['day_start']
		);
	}
	else
	{
	$min_date = DBGet( DBQuery( "SELECT min(LOGIN_TIME) AS MIN_DATE
			FROM ACCESS_LOG
			WHERE SYEAR='" . UserSyear() . "'" ) );
			
			if ( isset( $min_date[1]['MIN_DATE'] ) )
		{
			$start_date = $min_date[1]['MIN_DATE'];
		}
		else
			$start_date = date( 'Y-m' ) . '-01';
	}
	
	// Set end date.
	if ( $_REQUEST['day_end']
		&& $_REQUEST['month_end']
		&& $_REQUEST['year_end'] )
	{
		$inputed_end_date = RequestedDate(
			$_REQUEST['year_end'],
			$_REQUEST['month_end'],
			$_REQUEST['day_end']
		);
		
		$end_date = $inputed_end_date . ' 23:59:59';		
	}
	else
	{
		$max_date = DBGet( DBQuery( "SELECT max(LOGIN_TIME) AS MAX_DATE
			FROM ACCESS_LOG
			WHERE SYEAR='" . UserSyear() . "'" ) );

		if ( isset( $max_date[1]['MAX_DATE'] ) )
		{
			$end_date = $max_date[1]['MAX_DATE'];
		}
		else
			$end_date = DBDate();
	}

echo '<br><FORM name=log id=log action="Modules.php?modname='.$_REQUEST['modname'].'&modfunc=generate" method=POST>';
DrawHeader(_('From ').''.PrepareDate($search_start_date,'_start').' '._('To ').' '.PrepareDate($search_end_date,'_end').' <input type="submit" class="btn btn-primary" value="'._('Go').'">');
echo '</form>';	
	
if($_REQUEST['modfunc']=='generate')
{   

 if(isset($start_date) && isset($end_date))
	{
	 $alllogs_RET = DBGet(DBQuery('SELECT 
			DISTINCT USERNAME,PROFILE,LOGIN_TIME,IP_ADDRESS,STATUS 
			FROM ACCESS_LOG 
			WHERE LOGIN_TIME >=\''.$start_date.'\' 
			AND LOGIN_TIME <=\''.$end_date.'\' 
			ORDER BY LOGIN_TIME DESC'));
	 
if(count($alllogs_RET))
		{
			echo '<div>';	 
				echo '<form name=del id=del action="Modules.php?modname='.$_REQUEST['modname'].'&modfunc=update" method="POST">';				
					DrawHeader('',SubmitButton(_('Clear Log'),_('del')));
					ListOutput($alllogs_RET,array('LOGIN_TIME'=>'Login Time','USERNAME'=>'Username','PROFILE'=>'User Profile','STATUS'=>'Status','IP_ADDRESS'=>'IP Address'),'login record','login records',array(),array(),array('count'=>true,'save'=>true));
				echo '<div class="center">' . SubmitButton( _('Clear Log'),_('del') ) . '</div>';
				echo '</form>';			
			echo '</div>';
		}
		else
		{
		
		echo '<table border=0 width=90%><tr><td class="alert"></td><td class="alert_msg"><b>No login records were found.</b></td></tr></table>';
		
		}		
}

if((!isset($start_date) || !isset($end_date)))
	{
		echo '<center><font color="red"><b>You have to select date from the date range</b></font></center>';

	}   
}
if($_REQUEST['modfunc']=='update')
	{
		// Prompt before deleting log.
		if (Prompt(_('Confirm').' '._('Access Log Deletion'),sprintf(_('Are you sure you want to delete all data stored in the Access Log?')),$table_list))
{
		DBQuery('DELETE FROM ACCESS_LOG WHERE LOGIN_TIME >=\''.$start_date.'\' AND LOGIN_TIME <=\''.$end_date.'\'');
		echo '<center><font color="red"><b>Access Log deleted successfully</b></font></center>';
}
	}
?>