ALTER TABLE `image_fonds` CHANGE `type` `type` ENUM('accueil','cadre','filtre','remerciement','visualisation','choix_fv','prise_photo','selection_mult_config') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT 'Type page ecran';