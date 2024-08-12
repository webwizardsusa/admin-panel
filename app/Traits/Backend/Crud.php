<?php

namespace App\Traits\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

trait Crud
{
    public function __construct()
    {
        $this->title = ucfirst($this->module);
        $this->dt = ucfirst($this->module);
        $this->view = $this->view ?? $this->module;
        $this->redirect = $this->redirect ?? $this->module;
    }

    public function index()
    {
        $dt = "\\App\DataTables\\Backend\\{$this->dt}DataTable";
        $dataTable = new $dt;

        return $dataTable->render("backend.{$this->view}.list");
    }

    public function create()
    {
        return view("backend.{$this->view}.create", $this->_shareData());
    }

    public function store(Request $request)
    {
        return $this->_action($request);
    }

    public function show(string $id)
    {
        $record = $this->_select($id);

        if ($record instanceof \Illuminate\Http\RedirectResponse) {
            return $record;
        }

        return view("backend.{$this->view}.show", compact('record')+$this->_shareData());
    }

    public function edit(string $id)
    {
        $record = $this->_select($id);

        if ($record instanceof \Illuminate\Http\RedirectResponse) {
            return $record;
        }

        return view("backend.{$this->view}.edit", compact('id', 'record')+$this->_shareData());
    }

    public function update(Request $request, string $id)
    {
        return $this->_action($request, $id);
    }

    public function destroy(string $id)
    {
        $record = $this->_select($id);

        if ($record instanceof \Illuminate\Http\RedirectResponse) {
            return $record;
        }

        $result = $record->delete();

        if ($result) {
            return redirect(baseURL($this->redirect))->with("success", "{$this->title} deleted successfully.");
        }else{
            return redirect(baseURL($this->redirect))->with("danger", "Something went wrong.");
        }
    }

    protected function _shareData()
    {
        return [];
    }

    protected function _select($id)
    {
        $model = new $this->model();

        if (method_exists($this, '_query')) {
            $record = $this->_query($model->where('id', $id))->first();
        } else { 
            $record = $model->find($id);
        }

        if ($record) {
            return $record;
        } else {
            return redirect(baseURL($this->redirect))->with("danger", "{$this->title} not found.");
        }
    }

    protected function _action($request, $id = '')
    {
        $validate = $this->_validate($id);
        
        if ($validate) {
            return $validate;
        }

        $requestData = $request->all();

        if (method_exists($this, '_beforeSave')) {
            $requestData = $this->_beforeSave($requestData);
        }

        $model = new $this->model();

        if ($id != '') {
            $model = $model->find($id);
        }

        $result = $model->fill($requestData)->save();

        if (method_exists($this, '_afterSave')) {
            $result = $this->_afterSave($result);
        }

        if ($result) {
            if ($id == '') {
                return redirect(baseURL($this->redirect))->with("success", "{$this->title} created successfully.");
            } else {
                return redirect(baseURL($this->redirect))->with("success", "{$this->title} updated successfully.");
            }
        }else{
            return redirect(baseURL($this->redirect))->with("danger", "Something went wrong.");
        }
    }

    protected function _validate($id)
    {
        if (method_exists($this, '_validation')) {
            $validation = $this->_validation($id);

            return $this->_validator(($validation['rules'] ?? []), ($validation['messages'] ?? []));
        }

        return null;
    }

    protected function _validator($rules=[], $messages=[])
    {
        $validator = Validator::make(request()->all(), $rules, $messages);
 
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        return null;
    }

    protected function _fileUpload($file, $path)
    {
        if (request()->hasFile($file)) {
            $file = request()->file($file);
            $name = $file->hashName();

            Storage::disk('public')->put($path, $file);
            
            return $name;
        } else {
            return false;
        }
    }
}
