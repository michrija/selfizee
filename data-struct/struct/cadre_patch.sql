ALTER TABLE `ecrans`
  DROP `btn_page_prise_photo`,
  DROP `btn_page_prise_photo_visualisation`,
  DROP `btn_page_choix_filtre`,
  DROP `btn_page_remerciement`;
ALTER TABLE `ecrans` ADD `page_choix_fond_vert` VARCHAR(250) NULL AFTER `page_remerciement`; 