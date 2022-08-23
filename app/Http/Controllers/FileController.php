<?php

namespace App\Http\Controllers;

use App\Exceptions\UploadFileValidationException;
use App\Services\Storage\Uploader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class FileController extends Controller
{

    private $request;
    private $uploader;

    public function __construct(Request $request, Uploader $uploader)
    {
        $this->request = $request;
        $this->uploader = $uploader;
    }

    public function index()
    {
        return view('upload');
    }

    public function upload(Request $request)
    {
        try {

            $this->validateForm();

            $file = $this->uploader->uploade('comment');

            return response()->json([
                'data' => [
                    'link' => $this->getFileUploadedLink($file),
                ],
                'meta' => [
                    'message' => 'successful',
                    'status' => '1'
                ]
            ], 200);

        } catch (\Exception $exception) {
            dd(unserialize($exception->getMessage()));
        }
    }

    private function getFileUploadedLink($file)
    {
        return 'storage/comment/' . $file->type . '/' . $file->name;
    }

    private function validateForm()
    {

        $validator = Validator::make($this->request->all(), [
            'name' => 'required',
            'file' => 'required|
            mimetypes:image/jpg,image/bmp,image/png,image/jpeg,video/avi,video/mpeg,video/quicktime,application/zip,application/pdf|
            max:600000'
        ], [
            'name.required' => 'نام فایل الزامی میباشد',
            'file.required' => 'آپلود فایل الزامی میباشد',
            'file.mimetypes' => 'فرمت فایل آپلود شده معتبر نمیباشد',
            'file.max' => 'سایز فایل آپلود شده بیش از حد مجاز میباشد'
        ]);

        if (count($validator->getMessageBag()) > 0) {
            $serialize = serialize($validator->getMessageBag());
            throw new UploadFileValidationException($serialize);
        }
    }

}
