#Setup
- clone repository (username and password for metronic submodule is: armin.alagic@gmail.com Armin-098)
- cp .env.example .env
- set env variables (don't use config:cache during development, to avoid being forced to clear config
cache each time you change env var)
- composer install
- php artisan key:generate
- php artisan:migrate
- php artisan db:seed
- compile and place metronic (only when first deployng or changin default metronic config, otherwise skip)
    - cp -iR resources/metronic Metronic (confirm overwrites)
    - cd Metronic/theme/default/demo4/tools
    - npm install
    - nmp run build
    - mkdir -p ../../../../../public/dist/metronic
    - \cp -R ../dist/* ../../../../../public/dist/metronic/
    - cd ../../../../..

- npm install
- npm run dev / watch / prod

#Changelog
- switch to username validation for auth
- separate user profiles from users table
- define basic ranks

#TODO
- Users list for User (referred users, use same view)
- Coming soon tooltip for inactive links
- All Emails through omnitask/email package (incl. Register)
- News module (all files through spatie/laravel-medialibrary package)
