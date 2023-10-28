<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AccountController extends Controller
{
    public function index(Request $request)
    {
        $user_account = $request->input('user_account');
        $user_password = $request->input('user_password');

        $result = DB::connection('uark_php')->table(['users', 'status'])->select('org_id')->where('user_account', $user_account)->where('user_password', $user_password)->limit(1)->get();
        if ($result->isEmpty()) {
            return ['error' => '帳號或密碼錯誤'];
        }

        $org_no = $result[0]->org_no;
        if ($org_no == '_') {
            return view('create_org');
        }

        $status = $result[0]->status;
        if ($status == '1') {
            return ['error' => '帳號待審核中'];
        }

        return view('index', ['org_no' => $org_no]);
    }

    public function create_org(Request $request)
    {
        $org_no = $request->input('org_no');
        $org_title = $request->input('title');

        $result = DB::connection('uark_php')->table('orgs')->select('org_no')->where('org_no', $org_no)->get();
        if ($result->isEmpty()) {
            DB::connection('uark_php')->table('orgs')->insert(['org_no' => $org_no, 'title' => $org_title, 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        }

        return view('login');
    }

    public function create_user(Request $request)
    {
        $org_no = $request->input('org_no');

        $result = DB::connection('uark_php')->table('orgs')->select('org_no')->where('org_no', $org_no)->get();
        if ($result->isEmpty()) {
            DB::connection('uark_php')->table('orgs')->insert(['org_no' => $org_no, 'title' => 'test', 'created_at' => date('Y-m-d H:i:s'), 'updated_at' => date('Y-m-d H:i:s')]);
        }

        $user_name = $request->input('name');
        $user_birthday = $request->input('birthday');
        $user_email = $request->input('email');
        $user_account = $request->input('account');
        $user_password = $request->input('password');
        $user_file_upload = $request->input('file_path');

        try {
            if ($user_name == null || $user_name == '') {
                throw new \Exception('user_name is null');
            }

            if ($user_email == null || $user_email == '') {
                throw new \Exception('user_email is null');
            }

            if ($user_account == null || $user_account == '') {
                throw new \Exception('user_account is null');
            }

            if ($user_password == null || $user_password == '') {
                throw new \Exception('user_password is null');
            }

            if ($user_file_upload == null || $user_file_upload == '') {
                throw new \Exception('user_file_upload is null');
            }
        } catch (\Exception $e) {
            return ['error' => $e->getMessage()];
        }

        DB::connection('uark_php')->table('users')
            ->insert([
                'org_no' => $org_no,
                'name' => $user_name,
                'birthday' => $user_birthday,
                'email' => $user_email,
                'account' => $user_account,
                'password' => $user_password,
                'file_path' => $user_file_upload,
                'user_status' => '1', // 0: 刪除 1: 待審 2: 使用中
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]);

        return ['success' => 'success'];
    }


    //     return ['id' => $id];
    // }
}
