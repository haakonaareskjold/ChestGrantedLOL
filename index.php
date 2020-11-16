<?php

use GuzzleHttp\Client;

require_once __DIR__. '/bootstrap.php';
require_once __DIR__. '/index.views.php';

# fetches ddragon json with newest patch
$champions = "http://ddragon.leagueoflegends.com/cdn/" . getenv('PATCH') . "/data/en_US/champion.json";
$ddragon = new Client();
$resDdragon = $ddragon->get($champions);
$ddragon_json = $resDdragon->getBody();
$content = json_decode($ddragon_json, true);

# fetches champion-mastery V4 API
$url = "https://" . $_ENV['SERVER'] . ".api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/" . $_ENV['SID'] . "?api_key=" . $_ENV['APIKEY'];
$client = new Client();
$res = $client->get($url);

$json = $res->getBody();
$list = json_decode($json, true);
$championId = array_column($list, 'championId');
$grantedChest = array_column($list, 'ChestGranted');

function search($array, $key, $value)
{
    $results = array();

    if (is_array($array)) {
        if (isset($array[$key]) && $array[$key] == $value) {
            $results[] = $array;
        }

        foreach ($array as $subarray) {
            $results = array_merge($results, search($subarray, $key, $value));
        }
    }

    return $results;
}


$available = (search($list, 'chestGranted', false));
$amount =  count($available);

# Fetches champion image according to current patch
$img = "https://ddragon.leagueoflegends.com/cdn/" . getenv('PATCH') . "/img/champion/";

# Displays integers of all champions that has chest available
foreach ($content['data'] as $data) {
    foreach ($available as $item) {
        if($data['key'] == $item['championId']) {
            $championImg = $img . $data['id'] . ".png";
            print_r("<img alt='{$data['name']}' src={$championImg}></a>");
        }
    }
}
