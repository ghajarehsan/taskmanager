<?php


namespace App\Services\Storage;

use App\Models\File;
use App\Services\Storage\StorageProvider;

use Illuminate\Http\Request;

class Uploader
{
    private $request;
    private $file;
    private $storage;

    public function __construct(Request $request, StorageProvider $storage)
    {
        $this->request = $request;
        $this->storage = $storage;
        $this->file = $request->file;
    }

    public function uploade($typeModel)
    {
        $fileName = $this->uploadFileToStorage($typeModel);

        $file = $this->uploadFileToDatabase($fileName,$typeModel);

        return $file;

    }

    private function uploadFileToStorage($typeModel)
    {
        $method = $this->getMethod();

        $fileName = $this->generateNameCode();

        $this->storage->$method($this->getType(), $fileName, $this->file,$typeModel);

        return $fileName;

    }

    private function uploadFileToDatabase($fileName)
    {
        return File::create([
            'name' => $fileName,
            'type' => $this->getType(),
            'size' => $this->getFileSize(),
            'is_private' => $this->isPrivate(),
            'fileable_id' => 1,
            'fileable_type' => 'model\\user',
            'user_id' => 1
        ]);
    }

    private function getFileSize()
    {
        return $this->file->getSize();
    }

    private function getType()
    {
        return [
            'image/jpg' => 'image',
            'image/bmp' => 'image',
            'image/png' => 'image',
            'image/jpeg' => 'image',
            'video/avi' => 'video',
            'video/mpeg' => 'video',
            'video/quicktime' => 'video',
            'application/zip' => 'zip',
            'application/pdf' => 'pdf'
        ][$this->file->getMimeType()];
    }

    private function getFileName()
    {
        return $this->file->getClientOriginalName();
    }

    private function isPrivate()
    {
        return $this->request->has('is_private');
    }

    private function getMethod()
    {
        return $this->isPrivate() ? 'putFileAsPrivate' : 'putFileAsPublic';
    }

    private function generateNameCode()
    {
        return rand(10000, 999999) . time() . $this->getFileName();
    }
}
