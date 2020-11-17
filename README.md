# ChestGrantedLOL

This is just a small web API that displays what champions you have chest available on \
It only requires a RGAPI (Riot Games API Key) to run. The app has a form where you fill in your league username 
and pick your designated server. Then it will fetch what champions you are eligible 
to get a chest from.


### Known bugs/issues
*  There is no key-value pair in any of the RIOT APIs that indicates if you own a champion \
   or not, the champion-mastery-v4 API has key-value pairs for last time you played \
   a champion, amount of points, champ level and champ ID among others. \
   So the problem here is that my API can't really know if you own that champion or not. \
   It just assumed you own the champion as long as you have XP on it. If you have never played \
   The champion, it won't show up in the API in, despite owning it.
   
**TLDR:If you do not own a champion, but has XP on it- it will show up as Riot Games' API has no indicator for if you own a champion or not,
the API just assumes you do if you have XP on it. The only way this API can show 100% correct is IF you own all champions, 
and have at least played them once**
   

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
