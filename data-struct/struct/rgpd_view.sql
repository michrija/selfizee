DELIMITER $$

-- USE `selfizeev2`$$
-- USE `selfizee_event`$$
USE `manager_selfizee_app`$$

DROP VIEW IF EXISTS `timelines`$$

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `timelines` AS (
SELECT COUNT(0) AS `nbr`,1 AS `type_timeline`,`p`.`created` AS `date_timeline`,`p`.`queue` AS `queue`,`p`.`evenement_id` AS `evenement_id`,`p`.`source_upload` AS `source_timeline` FROM `photos` `p` WHERE ((`p`.`queue` IS NOT NULL) OR (`p`.`queue` <> '')) GROUP BY `p`.`queue`) 

UNION (SELECT COUNT(0) AS `nbr`,2 AS `type_timeline`,`c`.`created` AS `date_timeline`,`c`.`queue` AS `queue`,`p`.`evenement_id` AS `evenement_id`,`c`.`source_upload` AS `source_timeline` FROM ((`contacts` `c` LEFT JOIN `photos` `p` ON(((`p`.`id` = `c`.`photo_id`) AND (`p`.`is_in_corbeille` = 0) AND (`p`.`deleted` = 0)))) LEFT JOIN `evenements` `ev` ON((`ev`.`id` = `p`.`evenement_id`))) WHERE ((`c`.`queue` IS NOT NULL) OR (`c`.`queue` <> '')) GROUP BY `c`.`queue`) 

UNION (SELECT COUNT(0) AS `nbr`,3 AS `type_timeline`,`e`.`created` AS `date_timeline`,`e`.`queue` AS `queue`,`p`.`evenement_id` AS `evenement_id`,`e`.`source_envoi` AS `source_timeline` FROM (((`envois` `e` LEFT JOIN `contacts` `c` ON((`c`.`id` = `e`.`contact_id`))) LEFT JOIN `photos` `p` ON(((`p`.`id` = `c`.`photo_id`) AND (`p`.`is_in_corbeille` = 0) AND (`p`.`deleted` = 0)))) LEFT JOIN `evenements` `ev` ON((`ev`.`id` = `p`.`evenement_id`))) WHERE (`e`.`envoi_type` = 'email') GROUP BY `e`.`queue`) 

UNION (SELECT COUNT(0) AS `nbr`,4 AS `type_timeline`,`e`.`created` AS `date_timeline`,`e`.`queue` AS `queue`,`p`.`evenement_id` AS `evenement_id`,`e`.`source_envoi` AS `source_timeline` FROM (((`envois` `e` LEFT JOIN `contacts` `c` ON((`c`.`id` = `e`.`contact_id`))) LEFT JOIN `photos` `p` ON(((`p`.`id` = `c`.`photo_id`) AND (`p`.`is_in_corbeille` = 0) AND (`p`.`deleted` = 0)))) LEFT JOIN `evenements` `ev` ON((`ev`.`id` = `p`.`evenement_id`))) WHERE (`e`.`envoi_type` = 'sms') GROUP BY `e`.`queue`) 

UNION (SELECT COUNT(0) AS `nbr`,5 AS `type_timeline`,`p`.`date_corbeille` AS `date_timeline`,`p`.`queue_crobeille` AS `queue`,`p`.`evenement_id` AS `evenement_id`,'bo' AS `source_timeline` FROM `photos` `p` WHERE ((`p`.`queue_crobeille` IS NOT NULL) OR (`p`.`queue_crobeille` <> '') OR (`p`.`date_corbeille` IS NOT NULL)) GROUP BY `p`.`queue_crobeille`) 
UNION (SELECT COUNT(0) AS `nbr`,5 AS `type_timeline`,`p`.`deleted_date_rgpd` AS `date_timeline`,`p`.`queue_rgpd` AS `queue`,`p`.`evenement_id` AS `evenement_id`,'rgpd' AS `source_timeline` FROM `photos` `p` WHERE ((`p`.`queue_rgpd` IS NOT NULL) OR (`p`.`queue_rgpd` <> '') OR (`p`.`deleted_date_rgpd` IS NOT NULL)) GROUP BY `p`.`queue_rgpd`) 

UNION (SELECT 1 AS `nbr`,6 AS `type_timeline`,`h`.`created` AS `date_timeline`,`h`.`queue` AS `queue`,`h`.`evenement_id` AS `evenement_id`,'connexion' AS `source_timeline` FROM `historique_connexions` `h`) 

UNION (SELECT COUNT(0) AS `nbr`,7 AS `type_timeline`,`d`.`created` AS `date_timeline`,`d`.`queue` AS `queue`,`p`.`evenement_id` AS `evenement_id`,`d`.`source_download` AS `source_timeline` FROM ((`photo_downloads` `d` JOIN `photos` `p` ON((`p`.`id` = `d`.`photo_id`))) JOIN `evenements` `e` ON((`e`.`id` = `p`.`evenement_id`))) GROUP BY `d`.`queue`) 

UNION (SELECT COUNT(0) AS `nbr`,8 AS `type_timeline`,`gd`.`created` AS `date_timeline`,`gd`.`queue` AS `queue`,`gd`.`evenement_id` AS `evenement_id`,`gd`.`source_download` AS `source_timeline` FROM `galerie_downloads` `gd` GROUP BY `gd`.`queue`) 

UNION (SELECT COUNT(0) AS `nbr`,9 AS `type_timeline`,`fb`.`created` AS `date_timeline`,`fb`.`queue` AS `queue`,`p`.`evenement_id` AS `evenement_id`,'auto' AS `source_timeline` FROM ((`facebook_auto_suivis` `fb` LEFT JOIN `photos` `p` ON(((`p`.`id` = `fb`.`photo_id`) AND (`p`.`is_in_corbeille` = 0) AND (`p`.`deleted` = 0)))) LEFT JOIN `evenements` `ev` ON((`ev`.`id` = `p`.`evenement_id`))) GROUP BY `fb`.`queue`)$$

DELIMITER ;