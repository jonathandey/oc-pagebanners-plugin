<?php 

namespace JD\PageBanners\Models;

use Model;
use Cms\Classes\Page;
use System\Models\File;

/**
 * Banner Model
 */
class Banner extends Model
{
    /**
     * @var string The database table used by the model.
     */
    public $table = 'jd_pagebanners_banners';

    /**
     * @var array Guarded fields
     */
    protected $guarded = ['*'];

    /**
     * @var array Fillable fields
     */
    protected $fillable = [];

    /**
     * @var array Relations
     */
    public $hasOne = [];
    public $hasMany = [];
    public $belongsTo = [];
    public $belongsToMany = [];
    public $morphTo = [];
    public $morphOne = [];
    public $morphMany = [];

    public $attachOne = [];

    public $attachMany = [
        'images' => [File::class],
    ];

    public function getPageIdOptions()
    {
        return Page::lists('title', 'id');
    }
}
