ALTER TABLE `photos` ADD `is_optin_sms` BOOLEAN NULL DEFAULT FALSE AFTER `is_postable_on_facebook`, ADD `is_optin_email` BOOLEAN NULL DEFAULT FALSE AFTER `is_optin_sms`, ADD `is_optin_galerie` BOOLEAN NULL DEFAULT FALSE AFTER `is_optin_email`; 