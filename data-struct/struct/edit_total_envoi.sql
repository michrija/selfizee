
DROP VIEW IF EXISTS `email_envois`;

CREATE ALGORITHM=UNDEFINED DEFINER=`manager-selfizee`@`localhost` SQL SECURITY DEFINER VIEW `email_envois` AS (
SELECT COUNT(`e`.`id`) AS `total_envoi`, `p`.`evenement_id` AS `evenement_id`, COUNT(`st`.`id`) AS `total_ouvert` FROM `envois` `e` LEFT JOIN `contacts` `c` ON `c`.`id` = `e`.`contact_id` LEFT JOIN `photos` `p` ON `p`.`id` = `c`.`photo_id` AND `p`.`is_in_corbeille` = 0 AND `p`.`deleted` = 0 LEFT JOIN `evenements` `ev` ON `ev`.`id` = `p`.`evenement_id` LEFT JOIN (SELECT * FROM`envoi_email_statistiques` AS `stat` WHERE `stat`.`event_type` = 'open' GROUP BY `stat`.`envoi_id` ) `st` ON `st`.`envoi_id` = `e`.`id` WHERE `e`.`envoi_type` = 'email' GROUP BY `p`.`evenement_id` ORDER BY `total_ouvert` DESC 
);