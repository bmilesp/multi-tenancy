<?php 
App::uses('AppModel', 'Model');
class Tenant extends AppModel {


	public function domainExists($domain){
		if($this->findByDomain($domain)){
			return $domain;
		}
		return false;
	}
	
}