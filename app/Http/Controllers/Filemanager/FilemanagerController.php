<?php

namespace App\Http\Controllers\Filemanager;

use App\Http\Controllers\Controller;
use App\Models\Files;
use App\UseCases\FileService;
use Faker\Core\File;
use Illuminate\Http\Request;
use App\Dto\GeneratePathFileDTO;
use Illuminate\Support\Facades\Storage;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

/**
 * @group Filemanager - Filemanager
 *
 */
class FilemanagerController extends Controller
{
    private $service;

    public function __construct(FileService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $query = QueryBuilder::for(Files::class);
        $files = $query->paginate($request->per_page);
        return view('user.images', compact('files'));
    }

    /**
     * Filemanager Uploads
     *
     * @bodyParam files file required File
     */
    public function uploads(Request $request)
    {
        $request->validate([
            'file' => 'mimes:JPG,jpeg, jpg, svg, png|required|max:10000'
        ]);

        $file = $this->service->uploads($request,true);
        $url = asset('storage/static'. $file->path .'_800x600.'. $file->ext);
        $fileName = $file->file;
        return response()->json([ 'uploaded' => 1, 'url' => $url]);
    }
    public function delete($id)
    {
        $file = Files::findOrFail($id);
        $this->service->delete($file);
        $file->delete();

        return 'deleted';
    }
}
