<?php
# starts session
session_start();
if (empty($_SESSION['token'])) {
    $_SESSION['token'] = bin2hex(random_bytes(32));
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Chest available</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <style>
        .container {
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: space-around;
            list-style: none;
            margin-top: 1rem;
        }
    </style>
</head>
<body style="background-color: #333; color: aqua">
<div class="container">
<?php

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\ServerException;

require_once __DIR__. '/bootstrap.php';


# Information from form
$username =  $server = "";
if (isset($_POST['submit']) && ($_SESSION['token'] == $_POST['token'])) {
    $username = $_POST['username'];
    $server = $_POST['server'];
} elseif (isset($_POST['submit']) && ($_SESSION['token'] !== $_POST['token'])) {
    die('wrong CSRF token');
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
# Fetches SID from  Summoner-V4 API and writes it to .env file
$account = "https://". $server . ".api.riotgames.com/lol/summoner/v4/summoners/by-name/". $username . "?api_key=" . $_ENV['APIKEY'];
$summoner = new Client();
    try {
        $json = $summoner->request('GET', $account);
    } catch (ClientException | ServerException $e) {
        $error = $e->getResponse()->getStatusCode();

        if ($error !== 200) {
            die('an error has occurred, please try again later');
        }
    }
    $body = $json->getBody();
$content = json_decode($body, true);
$summonerID = $content['id'];
putenv("SID={$summonerID}");


# fetches ddragon json with newest patch
    $champions = "http://ddragon.leagueoflegends.com/cdn/" . getenv('PATCH') . "/data/en_US/champion.json";
    $ddragon = new Client();

    try {
        $resDdragon = $ddragon->get($champions);
    } catch (ClientException | ServerException $e) {
        $error = $e->getResponse()->getStatusCode();

        if ($error !== 200) {
            die('an error has occurred, please try again later');
        }
    }
    $ddragon_json = $resDdragon->getBody();
    $content = json_decode($ddragon_json, true);

# fetches champion-mastery V4 API
    $url = "https://" . $server . ".api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/" . getenv('SID') . "?api_key=" . $_ENV['APIKEY'];
    $client = new Client();
    try {
        $res = $client->get($url);
    } catch (ClientException | ServerException $e) {
        $error = $e->getResponse()->getStatusCode();

        if ($error !== 200) {
            die('an error has occurred, please try again later');
        }
    }

    $json = $res->getBody();
    $list = json_decode($json, true);

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
    $amount = count($available);

# Fetches champion image according to current patch
    $img = "https://ddragon.leagueoflegends.com/cdn/" . getenv('PATCH') . "/img/champion/";

# Displays integers of all champions that has chest available
    foreach ($content['data'] as $data) {
        foreach ($available as $item) {
            if ($data['key'] == $item['championId']) {
                $championImg = $img . $data['id'] . ".png"; ?>
                <div class="item2">
                <?php
                print_r("<img alt='{$data['name']}' src={$championImg}></a>");
                ?></div><?php
            }
        }
    }
}
?>
    <div class="one mt-4">
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <input type="text" class="form-control" name="username" autofocus required placeholder="username">
            <input type="radio" name="server" value="euw1" checked=""checked">EUW
            <input type="radio" name="server" value="na1">NA
            <input type="hidden" name="token" value="<?=$_SESSION['token']; ?>">
            <button type="submit" value="submit" name="submit"  class="btn btn-xl btn-primary mt-2">Submit</button>
        </form>
    </div>
</div>
</body>
</html>