
Start 'er up from cold (from console container):
```
./artisan migrate
./artisan key:generate
./artisan config:cache
```

Seed the DB (from console container):
```
./artisan db:seed --class=DatabaseSeeder
```
