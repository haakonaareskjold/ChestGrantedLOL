<?php

use Dotenv\Dotenv;
use GuzzleHttp\Client;

require_once __DIR__. '/vendor/autoload.php';

# phpdotenv
$dotenv = Dotenv::createMutable(__DIR__);
$dotenv->load();
$dotenv->required(['PATCH', 'SID', 'APIKEY']);

# phpdotenv script to fetch DDragon json to update to newest version automatically
$fetch = new Client();
$response = $fetch->request(
    'GET',
    'http://ddragon.leagueoflegends.com/api/versions.json'
);
$json = $response->getBody();
$array = json_decode($json, true);
$version = $array[0];
putenv("PATCH={$version}");
