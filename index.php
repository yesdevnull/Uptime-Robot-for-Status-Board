<?php

require 'vendor/autoload.php';

Dotenv::load(__DIR__);
$uptimeRobotApiKey = getenv('UR_API_KEY');

use GuzzleHttp\Client;

$client = new Client();