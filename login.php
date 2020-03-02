<?php

require_once 'autoload.php';
require_once 'api_keys.php';

use Abraham\TwitterOAuth\TwitterOAuth;

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

$request_token = $connection->oauth('oauth/request_token', ['oauth_callback' => 'https://google.com/callback.php']);

$_SESSION['request_oauth_token'] = $request_token['oauth_token'];
$_SESSION['request_oauth_token_secret'] = $request_token['oauth_token_secret'];

$url = $connection->url('oauth/authenticate', ['oauth_token' => $request_token['oauth_token']]);

header('Location: '. $url);