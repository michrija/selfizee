<?php
namespace App\Controller;

use App\Controller\AppController;

use Mpociot\BotMan\BotManFactory;
use Mpociot\BotMan;

	//require __DIR__.'/vendor/autoload.php';

	/**
	 * Webhooks Controller
	 *
	 * @property \App\Model\Table\ContactServicesTable $ContactServices
	 *
	 * @method \App\Model\Entity\ContactService[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
	 */
	class WebhooksController extends AppController
	{
	    public function isAuthorized($user)
	    {

	        $action = $this->request->getParam('action');

	        return true;

	        return parent::isAuthorized($user);
	    }

	    public function facebook() {

	    	$access_token = "EAAFZCIocVDoQBACicVbNUfTiEZBckY005CvdmIDzwjhc6qusxHke3L0dWzX6J9Oo7lCNasaDL1VhzzrEo2BZBtabtcS6pT0W299QGNoUDdHsW2Uuv8z2Ag7Lqhzmf8NXkyeJSnisXweylY7IhLB6H6xAgILhkjxhbi3NsEKsQZDZD";
			$verify_token = "31432543fcjhsjdbvhjbfjngkjjtneklnhgkcgtreghtrkelcfjhghfgzdifguzdghfioghzo";
			$hub_verify_token = null;

				
			if(isset($_GET['hub_mode']) && $_GET['hub_mode'] == 'subscribe') {
					$challenge = $_GET['hub_challenge'];
					$hub_verify_token = $_GET['hub_verify_token'];
				if($hub_verify_token === $verify_token){
					header('HTTP://1.1 200 OK');
					echo $challenge;
					die;
				}
			}	
				$input = json_decode(file_get_contents('php://input'));
				//debug($input);die;
				$sender = $input['entry'][0]['messenging'][0]['sender']['id'];				
			    $message = isset($input['entry'][0]['messenging'][0]['message']['text'])? ($input['entry'][0]['messenging'][0]['message']['text']): '';

				if($message == "Bonjour"){
					
					$message_to_reply == "Ceci est le message à envoyer à l'utilisateur";
					
					$url = "https://graph.facebook.com/v3.2/me/messages?access_token=".$access_token;					
					
					$jsonData = '{
						"recipient":{
							"id":"'.$sender.'"
						},
						"messages":{
							"text":"'.$message_to_reply.'"
						} 
					}';

				$ch = curl_init($url);
				$curl_setopt($ch, CURLOPT_POST, 1);
				$curl_setopt($ch, CURLOPT_POSTFIELDS, $jsonData);
				$curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
				$curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
				$result = curl_exec($ch);
				//debug($result);die;
				curl_close($ch);
			   }

			    $feedData = file_get_contents('php://input');			   
				$handle = fopen('text.txt', 'w');
				fwrite($handle, $feedData);
				fclose($handle);
				//$feedData = file_get_contents('php://input');
				$data = json_decode($feedData);
				debug($data);die;
}

	public function statfb() {		 	 

		 $fb = new \Facebook\Facebook([
		 	'app_id' => '2259703787620824',
		 	'app_secret' => '5fc7761e166fdfe0e5ce3b6dd1e74b9d',
		 	'default_graph_version' => 'v3.2',
		 ]);

$fb->setDefaultAccessToken('EAAgHMEmPCdgBAPXH1K7rKLmgslLiVmvE1fYMlMcfrBVRohVi4Bq4Jo91rv1HjeCGmefrNvRgQ5GZBHWLPGll4IBTHPWBpr6yw2VymQUDoNWtEAoybJYZAZCyZA0RQPaqfwCJlnL6NY6EWB1dUtK1k5I7oXgxjZC67zBTPt21uBgZDZD');

// Example : Get page impression
$requestPageImpression = $fb->request('GET', '418207008724298_422030318341967/comments?summary=total_count');

// Example : Get Organic page impressions
$requestPageImpressionOrganic = $fb->request('GET', '418207008724298_422030318341967/likes?summary=total_count');

$requestPagePost = $fb->request('GET', '/418207008724298_422030318341967?fields=shares,link');

// echo $requestPageImpression + $requestPageImpressionOrganic + $requestPagePost;
//debug($requestPageImpressionOrganic);die;

$test = $fb->get(
    '/418207008724298_422030318341967',
    'EAAgHMEmPCdgBAPXH1K7rKLmgslLiVmvE1fYMlMcfrBVRohVi4Bq4Jo91rv1HjeCGmefrNvRgQ5GZBHWLPGll4IBTHPWBpr6yw2VymQUDoNWtEAoybJYZAZCyZA0RQPaqfwCJlnL6NY6EWB1dUtK1k5I7oXgxjZC67zBTPt21uBgZDZD'
  );

//debug($test);die;

//$requestPostShare = $fb->get('GET', '418207008724298/posts?fields=id,link');
//debug($requestPagePost);

// Add more variable and API req, according to your list
// $requestPageStories = $fb->request('GET','....');
// etc...

$batch = [
    'page-impression' => $requestPageImpression,
    'page-impression-organic' => $requestPageImpressionOrganic, 
    'page-post' => $requestPagePost,
    //'shared-posts' => $requestPostShare,
    // add more for your list
    ];

echo '<h1>Engagement et impression Facebook photo souvenir (http://managerdev.selfizee.fr)</h1>' . "\n\n";

try {
  $responses = $fb->sendBatchRequest($batch);
} catch(Facebook\Exceptions\FacebookResponseException $e) {
  // When Graph returns an error
  echo 'Graph returned an error: ' . $e->getMessage();
  exit;
} catch(Facebook\Exceptions\FacebookSDKException $e) {
  // When validation fails or other local issues
  echo 'Facebook SDK returned an error: ' . $e->getMessage();
  exit;
}

    //$a = $response->summary->total_count;
	// $b = $response->summary->total_count;
	// $c = $response->shares->count;
	// $d = $a + $b + $c;
	// debug($d);die;

foreach ($responses as $key => $response) {	
  if ($response->isError()) {
  } else {

  	$response = $response->getBody();
  	$response = json_decode($response);
  	//debug($response);die;
    if ($key == 'page-impression') {
    	$total_counts = $response->summary->total_count;
    	echo "Comments: " .$response->summary->total_count. "<br><br>";
    	//debug($response);
    }else if ($key == 'page-impression-organic') {
    	$total_lik = $response->summary->total_count;
    	echo "Likes: " .$response->summary->total_count. "<br><br>";
    }else if ($key == 'page-post') {
    	$total_shar = $response->shares->count;
  	    //echo '<pre>'; print_r($response->data[0]->link);
  	    //debug($response->link);die; 
  	     echo "Link photo souvenir: " .$response->link. "<br><br>";
  	     echo "Nombre de partage: " .$response->shares->count. "<br><br>";
  	     echo "Nombre de clics sur la publication: <br><br>";
  	     $somme = $total_lik + $total_counts + $total_shar;
  	     echo "Impression: <br><br>";
  	     echo "Engagement: " .$somme. "<br><br>";  	     
  	}
  	//$somme = $total_lik + $total_counts + $total_shar;
  	//debug($somme);die;
    //echo "Impression: " .$somme. "<br><br>";
    }    
  }
  //$somme = $total_likes + $total_counts + $total_share;
  //debug($somme);die;
  /*for() {
      $total_likes = $total_likes + $total_count + $total_share;
     }*/
  //echo "ENGMNT: " .$engagement. "<br><br>";
	}
}//echo "Nombre de publication: " .$response->data[0]->shares->count. "<br><br>";