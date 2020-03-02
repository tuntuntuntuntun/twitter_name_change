<?php

require_once 'api_keys.php';
require_once 'vendor/autoload.php';

use Abraham\TwitterOAuth\TwitterOAuth;
use Goutte\Client;


$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
$client = new Client();

$names = [];

$crawler = $client->request('GET', 'http://www.myshop.co.jp/japancal/fname/names01.html');
$crawler->filter('#tablelist tr td')->each(function ($node) use (&$names) {
    $names[] = $node->text();
});

foreach ($names as $name) {
    $profile_request = $connection->post("account/update_profile", ["name" => $name]);
    sleep(5);
}

?>