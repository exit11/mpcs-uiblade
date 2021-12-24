<?php

namespace Exit11\UiBlade\Models;

use Illuminate\Database\Eloquent\Model;
use Mpcs\Core\Facades\Core;
use Mpcs\Core\Traits\ModelTrait;

class Menu extends Model 
{
    use ModelTrait;

    protected $table = 'menus';
    public $timestamps = false;
    protected $guarded = ['id'];
    protected static $m_params = [
        'default_load_relations' => [],
        'view_load_relations' => [],
        'column_maps' => []
    ];
    // $sortable 정의시 정렬기능을 제공할 필드는 필수 기입
    // public $sortable = ['id', 'name', 'is_visible'];

    /**
     * boot
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        // static::setMemberParams(self::$m_params);
    }
}