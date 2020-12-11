<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\UploadedFile;
use Image;

class UserController extends Controller
{
    public function profile()
    {
        return view('user.profile', array('user' => Auth::user()));
    }

    public function updateProfile(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required | email',
            'fullname' => 'required',
        ] ,[
            'email.email' => 'Email ko hop le',
            'email.required' => 'Email la bat buoc',
            'fullname.required' => 'Ho ten la bat buoc'
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->
            withInput();
        }


        $user = Auth::user();

        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300, 300)->save(public_path('/uploads/avatars/' . $filename));
            $user->avatar = $filename;
            $user->save();
        }
        $fullname = $request->input('fullname');
        $email = $request->input('email');
        $user->fullname = $fullname;
        $user->email = $email;
        

        $user->save();
        return back()->withSuccess('Thay doi profile thanh cong');;

    }
    public function password()
    {
        return view('user.password');
    }
    public function changePassword(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'password' => 'required',
            'new-password' => 'required|min:3|max:25',
            're-password' => 'required|min:3|max:25|same:new-password',
        ],[
            'password.required' => 'Mat khau cu la bat buoc',
            'new-password.required' => 'Mat khau cu la bat buoc',
            'new-password.min' => 'Mat khau moi toi thieu 3 ky tu',
            're-password.required' =>'Mat khau cu la bat buoc',
            're-password.same' => 'Nhap sai mat khau moi',
        ]);

        if($validator->fails()) {
            return back()->withErrors($validator)->withInput();;
        }

        $password = $request->input('password');
        $new_password = $request->input('new-password');
        $re_password = $request->input('re-password');
        $user = Auth::user();
        if (!Hash::check ($password , $user->password)){
            return back()->withError('Mat khau cu khong chinh xac');
        }

        $user->password = bcrypt($request->input('new-password'));
        $user->save();
        return back()->withSuccess('Thay doi mk thanh cong');
    }
}
