
DROP VIEW IF EXISTS `timelines`;

CREATE ALGORITHM=UNDEFINED DEFINER=`manager-selfizee`@`localhost` SQL SECURITY DEFINER VIEW `timelines` AS (
SELECT COUNT(0) AS `nbr`,1 AS `type_timeline`,`p`.`created` AS `date_timeline`,
`p`.`queue` AS `queue`,`p`.`evenement_id` AS `evenement_id`,`p`.`source_upload` AS `source_timeline` 
FROM `photos` `p` WHERE ((`p`.`queue` IS NOT NULL) OR (`p`.`queue` <> '')) GROUP BY `p`.`queue`) 
UNION (SELECT COUNT(0) AS `nbr`,2 AS `type_timeline`,`c`.`created` AS `date_timeline`,`c`.`queue` AS `queue`,
`p`.`evenement_id` AS `evenement_id`,`c`.`source_upload` AS `source_timeline` 
FROM ((`contacts` `c` LEFT JOIN `photos` `p` ON(((`p`.`id` = `c`.`photo_id`) AND (`p`.`is_in_corbeille` = 0) 
AND (`p`.`deleted` = 0)))) LEFT JOIN `evenements` `ev` ON((`ev`.`id` = `p`.`evenement_id`))) WHERE ((`c`.`queue` IS NOT NULL) 
OR (`c`.`queue` <> '')) GROUP BY `c`.`queue`) 
UNION (SELECT COUNT(0) AS `nbr`,3 AS `type_timeline`,`e`.`created` AS `date_timeline`,`e`.`queue` AS `queue`,
`p`.`evenement_id` AS `evenement_id`,`e`.`source_envoi` AS `source_timeline` 
FROM (((`envois` `e` LEFT JOIN `contacts` `c` ON((`c`.`id` = `e`.`contact_id`))) 
LEFT JOIN `photos` `p` ON(((`p`.`id` = `c`.`photo_id`) AND (`p`.`is_in_corbeille` = 0) 
AND (`p`.`deleted` = 0)))) LEFT JOIN `evenements` `ev` ON((`ev`.`id` = `p`.`evenement_id`)))
 WHERE (`e`.`envoi_type` = 'email') GROUP BY `e`.`queue`) 
 UNION (SELECT COUNT(0) AS `nbr`,4 AS `type_timeline`,`e`.`created` AS `date_timeline`,`e`.`queue` AS `queue`,
 `p`.`evenement_id` AS `evenement_id`,`e`.`source_envoi` AS `source_timeline` 
 FROM (((`envois` `e` LEFT JOIN `contacts` `c` ON((`c`.`id` = `e`.`contact_id`))) 
 LEFT JOIN `photos` `p` ON(((`p`.`id` = `c`.`photo_id`) AND (`p`.`is_in_corbeille` = 0) AND (`p`.`deleted` = 0)))) 
 LEFT JOIN `evenements` `ev` ON((`ev`.`id` = `p`.`evenement_id`))) WHERE (`e`.`envoi_type` = 'sms') GROUP BY `e`.`queue`)
 UNION (
 SELECT COUNT(*) as nbr, 5 as 'type_timeline', p.date_corbeille as date_timeline, queue_crobeille as queue , evenement_id, 'bo' as 'source_timeline' FROM photos as p WHERE queue_crobeille is not null or queue_crobeille <>'' or p.date_corbeille is not null group BY queue_crobeille

 )
 
 ;
