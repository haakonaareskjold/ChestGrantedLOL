# ChestGrantedLOL

This is just a small web API that displays what champions you have chest available on \
It only requires a RGAPI (Riot Games API Key) to run. The app has a form where you fill in your league username 
and pick your designated server. Then it will fetch what champions you are eligible 
to get a chest from.


### How to run
1. `cp .env.example .env` and fill in your credentials in the .env file
2. run `docker-compose up -d` and go to  `localhost:8080` in your browser

### Requirements
* Docker-compose
* If not using docker-compose
    * ~~PHP^7.4~~ 
    * ~~Composer with the following dependencies:~~
        * ~~Guzzle~~
        * ~~phpdotenv~~
        * ~~ext-json~~
    
### UI
The UI is low-effort, feel free to improve it by forking the project. \
I didn't bother using templating as I intended the project to be minimalistic.