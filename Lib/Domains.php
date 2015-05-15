<?php class Domains {
	

	public static function getSubDomain(){
		$sub_domain_present = strpos(env('HTTP_HOST'), '.');
		if(!$sub_domain_present){
			return null;
		}
		$subdomain = explode('.', env('HTTP_HOST'));

        $subdomain = $subdomain[0];

        return $subdomain;
	}
}