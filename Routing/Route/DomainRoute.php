<?php
App::uses('CakeRoute', 'Routing/Route');
App::uses('CakeResponse', 'Network');
App::uses('Tenant', 'MultiTenancy.Model');
App::uses('Domains', 'MultiTenancy.Lib');

/**
 * Domain Route class will ensure a domain has been setup before allowing
 * users to continue on routes for that domain. Instead, it redirects them
 * to a default route if the domain name is not in the system, allowing
 * creation of accounts, or whatever.
 *
 * @package default
 * @author Graham Weldon (http://grahamweldon.com)
 */
class DomainRoute extends CakeRoute {

/**
 * A CakeResponse object
 *
 * @var CakeResponse
 */
    public $response = null;

/**
 * Flag for disabling exit() when this route parses a url.
 *
 * @var boolean
 */
    public $stop = true;

/**
 * Parses a string url into an array. Parsed urls will result in an automatic
 * redirection
 *
 * @param string $url The url to parse
 * @return boolean False on failure
 */
    public function parse($url) {
       $params = parent::parse($url);
      
        
        if ($params === false) {
            return false;
        }
        $Domains = New Domains();
        $subdomain = $Domains->getSubdomain();
    
        $masterDomain = Configure::read('Domain.Master');
        
        $defaultRoute = Configure::read('Domain.DefaultRoute');
        $Tenant = new Tenant();

        if (!($Tenant->domainExists($subdomain)) && $params != $defaultRoute) {

            if (!$this->response) {
                $this->response = new CakeResponse();
            }
            debug($this->response);die;
            $status = 307;
            $redirect = $defaultRoute;
            $this->response->header(array('Location' => Router::url($redirect, true)));
            $this->response->statusCode($status);
            $this->response->send();
            $this->_stop();
        }

        return $subdomain;
    }

/**
 * Stop execution of the current script.  Wraps exit() making
 * testing easier.
 *
 * @param integer|string $status see http://php.net/exit for values
 * @return void
 */ 
    protected function _stop($code = 0) {
        if ($this->stop) {
            exit($code);
        }
    }

}