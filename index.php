<?php

use GuzzleHttp\Client;

require_once __DIR__. '/bootstrap.php';
require_once __DIR__. '/vendor/autoload.php';

# fetches ddragon json with newest patch
$champions = "http://ddragon.leagueoflegends.com/cdn/" . getenv('PATCH') . "/data/en_US/champion.json";
$ddragon = new Client();
$resDdragon = $ddragon->get($champions);
$ddragon_json = $resDdragon->getBody();
$content = json_decode($ddragon_json, true);

# fetches champion-mastery V4 API
$url = "https://na1.api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/" . $_ENV['SID'] . "?api_key=" . $_ENV['APIKEY'];
$client = new Client();
$res = $client->get($url);

$json = $res->getBody();
$list = json_decode($json, true);
$championId = array_column($list, 'championId');


    foreach ($content['data'] as $data) {
        foreach ($championId as $value) {
            if($data['key'] == $value) {
                echo $data['name'] . PHP_EOL;
            }
        }
    }


