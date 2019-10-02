#requette pour récupérer les timeline sur uploadp photo
SELECT COUNT(*) as nbr, 1 as 'type_timeline', created as date_timeline, queue , evenement_id, source_upload as 'source_timeline' FROM photos as p WHERE queue is not null or queue <>'' group BY queue 
#timeline contact
SELECT count(*) as nbr , 2 as 'type_timeline', c.created as "date_timeline", c.queue ,`p`.`evenement_id` AS `evenement_id`, c.source_upload as 'source_timeline' from contacts as c LEFT JOIN `photos` `p` ON `p`.`id` = `c`.`photo_id` AND (`p`.`is_in_corbeille` = 0) AND `p`.`deleted` = 0 LEFT JOIN `evenements` `ev` ON `ev`.`id` = `p`.`evenement_id` where c.queue is not null OR c.queue<> '' group by queue 
#timeline envoi email
SELECT count(*) as nbr , 3 as 'type_timeline', e.created as "date_timeline" , e.queue , `p`.`evenement_id` AS `evenement_id`, e.source_envoi as 'source_timeline' FROM envois as e LEFT JOIN `contacts` `c`ON `c`.`id` = `e`.`contact_id` LEFT JOIN `photos` `p` ON `p`.`id` = `c`.`photo_id` AND (`p`.`is_in_corbeille` = 0) AND `p`.`deleted` = 0 LEFT JOIN `evenements` `ev` ON `ev`.`id` = `p`.`evenement_id` WHERE e.envoi_type ='email' group by queue 
#timeline envoi sms
SELECT count(*) as nbr , 4 as 'type_timeline', e.created as "date_timeline" , e.queue , `p`.`evenement_id` AS `evenement_id`, e.source_envoi as 'source_timeline' FROM envois as e LEFT JOIN `contacts` `c`ON `c`.`id` = `e`.`contact_id` LEFT JOIN `photos` `p` ON `p`.`id` = `c`.`photo_id` AND (`p`.`is_in_corbeille` = 0) AND `p`.`deleted` = 0 LEFT JOIN `evenements` `ev` ON `ev`.`id` = `p`.`evenement_id` WHERE e.envoi_type ='sms' group by queue 
#timeline photo
SELECT COUNT(*) as nbr, 5 as 'type_timeline', p.date_corbeille as date_timeline, queue_crobeille as queue , evenement_id, 'bo' as 'source_timeline' FROM photos as p WHERE queue_crobeille is not null or queue_crobeille <>'' or p.date_corbeille is not null group BY queue_crobeille
#timeline connexion galerie
SELECT 1 as nbr, 6 as 'type_timeline', h.created as date_timeline, h.queue as queue , h.evenement_id, 'connexion' as 'source_timeline' FROM historique_connexions as h
#timeline téléchargement manuel photo par photo dans galerie
SELECT count(*) as nbr, 7 as 'type_timeline', d.created as date_timeline,d.queue as queue , p.evenement_id, d.source_download as 'source_timeline' FROM photo_downloads as d INNER JOIN photos as p ON p.id = d.photo_id INNER JOIN evenements as e ON e.id = p.evenement_id group BY queue 
#timeline téléchargement zip photo dans galerie
SELECT 1 as nbr, 8 as 'type_timeline', gd.created as date_timeline, gd.queue as queue , gd.evenement_id, gd.source_download as 'source_timeline' FROM galerie_downloads as gd GROUP by queue 
#timeline upload photoauto sur fb
SELECT count(*) as nbr , 9 as 'type_timeline', fb.created as "date_timeline" , fb.queue , `p`.`evenement_id` AS `evenement_id`, 'auto' as 'source_timeline' FROM facebook_auto_suivis as fb LEFT JOIN `photos` `p` ON `p`.`id` = `fb`.`photo_id` AND (`p`.`is_in_corbeille` = 0) AND `p`.`deleted` = 0 LEFT JOIN `evenements` `ev` ON `ev`.`id` = `p`.`evenement_id` group by queue 



#la grosse union de requette
(
    SELECT COUNT(*) as nbr, 1 as 'type_timeline', created as date_timeline, queue , evenement_id, source_upload as 'source_timeline' FROM photos as p WHERE queue is not null or queue <>'' group BY queue 
)
UNION
(
SELECT count(*) as nbr , 2 as 'type_timeline', c.created as "date_timeline", c.queue ,`p`.`evenement_id` AS `evenement_id`, c.source_upload as 'source_timeline' from contacts as c LEFT JOIN `photos` `p` ON `p`.`id` = `c`.`photo_id` AND (`p`.`is_in_corbeille` = 0) AND `p`.`deleted` = 0 LEFT JOIN `evenements` `ev` ON `ev`.`id` = `p`.`evenement_id` where c.queue is not null OR c.queue<> '' group by queue    
)
UNION(
 SELECT count(*) as nbr , 3 as 'type_timeline', e.created as "date_timeline" , e.queue , `p`.`evenement_id` AS `evenement_id`, e.source_envoi as 'source_timeline' FROM envois as e LEFT JOIN `contacts` `c`ON `c`.`id` = `e`.`contact_id` LEFT JOIN `photos` `p` ON `p`.`id` = `c`.`photo_id` AND (`p`.`is_in_corbeille` = 0) AND `p`.`deleted` = 0 LEFT JOIN `evenements` `ev` ON `ev`.`id` = `p`.`evenement_id` WHERE e.envoi_type ='email' group by queue 
)
UNION (
    SELECT count(*) as nbr , 4 as 'type_timeline', e.created as "date_timeline" , e.queue , `p`.`evenement_id` AS `evenement_id`, e.source_envoi as 'source_timeline' FROM envois as e LEFT JOIN `contacts` `c`ON `c`.`id` = `e`.`contact_id` LEFT JOIN `photos` `p` ON `p`.`id` = `c`.`photo_id` AND (`p`.`is_in_corbeille` = 0) AND `p`.`deleted` = 0 LEFT JOIN `evenements` `ev` ON `ev`.`id` = `p`.`evenement_id` WHERE e.envoi_type ='sms' group by queue 

    )