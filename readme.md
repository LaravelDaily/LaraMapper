# LaraMapper: Laravel 5.5 demo-project to show shops on the map and manage them via admin panel.

It is a demo project for demonstrating what can be generated with [QuickAdminPanel](https://quickadminpanel.com) tool.

![Laramapper screenshot](http://webcoderpro.com/laramapper-front.png)

![Laramapper backend](http://webcoderpro.com/laramapper-back.png)

## How to use

- Clone the repository with __git clone__
- Copy __.env.example__ file to __.env__ and edit database credentials there
- Fill in __.env__ value for __GOOGLE_MAPS_API_KEY__ - [see here](https://developers.google.com/maps/documentation/javascript/get-api-key) how to get one 
- Run __composer install__
- Run __php artisan key:generate__
- Run __php artisan migrate --seed__ (it has some seeded data for your testing)
- That's it: launch the main URL - you will see the New York map with 10 shops 
- Go to URL `/login` and you will see admin panel, with default credentials __admin@admin.com__ - __password__

## License

Basically, feel free to use and re-use any way you want.
