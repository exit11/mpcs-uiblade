<?php

namespace Exit11\UiBlade\Models;

use Exit11\UiBlade\Facades\UiBlade as Facade;
use Illuminate\Database\Eloquent\Model;
use Mpcs\Core\Traits\ModelTrait;
use MpcsUi\Bootstrap5\Traits\NestedSortableTrait;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class Menu extends Model
{
    use ModelTrait, NestedSortableTrait;

    protected $table = 'menus';
    public $timestamps = false;
    protected $guarded = ['id'];
    protected $dates = ['created_at', 'updated_at', 'period_from', 'period_to'];
    protected static $m_params = [
        'default_load_relations' => ['allParent', 'allChildren'],
        'column_maps' => [
            // date : {컬럼명}
            'from' => 'created_at',
            'to' => 'created_at',
        ]
    ];
    // $sortable 정의시 정렬기능을 제공할 필드는 필수 기입
    public $sortable = ['order'];
    public $defaultSortable = [
        'order' => 'asc',
    ];

    protected $casts = [
        'target' => 'boolean',
        'is_visible' => 'boolean',
        'created_at' => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
        'period_from' => 'datetime:Y-m-d H:i',
        'period_to' => 'datetime:Y-m-d H:i',
    ];

    // 메뉴 깊이
    public static $maxDepth;

    private $uploadDisk;
    private $imageRootDir;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->uploadDisk = Storage::disk('upload');
        $this->imageRootDir = 'menus';
    }

    /**
     * boot
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::setMemberParams(self::$m_params);

        self::$maxDepth = Facade::getMenuMaxDepth();
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

    /**
     * getStatusIsVisibleAttribute
     *
     * @return void
     */
    public function getStatusIsVisibleAttribute()
    {
        $checkPeriodEnd = $this->attributes['period_to'] ?? '9999-12-31 23:59:59';
        $periodStart = Carbon::createFromFormat('Y-m-d H:i:s', $this->attributes['period_from']);
        $periodEnd = Carbon::createFromFormat('Y-m-d H:i:s', $checkPeriodEnd);
        $periodCheck = Carbon::now()->between($periodStart, $periodEnd);
        $isVisible = $this->attributes['is_visible'];
        $result = false;
        if ($periodCheck && $isVisible) {
            $result = true;
        }

        return $result;
    }

    /**
     * getUploadDiskAttribute
     *
     * @return void
     */
    public function getUploadDiskAttribute()
    {
        return $this->uploadDisk;
    }

    /**
     * getRootDirAttribute
     *
     * @return void
     */
    public function getImageRootDirAttribute()
    {
        return $this->imageRootDir;
    }

    /**
     * getFileUrlAttribute
     *
     * @return void
     */
    public function getImageFileUrlAttribute()
    {
        if ($this->background_image) {
            return $this->upload_disk->url($this->image_root_dir . '/' . $this->background_image);
        }
        return Facade::noImage();
    }
}
