<?php
App::uses('DomainRoute', 'MultiTenancy.Routing/Route');
if (env('HTTP_HOST') === Configure::read('Domain.Master')) {
    // Master domain shows the home page.
    $rootRoute = array('controller' => 'pages', 'action' => 'display', 'home');
} else {
    // Subdomains show  the view page.
    $rootRoute = array('controller' => 'tenants', 'action' => 'view', env('HTTP_HOST'));
}

Router::connect(
	'/',
	$rootRoute, 
	array('routeClass' => 'DomainRoute')
);