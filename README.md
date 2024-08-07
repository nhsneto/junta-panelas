# Junta-Panelas App

## About
WEB app that helps people to plan their junta-panelas parties (those parties  
that each guest bring a food/drink). In this app, the user can register junta-panelas  
planning, which date the party will be, the hour it will begin, its participants, and  
what they will bring. The user also can generate a pdf document of a junta-panelas  
planning containing a list of its participants and what they will bring to the party.

## App's Screenshots
- [Mobile](https://drive.google.com/drive/folders/1-jq7UF-ZtDCdiH4yjYX8IwsMHVTzt3xE?usp=sharing)
- [Desktop](https://drive.google.com/drive/folders/1HJzUkAt0u6D27X_GyIa3ADWcir_dS-rW?usp=sharing)

## Supported Languages
The app supports two languages depending on the app's locale setting (server side):
- English (Default)
- Portuguese

## Databases
- Mongodb for user, junta-panelas and participant models
  - Participant document is embedded into junta-panelas document
- SQLite for sessions and cache

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
