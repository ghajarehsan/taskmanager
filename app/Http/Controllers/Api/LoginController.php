<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function insertPhoneNumber()
    {
        try {
            $validation = $this->checkLoginValidation();

            if ($this->checkMobileExsist()) {
                $code = $this->createCode();
                return response()->json([
                    'date' => [
                        'result' => 'successfull',
                        'message' => 'code generate',
                        'code' => $code
                    ],
                    'meta' => []
                ], 200);
            }

            $this->createUser();
            $code = $this->createCode();
            return response()->json([
                'date' => [
                    'result' => 'successfull',
                    'message' => 'code and user created',
                    'code' => $code
                ],
                'meta' => []
            ], 200);

        } catch (\Exception $exception) {
            if ($exception->getCode() == 100) {
                return response()->json([
                    'data' => null,
                    'meta' => [
                        'message' => unserialize($exception->getMessage()),
                        'status' => 404,
                    ]
                ], 404);
            }
            dd($exception);
        }
    }

    private function checkLoginValidation()
    {
        $validation = Validator::make($this->request->all(), [
            'mobile' => 'required',
        ], [
            'mobile.required' => 'شماره موبایل الزامی میباشد'
        ]);

        if ($validation->fails()) {
            throw new \Exception(serialize($validation->getMessageBag()), 100);
        }
    }

    private function checkMobileExsist()
    {
        return User::where('mobile', $this->request->mobile)->first();
    }

    private function createCode()
    {
        return Cache::remember('loginCode' . $this->request->mobile, 200, function () {
            $code = rand(10000, 99999);
            return $code;
        });
    }

    private function createUser()
    {
        $user = User::create([
            'name' => 'guest',
            'email' => $this->request->mobile . '@yahoo.com',
            'mobile' => $this->request->mobile,
            'password' => '',
        ]);
        return $user;
    }

    public function loginByCode()
    {
        try {

            $this->inserCodeValidation();

            $code = $this->getCodeVersification();

            if ($code != $this->request->code) {
                return response()->json([
                    'data' => null,
                    'meta' => [
                        'message' => 'code is wrong',
                        'status' => 'unsuccessful'
                    ]
                ], 404);
            }

            return response()->json([
                'data' => [
                    'token' => $this->createToken()->plainTextToken,
                ],
                'meta' => [
                    'message' => 'token was created',
                    'status' => 'successful'
                ]
            ], 200);

        } catch (\Exception $exception) {

            $message = '';

            if ($exception->getCode() == 100) {
                $message = unserialize($exception->getMessage());
            } else {
                $message = $exception->getMessage();
            }
            return response()->json([
                'data' => null,
                'meta' => [
                    'message' => $message,
                    'status' => 404
                ]
            ], 404);
        }
    }

    private function inserCodeValidation()
    {
        $validation = Validator::make($this->request->all(), [
            'code' => 'required',
            'mobile' => 'required'
        ], [
            'code.required' => 'کد رمز عبور الزامی میباشد',
            'mobile.required' => 'وارد کردن موبایل الزامی میباشد'
        ]);
        if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 100);
    }

    private function getCodeVersification()
    {
        $code = Cache::get('loginCode' . $this->request->mobile);

        if ($code == null) throw new \Exception('code expired');

        return $code;
    }

    private function createToken()
    {
        $user = User::where('mobile', $this->request->mobile)->first();
        return $user->createToken('API TOKEN');
    }

    public function logout()
    {
        $user = auth()->user();
        $result = $user->currentAccessToken()->delete();
        return response()->json([
            'data' => [
                'message' => 'با موفقیت خروج انجام شد',
                'status' => 200
            ], 200]);
    }

    public function setPassword()
    {
        try {
            $this->setPasswordValidation();

            $user = auth()->user();

            $user->password = Hash::make($this->request->password);

            $user->save();

            return response()->json([
                'data' => [
                    'message' => 'رمز با موفقیت ثبت گردید',
                    'status' => 200
                ]
            ], 200);

        } catch (\Exception $exception) {
            dd($exception->getMessage());
            if ($exception->getCode() == 100) {
                return response()->json([
                    'data' => null,
                    'meta' => [
                        'message' => unserialize($exception->getMessage()),
                        'status' => 404
                    ]
                ], 404);
            }
        }
    }

    private function setPasswordValidation()
    {
        $validation = Validator::make($this->request->all(), [
            'password' => 'required'
        ], [
            'password.required' => 'پسوود الزامی میباشد'
        ]);
        if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 100);
    }

    public function loginByConstancePassword()
    {

        try {
            $this->loginByConstancePasswordValidation();

            $attemp = ['mobile' => $this->request->mobile, 'password' => $this->request->password];

            if (!Auth::attempt($attemp)) throw new \Exception('',101);

            return response()->json([
                'data' => [
                    'message' => 'لاگین با موفقیت انجام شد',
                    'token' => $this->createToken()->plainTextToken,
                ],
                'meta' => null
            ], 200);

        } catch (\Exception $exception) {

            $message = '';

            if ($exception->getCode() == 100) {
                $message = unserialize($exception->getMessage());
            }

            if ($exception->getCode() == 101) {
                $message = 'نام کاربری یا رمز عبور نا معتبر است';
            }

            return response()->json([
                'data' => null,
                'meta' => [
                    'message' => $message,
                    'status' => 404
                ]
            ], 404);
        }

    }

    private function loginByConstancePasswordValidation()
    {

        $validation = Validator::make($this->request->all(), [
            'mobile' => 'required',
            'password' => 'required'
        ], [
            'mobile.required' => 'شماره موبایل الزامی میباشد',
            'password.required' => 'پسوورد الزامی میباشد'
        ]);

        if ($validation->fails()) throw new \Exception(serialize($validation->getMessageBag()), 100);
    }
}
