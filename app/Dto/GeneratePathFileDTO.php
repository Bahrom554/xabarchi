<?php
namespace App\Dto;

use Illuminate\Http\UploadedFile;

class GeneratePathFileDTO
{
    /**
     * @var $file UploadedFile
     */
    public $file;
    public $folder_id;

    public $createThumbnails;
}
