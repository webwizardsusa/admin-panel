<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Backend\BaseController;

use App\Models\User;

class CustomerController extends BaseController
{
    protected $module = 'customer';
    protected $model = User::class;

    public function _query($query) 
    {
        return $query->where('role', 'customer');
    }
    
    public function _validation($id) 
    {
        return [
            'rules' => [
                'name' => 'required',
                'email' => 'required|email|unique:users,email'.($id == '' ? '' : ','.$id),
                'password' => $id=='' ? 'required' : '',
                'mobile' => 'numeric'
            ]
        ];
    }

    public function _beforeSave($request) 
    {
        if ($request['password']=='') {
            unset($request['password']);
        }

        $request['role'] = 'customer';
        $request['status'] = switches(($request['status'] ?? 0), 2, 2);

        return $request;
    }
}
