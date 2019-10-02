ALTER TABLE `ecrans_navigations` ADD `is_active_page_filtre_image_fond` TINYINT(1) NULL DEFAULT NULL AFTER `page_prise_photos_couleur_fond`,
 ADD `page_filtre_image_fond` VARCHAR(255) NULL AFTER `is_active_page_filtre_image_fond`,
  ADD `page_filtre_couleur_fond` VARCHAR(255) NULL AFTER `page_filtre_image_fond`;

 ALTER TABLE `ecrans_navigations` ADD `is_active_page_remerc_image_fond` TINYINT(1) NULL DEFAULT NULL AFTER `page_filtre_couleur_fond`,
 ADD `page_remerc_image_fond` VARCHAR(255) NULL AFTER `is_active_page_remerc_image_fond`,
 ADD `page_remerc_couleur_fond` VARCHAR(255) NULL AFTER `page_remerc_image_fond`;

 ALTER TABLE `ecrans_navigations` ADD `page_filtre_titre` VARCHAR(255) NULL AFTER `page_filtre_couleur_fond`;

  ALTER TABLE `ecrans_navigations` ADD `is_active_page_choix_fv_image_fond` TINYINT(1) NULL DEFAULT NULL AFTER `page_filtre_titre`,
 ADD `page_choix_fv_image_fond` VARCHAR(255) NULL AFTER `is_active_page_choix_fv_image_fond`,
 ADD `page_choix_fv_couleur_fond` VARCHAR(255) NULL AFTER `page_choix_fv_image_fond`;

 ALTER TABLE `ecrans_navigations` ADD `is_active_page_vis_photo_image_fond` TINYINT(1) NULL DEFAULT NULL AFTER `page_choix_fv_couleur_fond`,
 ADD `page_vis_photo_image_fond` VARCHAR(255) NULL AFTER `is_active_page_vis_photo_image_fond`,
 ADD `page_vis_photo_couleur_fond` VARCHAR(255) NULL AFTER `page_vis_photo_image_fond`;