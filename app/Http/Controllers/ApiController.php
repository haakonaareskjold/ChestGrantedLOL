<?php

namespace App\Http\Controllers;

use Dotenv\Dotenv;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ServerException;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function create()
    {
        return view ('create');
    }

    public function store(Request $request)
    {
        $dotenv = Dotenv::createMutable(base_path());
        $dotenv->load();
        $dotenv->required(['PATCH', 'SID', 'RGAPI']);

        # phpdotenv script to fetch DDragon json to update to newest version automatically
        $fetch = new Client();
        try {
            $response = $fetch->request(
                'GET',
                'http://ddragon.leagueoflegends.com/api/versions.json'
            );
        } catch (ClientException | ServerException $e) {
            $error = $e->getResponse()->getStatusCode();

            if ($error !== 200) {
                die('an error has occurred, please try again later');
            }
        }

        $json = $response->getBody();
        $array = json_decode($json, true);
        $version = $array[0];
        putenv("PATCH={$version}");

        # validation of form
        ($this->validateForm($request));

        # form handling
        $username = $_POST['username'];
        $server = $_POST['server'];

        # Fetches SID from  Summoner-V4 API and writes it to .env file
        $account = "https://". $server . ".api.riotgames.com/lol/summoner/v4/summoners/by-name/". $username . "?api_key=" . $_ENV['RGAPI'];

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
        $name = $content['name'];
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
        $url = "https://" . $server . ".api.riotgames.com/lol/champion-mastery/v4/champion-masteries/by-summoner/" . getenv('SID') . "?api_key=" . $_ENV['RGAPI'];
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

        function search($array, $key, $value): array
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

        # Fetches champion image according to current patch
        $img = "https://ddragon.leagueoflegends.com/cdn/" . getenv('PATCH') . "/img/champion/";

        return view('index', compact('content', 'available', 'img', 'name'));
    }

    public function index()
    {
        return view('index');
    }

    public function validateForm(Request $request): array
    {
        return $request->validate([
            'username' => 'required|min:3|max:16',
            'server' => 'required',
        ]);
    }
}