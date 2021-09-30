<?php

namespace Samchentw\Settings\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Samchentw\Settings\Observers\SettingObserver;

class Setting extends Model
{
    use HasFactory;


    protected static function boot()
    {
        parent::boot();
        static::observe(new SettingObserver);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'key', 'value', 'display_name', 'sort', 'type', 'provider_key', 'provider_name'
    ];

    /**
     * type enum
     * 
     * @var array String、Text、Number、Boolean、Html、Date、DateTime、Json
     */
    public const TYPES = [
        'String' => 'string',     //一般字串
        'Text' => 'text',         //textarea
        'Number'  => 'number',    //數字
        'Boolean'  => 'boolean',  //布林值
        'Html'  => 'html',        //文字編輯器
        'Date'  => 'date',         //日期
        'DateTime'  => 'date_time', //日期時間
        'Json'  => 'json'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
