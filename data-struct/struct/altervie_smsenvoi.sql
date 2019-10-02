DROP VIEW IF EXISTS `sms_envois`;

CREATE ALGORITHM=UNDEFINED DEFINER=`manager-selfizee`@`localhost` SQL SECURITY DEFINER VIEW `sms_envois` AS (
SELECT
  COUNT(`e`.`id`)    AS `total_envoi`,
  `p`.`evenement_id` AS `evenement_id`,
  COUNT(`stat`.`id`) AS `total_ouvert`
FROM ((((`envois` `e`
      JOIN `contacts` `c`
        ON ((`c`.`id` = `e`.`contact_id`)))
     JOIN `photos` `p`
       ON (((`p`.`id` = `c`.`photo_id`)
            AND (`p`.`is_in_corbeille` = 0)
            AND (`p`.`deleted` = 0))))
    JOIN `evenements` `ev`
      ON ((`ev`.`id` = `p`.`evenement_id`)))
   LEFT JOIN `envoi_statistiques` `stat`
     ON ((`stat`.`envoi_id` = `e`.`id`)))
WHERE (`e`.`envoi_type` = 'sms')
GROUP BY `p`.`evenement_id`)

