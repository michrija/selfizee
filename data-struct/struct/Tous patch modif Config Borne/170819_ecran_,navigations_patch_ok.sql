ALTER TABLE `ecrans_navigations` ADD `is_active_page_accueil_image_fond` TINYINT(1) NOT NULL DEFAULT '1' AFTER `config_borne_id`;
                        ALTER TABLE `ecrans_navigations` ADD `is_active_page_accueil_image_btn_fond` TINYINT(1) NOT NULL DEFAULT '1' AFTER `page_config_fond_id`;
                        ALTER TABLE `ecrans_navigations` ADD `is_active_page_prise_photo_image_fond` TINYINT(1) NOT NULL DEFAULT '1' AFTER `page_config_police_id`;