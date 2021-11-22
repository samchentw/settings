<?php

return [

    /**
     * 換資料庫參數
     */
    "connection" => env('SETTING_CONNECTION', ''),


    /**
     * 註冊有效provider_name值
     * G(全域)、U(使用者) 為預設
     */
    "customer_provider_name" => [
        'A', //範例一
        'B', //範例二
    ],


    /**
     * 預設的provider_name
     */
    "default_provider_name" => 'G',

    /**
     * 是否啟用setting預設api
     */
    "setting_api_enable" => false,
];
