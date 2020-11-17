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
   The champion, but have chest available the API won't recognise it.
   
**TLDR:If you have all champions/played them at least once in your life, it will show 100% correct, \
in other words, my API might show incorrect if you have never played a champion you own, \
also not-owned will show**
   

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