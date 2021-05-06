<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
    public function login(Request $request) {
        $error_msg = [ 'account' => [ '利用者コードまたはパスワードが違います' ] ];
        $params = [
            'username' => $request->input('username'),
            'password' => $request->input('password'),
        ];

        $rules = [
            'username' => 'required|max:50',
            'password' => 'required|max:50',
        ];

        // not use error message
        $messages = [
            'username.required'       => 'Usernameを入力してください(必須)',
            'username.max'            => 'Usernameは、:max文字以下で指定してください。',
            'password.required'       => 'パスワードを入力してください(必須)',
            'password.max'            => 'パスワードは、:max文字以下で指定してください。',
        ];
        $validator = Validator::make($params, $rules, $messages);

        if ($validator->passes()) {
            if (Auth::attempt($request->only('username', 'password'))) {
                return response()->json(Auth::user(), 200);
            }
            return response($error_msg, 404);
        }
        return response($validator->messages(), 404);
    }

    public function logout() {
        Auth::logout();
    }
}
