<?php

ini_set("soap.wsdl_cache_enabled", "0"); // disabling WSDL cache

// //¿Í»§¶Ë
$parameter=array(
    'uri'=>'http://localhost/',
	'location'=>'http://localhost/lmm/service_soap.php',
);

try{
    $soapClient=new SoapClient(null,$parameter);
	var_dump($soapClient);
	
	print_r($soapClient->__getFunctions());

    // echo $soapClient->test();
    echo $soapClient->get_title();


}catch(Exception $e){
    echo $e->getMessage();
}



