<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Store;


class StaffController extends Controller
{
    function list()
    {
        $staffs=staff::all();
        return view('staff.list',['staffs'=>$staffs]);
    }

    function create(){
        $staffs=new Staff();
        $stores=Store::all();
        return view('staff.form', compact('staff', 'stores'));

    }

    function edit($staff_id){
        $staff=staff::find($staff_id);
        $stores=Store::all();
        return view ('staff.form', compact ('staff', 'stores'));
    }

    function store(Request $req){
        $staff_id=$req->staff_id;
        if(empty($staff_id)){
            //insert
            $staff=new Staff();
            $staff->created_by=session('username');

        }else{
            //update
            $staff=Staff::find ($staff_id);
        }

        $staff->first_name=$req->first_name;
        $staff->last_name=$req->last_name;
        $staff->email=$req->email;
        $staff->password=$req->password;
        $staff->address_id=1;
        $staff->username=$req->username;
        $staff->active=$req->active;
        $staff->store_id=$req->store_id;

        //validation
        $rules=[
            'username'=>'required|min:4',
            'first_name'=>'required',
            'last_name'=>'required',
            'email'=>'required|email',
            'password'=>'required|min4',
            'store_id'=>'required',
            'picture'=>'mimes:jpeg,png,gif,svg|max:100',
            'username'=>'required|min:4',

        ];

        $msg=[
            'username.required'=>'User ID need to be filled',
            'username.min'=>'User ID need at least 4 character',
            'store_id. required'=>'Store need to be filled',
            'picture.size'=>'Size of the picture need at least less than 10kb',
        ];

        $v =Validator::make($req->all(), $rules, $msg);

        if($v->fails()){
            $stores=Store::all();
            return view('staff.form', compact('staff', 'stores'))->withErrors($v);
        }else{
            //success, insert data
            if($req->hasFile('picture')){
                $photo=$req->file('picture')->store('photo');
                $staff->photo=$photo;
            }

            $staff->save();

            \DB::table('model_has_roles')->where('model_id', $staff->staff_id)->delete();


            foreach($req->role as $role){
                \DB::table('model_has_roles')->insert([
                    'model_id'=>$staff->staff_id,
                    'role_id'=>$role,
                    'model_type'=>'App\Model\User'
                ]);
            }
            return redirect ('/staff/list');

        }

    }

    function delete ($staff_id)
    {
        Staff::find ($staff_id)->delete();
        return redirect ('/staff/list');

    }

    function image(Request $req){
        $content=\Illuminate\Support\Facades\Storage::get($req->location);

        return response($content)->content('Content-type', 'image/png');
    }

}
