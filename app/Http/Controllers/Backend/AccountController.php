<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;
use Illuminate\Http\Request;

use App\Models\User;

class AccountController extends BaseController
{
    protected $module = 'profile';
    protected $model = User::class;

    public function profile(Request $request)
    {
        $id = auth()->user()->id;

        $record = $this->_select($id);

        if ($record instanceof \Illuminate\Http\RedirectResponse) {
            return $record;
        }
        
        if ($request->isMethod('put')) {
            return $this->_action($request, $id);
        }

        $gender_list = ['' => 'Select Gender']+User::$gender;

        return view('backend.account.profile', compact('record', 'gender_list'));
    }

    public function _validation($id) 
    {
        return [
            'rules' => [
                'name' => 'required',
                'email' => 'required|email|unique:users,email'.($id == '' ? '' : ','.$id),
                'password' => $id=='' ? 'required' : '',
                'mobile' => 'required|numeric'
            ]
        ];
    }

    public function _beforeSave($request) 
    {
        $image = $this->_fileUpload('image', 'profile');
        $request['image'] = $image ? $image : $request['image_hidden'];

        if ($request['password']=='') {
            unset($request['password']);
        }

        return $request;
    }
}
