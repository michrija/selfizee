<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
use Cake\Core\Configure;

/**
 * The default class to use for all routes
 *
 * The following route classes are supplied with CakePHP and are appropriate
 * to set as the default:
 *
 * - Route
 * - InflectedRoute
 * - DashedRoute
 *
 * If no call is made to `Router::defaultRouteClass()`, the class used is
 * `Route` (`Cake\Routing\Route\Route`)
 *
 * Note that `Route` does not do any inflections on URLs which will result in
 * inconsistently cased URLs when used with `:plugin`, `:controller` and
 * `:action` markers.
 *
 * Cache: Routes are cached to improve performance, check the RoutingMiddleware
 * constructor in your `src/Application.php` file to change this behavior.
 *
 */
Router::defaultRouteClass(DashedRoute::class);

/*Router::addUrlFilter(function ($params, $request) {
    if ($request->getParam('lang') && !isset($params['lang'])) {
        $params['lang'] = $request->getParam('lang');
    }
    return $params;
});*/

/* Router::scope('/', function (RouteBuilder $routes) {
  
}); */

Router::scope('/api', ['_namePrefix' => 'api:'], function ($routes) {
    //
    $routes->post('/connexion', ['controller' => 'Users','action'=>'connexion'], 'connexion');
    $routes->get('/galerie/*', ['controller' => 'Galeries','action'=>'getGalerie'], 'galerie');
    $routes->get('/contacts/*', ['controller' => 'Contacts','action'=>'getContacts'], 'contacts');
});


