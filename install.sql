
/**********************************************************************
 install.sql file
 Required if the module adds programs to other modules
***********************************************************************/

/*******************************************************
 profile_id:
 	- 0: student
 	- 1: admin
 	- 2: teacher
 	- 3: parent
 modname: should match the Menu.php entries
 can_use: 'Y'
 can_edit: 'Y' or null (generally null for non admins)
*******************************************************/

--
-- Name: access_log; Type: TABLE;
--

CREATE TABLE access_log (
    syear numeric(4,0),
    username character varying(100),
	profile character varying(30),
    login_time timestamp(0) without time zone,
    ip_address character varying(50),
    status character varying(50)
);


--
-- Data for Name: profile_exceptions; Type: TABLE DATA;
--

INSERT INTO profile_exceptions VALUES (1, 'Access_Log/AccessLog.php', 'Y', 'Y');
