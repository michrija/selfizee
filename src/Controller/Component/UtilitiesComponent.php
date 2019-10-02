<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

class UtilitiesComponent extends Component
{
	
	// Encryption
	function slEncryption($data){
		// $key = 1;
		// $encryption_key = base64_decode($key);
		// $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
		// $encrypted = openssl_encrypt($data, 'aes-256-cbc', $encryption_key, 0, $iv);
		// $slEncryption = base64_encode($encrypted . '::' . $iv);
		
		// $slEncryption = str_replace('/', 'TSquPIVPIVPIVOuqT', $slEncryption);
		$slEncryption = base64_encode(base64_encode(base64_encode($data)));
		
		
		return $slEncryption;
	}
	
	// Decryption
	function slDecryption($data) {
		// $key = 1;
		// $data = str_replace('TSquPIVPIVPIVOuqT', '/', $data);
		// $encryption_key = base64_decode($key);
		// list($encrypted_data, $iv) = explode('::', base64_decode($data), 2);
		// $slDecryption = openssl_decrypt($encrypted_data, 'aes-256-cbc', $encryption_key, 0, $iv);
		$slDecryption = base64_decode(base64_decode(base64_decode($data)));
		
		return $slDecryption;
	}
	
}