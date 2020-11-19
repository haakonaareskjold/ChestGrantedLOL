# ChestGrantedLOL

A simple Laravel App that displays what champions you have chest available on left this season.
It only requires a RGAPI (Riot Games API Key) to run. The app has a form where you fill in your league username
and pick your designated server. Then it will fetch the required information by using Riot's Summoners-V4 API,
Champion-Mastery-V4 API and Data Dragon API.


### How to run
1. `cp .env.example .env` and fill in your RGAPI key in the .env file
2. use `docker-compose up -d` to create/run the containers
3. generate a laravel app key with `docker exec api php artisan key:generate`
4. check `http://localhost:8000` in your browser to use the app

### Requirements
* Docker
* Docker-compose


### UI overhaul
I had intended to keep this project very minimalistic, and by that I mean no framework,
I figured out eventually I needed to do an overhaul as templating became necessary. Overall I am very
pleased with the result on how the UI turned out, despite it not being in the main focus of the project.

### Known bugs/issues
*  There is no key-value pair in any of the RIOT APIs that indicates if you own a champion
   or not, the champion-mastery-v4 API has key-value pairs for last time you played
   a champion, amount of points, champ level and champ ID among others.
   So the problem here is that my API can't really know if you own that champion or not.
   It just assumed you own the champion as long as you have XP on it. If you have never played
   The champion, it won't show up in the API in, despite owning it.

**TLDR:If you do not own a champion, but has XP on it- it will show up as Riot Games' API
has no indicator for if you own a champion or not,
the API just assumes you do if you have XP on it. The only way this API can show 100% correct is
IF you own all champions,
and have at least played them once**

Only bug that has occurred during development in Docker is that the Laravel App doesn't recognize the ENV APP_KEY,
despite actually existing, if you happen to get a stacktrace displaying symfony errors try to use \
`docker exec api php artisan config:clear` then do a full-refresh of browser

