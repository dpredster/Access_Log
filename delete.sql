
/**********************************************************
 delete.sql file
 Required if install.sql file present
 - Delete profile exceptions
***********************************************************/


--
-- Delete Table access_log
--

DROP TABLE access_log;


--
-- Delete profile exceptions
--

DELETE FROM profile_exceptions WHERE modname='Security/AccessLog.php';

