/*
MySQL Backup
Database: nolimit
Backup Time: 2024-11-16 16:17:14
*/

SET FOREIGN_KEY_CHECKS=0;
DROP FUNCTION IF EXISTS `fnGetSubMenuAccessCount`;
DROP FUNCTION IF EXISTS `fnGetSubMenuCount`;
DROP FUNCTION IF EXISTS `fnGetUserAccess`;
DROP FUNCTION IF EXISTS `fnGetUserGroup`;
DROP FUNCTION IF EXISTS `fnGetUserMenuAccess`;

DELIMITER //

CREATE FUNCTION `fnGetSubMenuAccessCount`(`vUser` varchar(200),`vMenuID` varchar(255)) RETURNS int
BEGIN
-- 	fnGetSubMenuAccessCount
	RETURN IFNULL((SELECT count(*) FROM menu WHERE active=1 AND fnGetUserMenuAccess (vUser,menuID) >= 1 AND menuid LIKE CONCAT(vMenuID,'%') AND LENGTH(menuid)=LENGTH(vMenuID)+2),0);
END //

CREATE FUNCTION `fnGetSubMenuCount`(`vMenuID` varchar(20)) RETURNS int
BEGIN
	#fnGetSubMenuCount
	RETURN IFNULL((SELECT count(*) FROM menu WHERE active=1 AND menuid LIKE CONCAT(vMenuID,'%') AND LENGTH(menuid)=LENGTH(vMenuID)+2),0);
END //

CREATE FUNCTION `fnGetUserAccess`(`vUser` varchar(200),`vLink` varchar(255)) RETURNS int
BEGIN
	#fnGetUserAccess
	if ((SELECT public FROM menu WHERE menu.link LIKE  concat('/',vLink) LIMIT 1)=1) THEN
		RETURN 1;
	ELSE
		if (SELECT usergroup FROM `user` WHERE UserID=vUser)!='SA' THEN
			RETURN (SELECT 
				CASE WHEN public=1 THEN public ELSE count(menu.menuid) END
			FROM 
				menu,usermenu 
			WHERE 
				menu.menuid=usermenu.menuid AND 
				menu.link LIKE concat('/',vLink) AND
				(usermenu.userid= vUser OR usermenu.userid=fnGetUsergroup(vUser)));
		ELSE
			RETURN (SELECT 1);
		END IF;
	END IF;
END //

CREATE FUNCTION `fnGetUserGroup`(`vUserID` varchar(200)) RETURNS varchar(200) CHARSET latin1
BEGIN
	#fnGetUserGroup
	RETURN IFNULL((SELECT usergroup FROM `user` WHERE UserID=vUserID),vUserID);
END //

CREATE FUNCTION `fnGetUserMenuAccess`(`vUser` varchar(200),`vMenuID` varchar(255)) RETURNS int
BEGIN
-- 	#fnGetUserMenuAccess
-- 	DECLARE @result INT
	if (SELECT `public` FROM menu WHERE menuid=vMenuID LIMIT 1)=1 THEN
		RETURN 1;
	ELSE
		if IFNULL((SELECT usergroup FROM `user` WHERE UserID=vUser),'')!='SA' THEN
			RETURN IFNULL((SELECT 
				CASE WHEN `public`=1 THEN `public` ELSE count(menu.menuid) END
			FROM 
				menu,usermenu 
			WHERE 
				menu.menuid=usermenu.menuid AND 
				menu.menuid = vMenuID AND
				(usermenu.userid=vUser OR usermenu.userid=fnGetUsergroup(vUser))
			GROUP BY menu.`public`),0);
		ELSE
			RETURN 1;
		END IF;
	END IF;
END //

DELIMITER ;
