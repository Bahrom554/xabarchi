<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\FilemanagerHelper;

class Files extends Model
{
    protected $table = 'files';

    protected $fillable = [
        'title',
        'description',
        'slug',
        'ext',
        'file',
        'folder',
        'domain',
        'user_id',
        'path',
        'size',
        'folder_id'
    ];

    //    protected $appends = [
    //        'thumbnails'
    //    ];
    /**
     * @var mixed
     */


    /**
     * @return bool
     */
    public function getIsImage()
    {
        return in_array($this->ext, FileManagerHelper::getImagesExt());
    }

    /**
     * @return string
     */
    public function getDist()
    {
        return $this->folder . '/' . $this->file;
    }

    public function getUserAttribute()
    {
        return $this->hasOne('App\Models\User');
    }

 
}
