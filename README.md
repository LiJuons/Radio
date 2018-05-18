# Internet Radio

## "Internet Radio" paleidimo instrukcija:


###  5.1. Reikalinga programinė įranga 

    • Composer + Laravel (https://laravel.com/docs/5.6/installation)
    • Node + npm + Angular (https://nodejs.org/en/download/,https://cli.angular.io)
    • IceCast (http://icecast.org/download)
    • SQL duombazė (MariaDB, Postgre ar pan.) (https://dev.mysql.com/downloads/installer)
    • Pasirinkta garso transalvimo programa(MIXXX (https://www.mixxx.org), SAMCast ar pan.)
    • PostMan (Neprivaloma, https://www.getpostman.com/apps)

###  5.2. Programos konfiguracija

  1. Duomenų bazės sukūrimas
  
    (a) Sukurti duomenų bazę pavadinimų "Radio"

  2. Susikonfiguruoti.env
  
    (a) Eiti į katalogą '_Radio/api/_' 
    (b) Pervadinti failą '_.env.example_' į '_.env_' 
    (c) .env faile pakeisti šią eilutę: _DB_DATABASE=Radio_
    (d) Pagal lokalios duomenų bazės konfigūraciją atitinkamai pakeisti šias eilutes: 
    
        i.    _DB_HOST_
        ii.   _DB_PORT_ 
        iii.  _DB_USERNAME_ 
        iv.   _DB_PASSWORD_


  3. Paleisti duomenų bazės migraciją

    (a) Atsidaryti komandinę eilutę 
    (b) Eiti į katalogą 'Radio/api/'
    (c) Įvesti komandą 'php artisan migrate:fresh'


  4. Susigeneruoti lokalų API raktą

    (a) Atsidaryti komandinę eilutę 
    (b) Eiti į katalogą 'Radio/api/' 
    (c) Įvesti komandą 'php artisan passport:install'
    (d) Įvesti komandą 'php artisan passport:client –personal'


  5. Įrašyti Angular modulius

    (a) Atsidaryti komandinę eilutę 
    (b) Eiti į katalogą 'Radio/api/'
    (c) Įvesti komandą 'npm install'


  6. Paleidimas

    (a) Paleisti IceCast naudojant pridėtą IceCast.xml konfigūraciją 
    (b) Atsidaryti komandinę eilutę 
    (c) Eiti į katalogą 'Radio/api/'
    (d) Įvesti komandą 'php artisan serve' 
    (e) Atsidaryti naują komandinę eilutę 
    (f) Eiti į katalogą 'Radio/radio/' 
    (g) Įvesti komandą 'ng serve'


  7. Transliacijos paleidimas

    (a) Atsidaryti pasirinkitą transliavimo programą (MIXX, SAMCast ar pan.) 
    (b) Paleisti transliaciją pagal šiuos duomenis: 
        • Login: Užregistruoto vartotojo prisijungimo vardas 
        • Mount: Užregistruoto vartotojo prisijungimo vardas 
        • Port: 8020 
        • Password: Prisijungus prie sistemos, profilio sekcijoje sugeneruotas transliacijos raktas 
        • Host: localhost arba 127.0.0.1 
        • Type: IceCast2
