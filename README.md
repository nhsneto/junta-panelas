# Junta-Panelas App

## About

WEB app that helps people to plan their junta-panelas parties (those parties  
that each guest bring a food/drink). In this app, the user can register junta-panelas  
planning, which date the party will be, the hour it will begin, its participants, and  
what they will bring.

## App's Screenshots
- [Mobile](https://github.com/nhsneto/junta-panelas/tree/main/screenshots/mobile)
- [Desktop](https://github.com/nhsneto/junta-panelas/tree/main/screenshots/desktop)

## Supported Languages

The app supports two languages depending on the app's locale setting (server side):
- English (Default)
- Portuguese

## Databases
- Mongodb for users, junta-panelas, and participant models.
  - Participant document is embedded into junta-panelas document. 
- SQLite for sessions and cache.

## App Built with:

- SQLite
- Mongodb 7.0
- PHP 8.2
- Laravel 11
- Pest
- laravel-mongodb (Eloquent ORM library to work with mongodb)
- Blade
- JavaScript
- Node.js
- Vite
- JQuery 3.7
- HTML5
- CSS3
- Tailwindcss
- Daisyui (Tailwindcss library)
- Heroicons