Router::scope('/', function (RouteBuilder $routes) {
    /**
     * Here, we are connecting '/' (base path) to a controller called 'Pages',
     * its action called 'display', and we pass a param to select the view file
     * to use (in this case, src/Template/Pages/home.ctp)...
     */
    /*$routes->connect('/', ['controller' => 'Users', 'action' => 'login', 1]);
    
    $routes->connect('/:lang/admin', ['controller' => 'Users', 'action' => 'login']);
    
    $routes->connect('/:lang/logout', ['controller' => 'Users', 'action' => 'logout'],['_name' => 'logout']);
    
    $routes->connect('/:lang/p/*', ['controller' => 'Photos', 'action' => 'show']);

    /**
     * ...and connect the rest of 'Pages' controller's URLs.
     *
    $routes->connect('/:lang/pages/*', ['controller' => 'Pages', 'action' => 'display']);*/
    // $routes->extensions(['pdf']);
    $routes->setExtensions(['pdf', 'json', 'csv']);
	
	$routes->connect(
		'/evenements/statistique/:id_evenement/*', 
		['controller' => 'Evenements', 'action' => 'statistique'],
		['id_evenement' => '\d+', 'pass' => ['id_evenement']]
	);
    // $routes->connect(
    //                     '/', 
    //                     ['controller' => 'Users', 'action' => 'login', 1]
    //                 )
                    // ->setHost(Configure::read('front_domaine'))
                    ;

	/*$routes->connect(
                        '/', 
                        ['controller' => 'Rgpd', 'action' => 'inscription']
                    )
                    ->setHost(Configure::read('rgpd_domaine'));*/
                    
    //$routes->connect('/:lang/p/*', ['controller' => 'Photos', 'action' => 'show']);
                    //->setHost(Configure::read('front_domaine'));
                    
    $routes->connect('/p/*', ['controller' => 'Photos', 'action' => 'show']);
                    //->setHost(Configure::read('front_domaine'));
     $routes->connect('/t/*', ['controller' => 'Photos', 'action' => 'testPageSouvenir']);
    
	$routes->connect('/e/inf/:email_tp',
		['controller' => 'Rgpd', 'action' => 'informations']
	)
		->setPass(['email_tp'])
		->setPatterns([
			'email_tp' => '[a-zA-Z0-9\+\=\-\_]+'
		]);
	$routes->connect('/e/inf/suppression/cont-em',
		['controller' => 'Rgpd', 'action' => 'suppression']
	);
	
	$routes->connect('/liste/photos/:idEvenement',
		['controller' => 'Photos', 'action' => 'listing'],
		['idEvenement' => '\d+', 'pass' => ['idEvenement']]
	);
	$routes->connect('/statistique/resume/:idEvenement',
		['controller' => 'Evenements', 'action' => 'statResume'],
		['idEvenement' => '\d+', 'pass' => ['idEvenement']]
	);
	$routes->connect('/statistique/global/:idEvenement',
		['controller' => 'Evenements', 'action' => 'statGlobal'],
		['idEvenement' => '\d+', 'pass' => ['idEvenement']]
	);
	$routes->connect('/e/download/:parametre',
		['controller' => 'Photos', 'action' => 'downloadByEvenementZip']
	)
		->setPass(['parametre'])
		->setPatterns(['parametre' => '[a-zA-Z0-9\+\=\-\_]+']);
		
	$routes->connect('/e/f/download/:parametre',
		['controller' => 'Galeries', 'action' => 'downloadLienEncrypte']
	)
		->setPass(['parametre'])
		->setPatterns(['parametre' => '[a-zA-Z0-9\+\=\-\_]+'])
		->setHost(Configure::read('front_domaine'));
	


    // ancien dommaine
    $routes->connect(
        '/', 
        ['controller' => 'Users', 'action' => 'login', 1] // event
    )
    ->setHost(Configure::read('front_domaine')) // event.selfizee.fr
    ;

    $routes->connect(
        '/', 
        ['controller' => 'Users', 'action' => 'login']
    )
    ->setHost(Configure::read('admin_domaine')) // manager.selfizee.fr
    ;

    // Dynamique
    $routes->connect(
        '/', 
        ['controller' => 'Users', 'action' => 'login', 1] // event
    )
    // ->setHost(Configure::read('front_domaine'))
    ;

    $routes->connect(
        '/galerie', 
        ['controller' => 'Users', 'action' => 'login', 1]
    )
    // ->setHost(Configure::read('front_domaine'))
    ;
    $routes->connect(
        '/connexion', 
        ['controller' => 'Users', 'action' => 'login']
    )
    // ->setHost(Configure::read('admin_domaine'))
    ;

    //test id = 1641
    $routes->connect(
                        '/', 
                        ['controller' => 'Users', 'action' => 'login',0,1641]
                    )
                    ->setHost('carmila-part.selfizee.mg');
    
    $routes->connect('/logout', ['controller' => 'Users', 'action' => 'logout'],['_name' => 'logout']);
    

    $routes->connect('charte-de-conformite-au-rgpd',
        ['controller' => 'Rgpd', 'action' => 'charteRgdp']
    );
	$routes->connect('charte-de-conformite-au-rgpd/moyen-mis-en-place',
        ['controller' => 'Rgpd', 'action' => 'charteRgdpMoyen']
    );

	$routes->connect('politique-de-traitement-des-donnees',
        ['controller' => 'Rgpd', 'action' => 'politique']
    );
	
    $routes->connect('/politique-de-traitement-des-donnees/:event_detail',
        ['controller' => 'Rgpd', 'action' => 'politique']
    )
		->setPass(['event_detail'])
		->setPatterns([
			'event_detail' => '[a-zA-Z0-9\+\=\-\_]+'
		]);

    $routes->connect('politique-relative-a-utilisation-des-cookies',
        ['controller' => 'Rgpd', 'action' => 'politiqueDeCookies']
    );

    $routes->connect('gestion-des-donnees',
        ['controller' => 'Rgpd', 'action' => 'gestionDesDonnees']
    );


    //== Route slug
    $routes->connect(':id_event/:slug',
        ['controller' => 'Galeries', 'action' => 'post'],
        ['slug' => '[a-zA-Z0-9_-]+', 'id_event' => '[0-9]+']
    );

    /**
     * Connect catchall routes for all controllers.
     *
     * Using the argument `DashedRoute`, the `fallbacks` method is a shortcut for
     *    `$routes->connect('/:controller', ['action' => 'index'], ['routeClass' => 'DashedRoute']);`
     *    `$routes->connect('/:controller/:action/*', [], ['routeClass' => 'DashedRoute']);`
     *
     * Any route class can be used with this method, such as:
     * - DashedRoute
     * - InflectedRoute
     * - Route
     * - Or your own route class
     *
     * You can remove these routes once you've connected the
     * routes you want in your application.
     */
    $routes->fallbacks(DashedRoute::class);
});

/**
 * Load all plugin routes. See the Plugin documentation on
 * how to customize the loading of plugin routes.
 */
Plugin::routes();
