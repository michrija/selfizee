<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

class GoogleAnalyticsTrackingComponent extends Component{

    private  $client ;
    private  $analytics ;
    private  $profile ;

   public function __construct() {
      // Creates and returns the Analytics Reporting service object.

      // Use the developers console and download your service account
      // credentials in JSON format. Place them in this directory or
      // change the key file location if necessary.
      $KEY_FILE_LOCATION = ROOT.DS.'config/static-road-228708-1d8cdd3fa463.json';
      //debug($KEY_FILE_LOCATION);die;

      // Create and configure a new client object.
      $this->client = new \Google_Client();
      $this->client->setApplicationName("Hello Analytics Reporting");
      $this->client->setAuthConfig($KEY_FILE_LOCATION);
      $this->client->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);
      $this->analytics = new \Google_Service_Analytics($this->client);
      $this->profile = $this->getFirstProfileId($this->analytics);
    }

     public function getProfile() {
        return $this->profile;
     }
    
    public function getAnalytics() {
        return $this->analytics;
     }

    private function getFirstProfileId($analytics) {
      // Get the user's first view (profile) ID.

      // Get the list of accounts for the authorized user.
      $accounts = $analytics->management_accounts->listManagementAccounts();

      if (count($accounts->getItems()) > 0) {
        $items = $accounts->getItems();
        $firstAccountId = $items[0]->getId();

        // Get the list of properties for the authorized user.
        $properties = $analytics->management_webproperties
            ->listManagementWebproperties($firstAccountId);
            //echo '<pre>';
            //print_r($properties);die;

        if (count($properties->getItems()) > 0) {
          $items = $properties->getItems();
          $firstPropertyId = $items[0]->getId();

          // Get the list of views (profiles) for the authorized user.
          $profiles = $analytics->management_profiles
              ->listManagementProfiles($firstAccountId, $firstPropertyId);
              //echo '<pre>';
            //print_r($profiles);die;


          if (count($profiles->getItems()) > 0) {
            $items = $profiles->getItems();

            // Return the first view (profile) ID.
            return $items[0]->getId();

          } else {
            throw new Exception('No views (profiles) found for this user.');
          }
        } else {
          throw new Exception('No properties found for this user.');
        }
      } else {
        throw new Exception('No accounts found for this user.');
      }
    }
    
    public function getSessionByCountry() { //$analytics = null, $profileId = null

        $session_by_country = array(
        'dimensions' => 'ga:country,ga:countryIsoCode' ,
        'metrics' => 'ga:sessions',
        'sort' => '-ga:sessions',
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $session_by_country)->getRows();
    }

    public function getAllTraficSource() {

        $params = array(
        'dimensions'=> 'ga:source,ga:medium',
        'metrics'=> 'ga:sessions,ga:pageviews', //,ga:sessionDuration,ga:exits
        'sort'=>'-ga:sessions'
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
    }

    public function getBrowserAndOs() {

        $params = array(
        'dimensions'=> 'ga:operatingSystem',/*,ga:operatingSystemVersion,ga:browser,ga:browserVersion*/
        'metrics'=>'ga:sessions'
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
   }

    public function getMobileTrafic() {

        $params = array(
        'dimensions'=> 'ga:source,ga:mobileDeviceInfo',
        'metrics'=>'ga:sessions,ga:pageviews',
        'segment'=> 'gaid::-14'
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
   }

   //===== GALERIES
    public function getPageGaleries() {

        $params = array(
        'dimensions'=> 'ga:pagePath',
        'metrics'=>'ga:pageviews,ga:uniquePageviews,ga:timeOnPage',//,ga:uniquePageviews,ga:bounces,ga:entrances,ga:exits
        'sort'=> '-ga:pageviews',
        'filters' => 'ga:pagePath=~/galeries'
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
    }

    //=== Geographie All Galerie
    public function getPageGaleriesByCountry() { //$analytics = null, $profileId = null

        $session_by_country = array(
        'dimensions' => 'ga:pagePath,ga:country,ga:countryIsoCode,ga:longitude,ga:latitude',
        'metrics' => 'ga:sessions,ga:pageviews',
        'sort' => '-ga:sessions',
        'filters' => 'ga:pagePath=~/galeries'
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $session_by_country)->getRows();
    }

    //=== Geographie Galerie
  
    public function getGaleriesByCountry($galerie = null) { //$analytics = null, $profileId = null

        $session_by_country = array(
        //'dimensions' => 'ga:pagePath,ga:country,ga:countryIsoCode,ga:longitude,ga:latitude',
        //'metrics' => 'ga:sessions,ga:pageviews',
        'dimensions' => 'ga:country,ga:city,ga:latitude,ga:longitude,ga:pagePath',
        'metrics' => 'ga:users,ga:newUsers,ga:sessions,ga:bounces,ga:entrances,ga:pageviews,ga:uniquePageviews,ga:timeOnPage,ga:exits',
        'sort' => '-ga:sessions',
        'filters' => 'ga:pagePath=~/galeries/souvenir/'.$galerie
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $session_by_country)->getRows();
    }


    //===  
    public function getAllDeviceGaleries() {

        $params = array(
        'dimensions'=> 'ga:pagePath,ga:operatingSystem,ga:browser',/*,ga:operatingSystemVersion,ga:browser,ga:browserVersion*/
        'metrics'=>'ga:sessions,ga:pageviews', 
        'filters' => 'ga:pagePath=~/galeries'
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
   }

    //===  OS
    public function getDeviceGaleries($galerie = null) {

        $params = array(
        'dimensions'=> 'ga:pagePath,ga:operatingSystem',/*,ga:operatingSystemVersion,ga:browser,ga:browserVersion*/
        'metrics'=>'ga:users,ga:sessions,ga:pageviews',
        'sort'=> '-ga:pageviews',
        'filters' => 'ga:pagePath=~/galeries/souvenir/'.$galerie
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
   }

   //===  Browser
    public function getNavigateurGaleries($galerie = null) {

        $params = array(
        'dimensions'=> 'ga:pagePath,ga:operatingSystem,ga:browser',/*,ga:operatingSystemVersion,ga:browser,ga:browserVersion*/
        'metrics'=>'ga:users,ga:sessions,ga:pageviews',
        'sort'=> '-ga:pageviews',
        'filters' => 'ga:pagePath=~/galeries/souvenir/'.$galerie
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
   }

   //===  Traffic source galerie
    public function getTrafficSourceGaleries($galerie = null) {

        $params = array(
        'dimensions'=> 'ga:pagePath,ga:source',/*,ga:operatingSystemVersion,ga:browser,ga:browserVersion*/
        'metrics'=>'ga:users,ga:sessions,ga:pageviews',
        'sort'=> '-ga:pageviews',
        'filters' => 'ga:pagePath=~/galeries/souvenir/'.$galerie
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
   }

	//===  EVENEMENTS

    public function getPageEvenements() {

        $params = array(
        'dimensions'=> 'ga:pagePath',
        'metrics'=>'ga:pageviews,ga:uniquePageviews,ga:timeOnPage',//,ga:uniquePageviews
        'sort'=> '-ga:pageviews',
        'filters' => 'ga:pagePath=~/evenements/view/'
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
    }

    //=== Geographie evenement
    public function getPageEvenementsByCountry($idEvenement = null) { //$analytics = null, $profileId = null

        $session_by_country = array(
        'dimensions' => 'ga:pagePath,ga:country,ga:countryIsoCode,ga:longitude,ga:latitude',
        'metrics' => 'ga:sessions,ga:pageviews',
        'sort' => '-ga:sessions',
        'filters' => 'ga:country!=Madagascar;ga:pagePath=~/evenements/view/'.$idEvenement
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $session_by_country)->getRows();
    }

    //===  Device & Browser evenement
    public function getDeviceEvenements($idEvenement = null) {

        $params = array(
        'dimensions'=> 'ga:pagePath,ga:operatingSystem,ga:browser',/*,ga:operatingSystemVersion,ga:browser,ga:browserVersion*/
        'metrics'=>'ga:sessions,ga:pageviews',        
        'filters' => 'ga:pagePath=~/evenements/view/'.$idEvenement
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
   }

   //===  Traffic source evenement
    public function getTrafficSourceEvenements($idEvenement = null) {

        $params = array(
        'dimensions'=> 'ga:source,ga:pagePath',/*,ga:operatingSystemVersion,ga:browser,ga:browserVersion*/
        'metrics'=>'ga:sessions,ga:pageviews',        
        'filters' => 'ga:pagePath=~/evenements/view/'.$idEvenement
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
   }

   //==== Get all Pages souvenirs
    public function getPageGaleriesSouvenir() {

        $params = array(
        'dimensions'=> 'ga:pagePath',
        'metrics'=>'ga:pageviews,ga:uniquePageviews,ga:timeOnPage',//,ga:uniquePageviews,ga:bounces,ga:entrances,ga:exits
        'sort'=> '-ga:pageviews',
        'filters' => 'ga:country!=Madagascar;ga:pagePath=~/galeries/souvenir/' //ga:country!=Madagascar;
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
    }

    //==== Get all canaux
    public function getCanaux() {

        $params = array(
        'dimensions'=> 'ga:source',
        'metrics'=>'ga:users,ga:sessions,ga:pageviews'
        //'filters' => 'ga:country!=Madagascar;ga:pagePath=~/galeries/souvenir/'
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
    }

    //==== Get all OS
    public function getOs() {

        $params = array(
        'dimensions'=> 'ga:operatingSystem',
        'metrics'=>'ga:users,ga:sessions,ga:pageviews',
        'filters' => 'ga:country!=Madagascar;ga:pagePath=~/galeries/souvenir/'
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
    }

    //==== Get all Browser
    public function getBrowser() {

        $params = array(
        'dimensions'=> 'ga:browser',
        'metrics'=>'ga:users,ga:sessions,ga:pageviews',
        'filters' => 'ga:country!=Madagascar;ga:pagePath=~/galeries/souvenir/'
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
    }


    //====  NOUVEAU STAT GA POUR PAGE SOUVENIR

  //=== Geographie
  
    public function getStatGeographique($id_evenement = null) { //$analytics = null, $profileId = null

        $session_by_country = array(
        'dimensions' => 'ga:country,ga:city,ga:latitude,ga:longitude,ga:pageTitle', // a modifier 1er ga:pageTitle
        'metrics' => 'ga:users,ga:newUsers,ga:sessions,ga:bounces,ga:entrances,ga:pageviews,ga:uniquePageviews,ga:timeOnPage,ga:exits',
        'sort' => '-ga:sessions',
        'filters' => 'ga:country!=Madagascar;ga:pageTitle==ID:'.$id_evenement
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-02-20',
           'today',
           'ga:sessions',
            $session_by_country)->getRows();
    }

    //===  Device == OS
    public function getStatDevice($id_evenement = null) {

        $params = array(
        'dimensions'=> 'ga:pageTitle,ga:operatingSystem',/*,ga:operatingSystemVersion,ga:browser,ga:browserVersion*/
        'metrics'=>'ga:users,ga:sessions,ga:pageviews',
        'sort'=> '-ga:pageviews',
        'filters' => 'ga:country!=Madagascar;ga:pageTitle==ID:'.$id_evenement
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-02-20',
           'today',
           'ga:sessions',
            $params)->getRows();
   }

   //===  Browser
    public function getStatNavigateur($id_evenement = null) {

        $params = array(
        'dimensions'=> 'ga:pageTitle,ga:operatingSystem,ga:browser',/*,ga:operatingSystemVersion,ga:browser,ga:browserVersion*/
        'metrics'=>'ga:users,ga:sessions,ga:pageviews',
        'sort'=> '-ga:pageviews',
        'filters' => 'ga:country!=Madagascar;ga:pageTitle==ID:'.$id_evenement
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-02-20',
           'today',
           'ga:sessions',
            $params)->getRows();
   }

   //===  Traffic source galerie
    public function getStatSource($id_evenement = null) {

        $params = array(
        'dimensions'=> 'ga:pageTitle,ga:source',/*,ga:operatingSystemVersion,ga:browser,ga:browserVersion*/
        'metrics'=>'ga:users,ga:sessions,ga:pageviews',
        'sort'=> '-ga:pageviews',
        'filters' => 'ga:country!=Madagascar;ga:pageTitle==ID:'.$id_evenement
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-02-20',
           'today',
           'ga:sessions',
            $params)->getRows();
   }

   //==== Get all canaux
    public function getAllSources() {

        $params = array(
        'dimensions'=> 'ga:source',
        'metrics'=>'ga:users,ga:sessions,ga:pageviews'
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
    }

    //==== Get all OS
    public function getAllOperatingSystems() {

        $params = array(
        'dimensions'=> 'ga:operatingSystem',
        'metrics'=>'ga:users,ga:sessions,ga:pageviews'
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
    }

    //==== Get all Browser
    public function getAllBrowsers() {

        $params = array(
        'dimensions'=> 'ga:browser',
        'metrics'=>'ga:users,ga:sessions,ga:pageviews'
        );

       return $this->analytics->data_ga->get(
           'ga:'.$this->profile,
           '2019-01-14',
           'today',
           'ga:sessions',
            $params)->getRows();
  }
}

?>