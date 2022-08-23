<?php

namespace App\Services\Storage;

use Illuminate\Support\Facades\Storage;

class StorageProvider
{

    public function putFileAsPrivate($type, $name, $file, $typeModel)
    {
        Storage::disk('private')->putFileAs($typeModel . '/' . $type, $file, $name);
    }

    public function putFileAsPublic($type, $name, $file, $typeModel)
    {
        Storage::disk('public')->putFileAs($typeModel . '/' . $type, $file, $name);
    }
}
