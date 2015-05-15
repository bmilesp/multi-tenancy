<?php 

Configure::write('Domain.Master', 'u');
Configure::write('Domain.DefaultRoute', array('plugin' => 'multi_tenancy', 'controller' => 'sites', 'action' => 'add'));

?>