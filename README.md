# Settings
1.Can store system configuration data  
2.Can store other table data, such as: user settings, store settings, etc.  


## Installation
`composer require samchentw/settings`


## Laravel
Publish the config file by running: 
```sh
$ php artisan vendor:publish --provider="Samchentw\Settings\SettingServiceProvider"
```
Create the database table required for this package.
```sh
$ php artisan migrate
```
Run seed, If you want to modify the seed information, please go to data/settings.json
```sh
$ php artisan db:seed --class=SettingsSeeder
```

## Settings.json and Model attribute
```json
{
    "display_name": "範例全域參數-數字", //顯示名稱
    "type": "number", // 'string', 'password', 'text', 'number', 'boolean', 'html', 'date', 'date_time','json'
    "sort": 1, //在群組中的排序
    "key": "example.category_limite", //搜尋時需要用到的key值
    "value": "4",   //此kye值的資料
    "provider_key": 0, //如果provider_name為全域變數名稱，值就為0，此欄位可存UserId或其他表Id
    "provider_name": "G"  //全域變數名稱，預設為G，如需更改請到config/setting.php修改
}
```

## Usage

Simple example

```php
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Samchentw\Settings\Contracts\SettingManager;

    class SettingController extends Controller
    {
        private $settingManager;
        public function __construct(SettingManager $SettingManager)
        {
            $this->settingManager = $SettingManager;
        }


        function getSettings(Request $request)
        {
            return $this->settingRepository->getByKey('example.title');
        }
    }
```

output:
```json
   {
        "display_name": "範例全域參數-標題",
        "type": "string",
        "sort": 1,
        "key": "example.title",
        "value": "後台系統",
        "provider_key": 0,
        "provider_name": "G"
    }
```

If type is boolean

```php
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Samchentw\Settings\Contracts\SettingManager;

    class SettingController extends Controller
    {
        private $settingManager;
        public function __construct(SettingManager $SettingManager)
        {
            $this->settingManager = $SettingManager;
        }


        function getSettings(Request $request)
        {
            return $this->settingManager->getByKey('test.boolean');
        }
    }
```

output:
```json
   {
        "display_name": "測試boolean",
        "type": "boolean",
        "sort": 0,
        "key": "test.boolean",
        "value": false,
        "provider_key": 0,
        "provider_name": "G"
    }
```

Use provider_name 
```php
    $userId= 3 ;
    $this->settingManager->getByKey('example.title','U',$userId);

    $anotherUserId = 4;
    $this->settingManager->setByKey('example.title','使用者自訂標題','U',$anotherUserId);
```

If you must get keys  
For example:
    social.fb
    social.line
    social.google

```php
    $userId= 3 ;
    $this->settingManager->getByFirstWord('social','U',$userId);

   
```

## Change SettingManager method
in the providers/AppServiceProvider

```php
    use App\YourNameSpace\MySetting;
    use Samchentw\Settings\Contracts\SettingManager;

    class AppServiceProvider extends ServiceProvider
    {

        public function boot()
        {
            app()->singleton(
                SettingManager::class,
                MySetting::class
            );

   
```

MySetting.php
```php
    use Samchentw\Settings\Contracts\SettingManager;
    use Samchentw\Settings\Models\Setting;
    
    class MySetting implements SettingManager
    {

        public function getByKey(string $key, $provider_name = '', $provider_key = null)
        {
            //your code....
        }

    //your code....
```