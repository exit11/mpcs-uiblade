<?php

namespace Exit11\UiBlade\Models;

use Illuminate\Database\Eloquent\Model;
use Mpcs\Core\Facades\Core;
use Mpcs\Core\Traits\ModelTrait;
use MpcsUi\Bootstrap5\Traits\NestedSortableTrait;
use Exit11\UiBlade\Facades\UiBlade;

class Menu extends Model
{
    use ModelTrait, NestedSortableTrait;

    protected $table = 'menus';
    public $timestamps = false;
    protected $guarded = ['id'];
    protected static $m_params = [
        'default_load_relations' => ['allParent', 'allChildren']
    ];
    // $sortable 정의시 정렬기능을 제공할 필드는 필수 기입
    public $sortable = ['order'];
    public $defaultSortable = [
        'order' => 'asc',
    ];

    // 메뉴 깊이
    public static $maxDepth;

    /**
     * boot
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::setMemberParams(self::$m_params);

        self::$maxDepth = UiBlade::getMenuMaxDepth();
    }

    /**
     * getTargetAttribute
     *
     * @param  mixed $value
     * @return void
     */
    public function getTargetAttribute($value)
    {
        return $value ? '_blank' : '_self';
    }

    /**
     * setTargetAttribute
     *
     * @param  mixed $value
     * @return void
     */
    public function setTargetAttribute($value)
    {
        $this->attributes['target'] = ($value == '_self') ? 0 : 1;
    }
}
