CREATE ALGORITHM=UNDEFINED DEFINER=`manager-selfizee`@`localhost` SQL SECURITY DEFINER VIEW `timelines` AS (
select count(0) AS `nbr`,1 AS `type_timeline`,`p`.`user_id` AS `user_id`,`p`.`created` AS `date_timeline`,`p`.`queue` AS `queue`,
`p`.`evenement_id` AS `evenement_id`,`p`.`source_upload` AS `source_timeline` 
from `photos` `p` where (`p`.`queue` is not null or `p`.`queue` <> '') and `p`.`type_media` = 'photo' group by `p`.`queue`,`p`.`user_id`
) 
union (
	select count(0) AS `nbr`,11 AS `type_timeline`,`p`.`user_id` AS `user_id`,`p`.`created` AS `date_timeline`,`p`.`queue` AS `queue`,
	`p`.`evenement_id` AS `evenement_id`,`p`.`source_upload` AS `source_timeline` 
	from `photos` `p` where (`p`.`queue` is not null or `p`.`queue` <> '') and `p`.`type_media` = 'video' group by `p`.`queue`,`p`.`user_id`) 
union (
	select count(0) AS `nbr`,2 AS `type_timeline`,`c`.`user_id` AS `user_id`,`c`.`created` AS `date_timeline`,`c`.`queue` AS `queue`,
	`p`.`evenement_id` AS `evenement_id`,`c`.`source_upload` AS `source_timeline` 
	from ((`contacts` `c` left join `photos` `p` on(`p`.`id` = `c`.`photo_id` and `p`.`is_in_corbeille` = 0 and `p`.`deleted` = 0)) 
	left join `evenements` `ev` on(`ev`.`id` = `p`.`evenement_id`)) where `c`.`queue` is not null or `c`.`queue` <> '' 
	group by `c`.`queue`,`c`.`user_id`
) union (
	select count(0) AS `nbr`,3 AS `type_timeline`,`e`.`user_id` AS `user_id`,`e`.`created` AS `date_timeline`,`e`.`queue` AS `queue`,
	`p`.`evenement_id` AS `evenement_id`,`e`.`source_envoi` AS `source_timeline` 
	from (((`envois` `e` left join `contacts` `c` on(`c`.`id` = `e`.`contact_id`)) 
	left join `photos` `p` on(`p`.`id` = `c`.`photo_id` and `p`.`is_in_corbeille` = 0 and `p`.`deleted` = 0)) 
	left join `evenements` `ev` on(`ev`.`id` = `p`.`evenement_id`)) where `e`.`envoi_type` = 'email' group by `e`.`queue`,`e`.`user_id`
) 
union (
	select count(0) AS `nbr`,4 AS `type_timeline`,`e`.`user_id` AS `user_id`,`e`.`created` AS `date_timeline`,`e`.`queue` AS `queue`,
	`p`.`evenement_id` AS `evenement_id`,`e`.`source_envoi` AS `source_timeline` 
	from (((`envois` `e` left join `contacts` `c` on(`c`.`id` = `e`.`contact_id`)) 
	left join `photos` `p` on(`p`.`id` = `c`.`photo_id` and `p`.`is_in_corbeille` = 0 and `p`.`deleted` = 0)) 
	left join `evenements` `ev` on(`ev`.`id` = `p`.`evenement_id`)) where `e`.`envoi_type` = 'sms' group by `e`.`queue`,`e`.`user_id`
) union (
	select count(0) AS `nbr`,5 AS `type_timeline`,`p`.`user_id` AS `user_id`,`p`.`date_corbeille` AS `date_timeline`,
	`p`.`queue_crobeille` AS `queue`,`p`.`evenement_id` AS `evenement_id`,'bo' AS `source_timeline` from `photos` `p` 
	where `p`.`queue_crobeille` is not null or `p`.`queue_crobeille` <> '' or `p`.`date_corbeille` is not null 
	group by `p`.`queue_crobeille`,`p`.`user_id`
) union (
	select count(0) AS `nbr`,5 AS `type_timeline`,0 AS `user_id`,`p`.`deleted_date_rgpd` AS `date_timeline`,`p`.`queue_rgpd` AS `queue`,
	`p`.`evenement_id` AS `evenement_id`,'rgpd' AS `source_timeline` from `photos` `p` 
	where `p`.`queue_rgpd` is not null or `p`.`queue_rgpd` <> '' or `p`.`deleted_date_rgpd` is not null group by `p`.`queue_rgpd`
) union (
	select 1 AS `nbr`,6 AS `type_timeline`,`h`.`user_id` AS `user_id`,`h`.`created` AS `date_timeline`,`h`.`queue` AS `queue`,
	`h`.`evenement_id` AS `evenement_id`,'connexion' AS `source_timeline` from `historique_connexions` `h`
) union (
	select count(0) AS `nbr`,7 AS `type_timeline`,`d`.`user_id` AS `user_id`,`d`.`created` AS `date_timeline`,`d`.`queue` AS `queue`,
	`p`.`evenement_id` AS `evenement_id`,`d`.`source_download` AS `source_timeline` 
	from ((`photo_downloads` `d` join `photos` `p` on(`p`.`id` = `d`.`photo_id`)) 
	join `evenements` `e` on(`e`.`id` = `p`.`evenement_id`)) group by `d`.`queue`,`d`.`user_id`
) union (
	select count(0) AS `nbr`,8 AS `type_timeline`,`gd`.`user_id` AS `user_id`,`gd`.`created` AS `date_timeline`,`gd`.`queue` AS `queue`,
	`gd`.`evenement_id` AS `evenement_id`,`gd`.`source_download` AS `source_timeline` from `galerie_downloads` `gd` 
	group by `gd`.`queue`,`gd`.`user_id`) 
union (
	select count(0) AS `nbr`,9 AS `type_timeline`,0 AS `user_id`,`fb`.`created` AS `date_timeline`,`fb`.`queue` AS `queue`,
	`p`.`evenement_id` AS `evenement_id`,'auto' AS `source_timeline` 
	from ((`facebook_auto_suivis` `fb` left join `photos` `p` 
	on(`p`.`id` = `fb`.`photo_id` and `p`.`is_in_corbeille` = 0 and `p`.`deleted` = 0)) 
	left join `evenements` `ev` on(`ev`.`id` = `p`.`evenement_id`)) 
	group by `fb`.`queue`
)
