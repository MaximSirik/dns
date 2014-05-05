<?php

include "DNServer.php";

$ips['www.google.com']['A'] = "192.168.0.1";
$ips['www.yahoo.com']['A'] = "192.168.0.1";
$ips['www.google.com']['MX'] = "192.168.2.1";

function dnshandler($dominio,$tipo)
{
    global $ips;
	if ( isset($ips[$dominio][$tipo]) )
		return $ips[$dominio][$tipo];
	else
    	return "127.0.0.1";
}

$dns = new DNServer("dnshandler", "127.0.0.1");