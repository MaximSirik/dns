<?php

include __DIR__. "/DNServer.php";

$ips['www.google.com']['A'] = "192.168.0.1";
$ips['www.yahoo.com']['A'] = "192.168.0.1";
$ips['www.google.com']['MX'] = "192.168.2.1";

error_reporting(-1);

function dnshandler($domain,$type)
{
    global $ips;

    if (!empty($ips[$domain][$type])) {
        return $ips[$domain][$type];
    }

    // TODO pass proper contant instead of hardcoded DNS_A
    // TODO cach requested record for some time (should be configured)
    $dns_records = dns_get_record($domain, DNS_A);
    if (empty($dns_records)) {
        return "127.0.0.1";
    }
    return current($dns_records)["ip"];
}

$dns = new DNServer("dnshandler", "127.0.0.1");
$dns->listen();