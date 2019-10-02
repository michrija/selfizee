
CREATE
    VIEW `contact_evenements` 
    AS
(
SELECT COUNT(c.id) AS total_contact , p.evenement_id FROM `contacts` AS c INNER JOIN photos AS p ON( p.id = c.photo_id AND p.is_in_corbeille = 0 AND p.deleted = 0 ) INNER JOIN evenements AS ev ON ev.id = p.evenement_id GROUP BY p.evenement_id 
);
