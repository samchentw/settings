# Settings
1.setting table  
2.


## Installation
`composer require samchentw/settings`


## Laravel
After updating composer, add the ServiceProvider to the providers array in config/app.php
```sh
Samchentw\Settings\Providers\SettingProvider::class, 
Samchentw\Settings\Providers\SettingEventServiceProvider::class
```

Publish the config file by running: 
```sh
$ php artisan vendor:publish --provider="Samchentw\Settings\Providers\SettingProvider"
```


## Feature
todo...
