<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Lang;
use Illuminate\Support\Facades\App;

class AccountController extends Controller
{
    public function verify(Request $request)
    {
        $user_account = $request->input('username');
        $user_password = $request->input('password');

        Session::put('account', $user_account);

        $result = DB::connection('uark_php')->table('users')->select(['status', 'password'])->where('account', $user_account)->limit(1)->get();

        if ($result->isEmpty()) {
            return redirect('/create_user');
        } else {
            $status = $result[0]->status;
            $password = $result[0]->password;

            if ($password != $user_password) {
                Session::put('status', -1);
            } else {
                Session::put('status', $status);
            }

            if ($status > 1 && $password == $user_password) {
                return redirect('/home');
            } else {
                return redirect('/review');
            }
        }
    }

    public function logout(Request $request)
    {
        Session::flush();
        return redirect('/login');
    }

    public function createOrg(Request $request)
    {
        $org_no = $request->input('org_no');
        $title = $request->input('title');

        $result = DB::connection('uark_php')->table('orgs')->select('org_no')->where('org_no', $org_no)->get();
        if ($result->isEmpty() == false) {
            Session::put('message', Lang::get('messages.org_no') . Lang::get('messages.exist'));
            return redirect('/create_org/result');
        }

        $result = DB::connection('uark_php')->table('orgs')->select('title')->where('title', $title)->get();
        if ($result->isEmpty() == false) {
            Session::put('message', Lang::get('messages.org_name') . Lang::get('messages.exist'));
            return redirect('/create_org/result');
        }

        DB::connection('uark_php')->table('orgs')->insert(['org_no' => $org_no, 'title' => $title, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s'), 'status' => 1]);

        Session::put('message', Lang::get('messages.org_no') . ": " . $org_no . ", " . Lang::get('messages.org_name') . ": " . $title . Lang::get('messages.create') . Lang::get('messages.success'));
        return redirect('/create_org/result');
    }

    public function createUser(Request $request)
    {
        $user_account = $request->input('account');

        $check = DB::connection('uark_php')->table('users')->select('account')->where('account', $user_account)->get();
        if ($check->isEmpty() == false) {
            Session::put('message', Lang::get('messages.account') . Lang::get('messages.exist'));
            return redirect('/create_user/result');
        }

        DB::connection('uark_php')->table('users')
            ->insert([
                'org_id' => $request->input('org'),
                'name' => $request->input('name'),
                'birthday' => $request->input('birthday'),
                'email' => $request->input('email'),
                'account' => $user_account,
                'password' => $request->input('password'),
                'status' => '1', // 0: 刪除 1: 待審 2: 使用中
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        $user_id = DB::connection('uark_php')->table('users')->select('id')->where('account', $user_account)->get()[0]->id;
        DB::connection('uark_php')->table('apply_file')
            ->insert([
                'user_id' => $user_id,
                'file_path' => $request->input('file_path'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        Session::put('message', Lang::get('messages.account') . ": " . $user_account . Lang::get('messages.create') . Lang::get('messages.success'));
        return redirect('/create_user/result');
    }
}
