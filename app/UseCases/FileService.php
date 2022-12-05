<?php

namespace App\UseCases;

use App\Dto\GeneratedPathFileDTO;
use App\Dto\GeneratePathFileDTO;
use App\Helpers\FilemanagerHelper;
use App\Http\Repository\Interfaces\FileInterface;
use App\Models\Files;
use DomainException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;
use Throwable;



class FileService
{
    public function uploads(Request $request,$createthumb=false)
    {
        $files = $request->file('file');

//        if (is_array($request->file('file'))) {
//
//            if (!in_array($files[0]->extension(), ['JPG', 'jpeg', 'jpg', 'svg', 'png'])) {
//                return response()->with('Unknown extension');
//            }
//
//            $response = [];
//            foreach ($files as $file) {
//                $dto = new GeneratePathFileDTO();
//                $dto->file = $file;
//                $dto->createThumbnails=$createthumb;
//                $dto->folder_id = $request->get('folder_id');
//                $response[] = $this->uploadFile($dto);
//            }
//
//            return $response;
//        } else {
            if (!in_array($files->extension(), ['JPG', 'jpeg', 'jpg', 'svg', 'png'])) {
                return response()->json('Unknown extension')->setStatusCode(422);
            }
            $dto = new GeneratePathFileDTO();
            $dto->file = $files;
            $dto->createThumbnails=$createthumb;

            return $this->uploadFile($dto);
//        }
    }
    public function uploadFile(GeneratePathFileDTO $dto)
    {
        DB::beginTransaction();
        try {
            $generatedDTO = $this->generatePath($dto);
            $generatedDTO->origin_name = $dto->file->getClientOriginalName();
            $generatedDTO->file_size = $dto->file->getSize();
            $dto->file->move($generatedDTO->file_folder, $generatedDTO->file_name . '.' . $generatedDTO->file_ext);
            $file = $this->createFileModel($generatedDTO);
            if($dto->createThumbnails)
            {
                $this->createThumbnails($file);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            throw new DomainException($e->getMessage());
        }
        return $file;
    }
    public function generatePath(GeneratePathFileDTO $generatePathFileDTO): GeneratedPathFileDTO
    {
        $generatedPathFileDTO = new GeneratedPathFileDTO();
        $created_at = time();

        $file = $generatePathFileDTO->file;
        $y = date("Y", $created_at);
        $m = date("m", $created_at);
        $d = date("d", $created_at);
        $h = date("H", $created_at);
        $i = date("i", $created_at);

        $folders = [
            $y,
            $m,
            $d,
            $h,
            $i
        ];
        $file_hash = Str::random(32);
        $basePath = storage_path('app/public/static');
        $folderPath = '';
        foreach ($folders as $folder) {
            $basePath .=  '/' . $folder;
            $folderPath .= '/' . $folder;
            if (!is_dir($basePath)) {
                mkdir($basePath, 0777);
                chmod($basePath, 0777);
            }
        }
        if (!is_writable($basePath)) {
            throw new DomainException("Path is not writeable");
        }
        $generatedPathFileDTO->file_folder = $basePath;
        $path = $folderPath . '/' . $file_hash;
        $generatedPathFileDTO->file_name = $file_hash;
        $generatedPathFileDTO->file_ext = $file->getClientOriginalExtension();
        $generatedPathFileDTO->file_path = $path;
        $generatedPathFileDTO->created_at = $created_at;
        return $generatedPathFileDTO;
    }
    public function delete($id)
    {
        $file = Files::findOrFail($id);
        if ($file->getIsImage()) {
            $thumbsImages = FileManagerHelper::getThumbsImage();
            foreach ($thumbsImages as $thumbsImage) {
                $slug = $thumbsImage['slug'];
                unlink($file->folder . '/' . $file->slug . '_' . $slug . '.' . $file->ext);
            }
        }
        unlink($file->folder . '/' . $file->file);
    }
    private function createFileModel(GeneratedPathFileDTO $generatedDTO)
    {
        $data = [
            'title' => $generatedDTO->origin_name,
            'slug' => $generatedDTO->file_name,
            'ext' => $generatedDTO->file_ext,
            'file' => $generatedDTO->file_name . '.' . $generatedDTO->file_ext,
            //            'user_id' => Auth::id(),
            'path' => $generatedDTO->file_path,
            'size' => $generatedDTO->file_size,
            'folder' => $generatedDTO->file_folder,
        ];
        try {
            $file = Files::create($data);
        } catch (\Exception $exception) {
            print_r($exception->getMessage());
            exit();
        }
        return $file;
    }
    private function createThumbnails(Files $file)
    {
        if (!$file->getIsImage()) {
            return null;
        }

        $thumbsImages = FileManagerHelper::getThumbsImage();
        $origin = $file->getDist();
        try {
            foreach ($thumbsImages as $thumbsImage) {
                $width = $thumbsImage['w'];
                $quality = $thumbsImage['q'];
                $slug = $thumbsImage['slug'];
                $newFileDist = $file->folder . '/' . $file->slug . "_" . $slug . "." . $file->ext;
                if ($file->ext == 'svg') {
                    copy($origin, $newFileDist);
                } else {
                    $img = Image::make($origin);
                    $height = $width / ($img->getWidth() / $img->getHeight());
                    $img->resize($width, $height)->save($newFileDist, $quality);
                }
            }
        } catch (Throwable $e) {
            report($e);
            return false;
        }

        return true;
    }
}
