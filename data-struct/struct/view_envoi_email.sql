
CREATE
    /*[ALGORITHM = {UNDEFINED | MERGE | TEMPTABLE}]
    [DEFINER = { user | CURRENT_USER }]
    [SQL SECURITY { DEFINER | INVOKER }]*/
    VIEW `email_envois` 
    AS
(
SELECT COUNT(e.id) AS total_envoi , p.evenement_id FROM `envois` AS e INNER JOIN contacts AS c ON c.id = e.contact_id INNER JOIN photos AS p ON( p.id = c.photo_id AND p.is_in_corbeille = 0 AND p.deleted = 0 ) INNER JOIN evenements AS ev ON ev.id = p.evenement_id WHERE e.envoi_type = 'email' GROUP BY p.evenement_id 
);
