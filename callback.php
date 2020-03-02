<?php

require_once 'autoload.php';
require_once 'api_keys.php';

use Abraham\TwitterOAuth\TwitterOAuth;

$request_token = [];
$request_token['oauth_token'] = $_SESSION['oauth_token'];
$request_token['oauth_token_secret'] = $_SESSION['oauth_token_secret'];

if (empty($_REQUEST['oauth_token']) || $request_token['oauth_token'] !== $_REQUEST['oauth_token']) {
    die('Error');
}

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, $request_token['oauth_token'], $request_token['oauth_token_secret']);

$access_token = $connection->oauth('oauth/access_token', ['oauth_verifier' => $_REQUEST['oauth_verifier']]);

header('Location: index.php');