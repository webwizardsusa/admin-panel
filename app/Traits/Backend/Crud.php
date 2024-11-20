<?php

namespace App\Traits\Backend;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

trait Crud
{
    public function __construct()
    {
        $this->title = ucfirst($this->module);
        $this->dt = ucfirst($this->module);
        $this->view = $this->view ?? $this->module;
        $this->message = $this->message ?? $this->title;
        $this->redirect = $this->redirect ?? $this->module;
        $this->isDataTable = $this->isDataTable ?? true;
    }

    public function index()
    {
        if ($this->isDataTable) {
            $dt = "\\App\DataTables\\Backend\\{$this->dt}DataTable";
            $dataTable = new $dt;

            return $dataTable->render("backend.{$this->view}.list");
        } else {
            if (method_exists($this, '_shareData')) {
                $shareData = $this->_shareData('list');
            } else {
                $shareData = [];
            }

            return view("backend.{$this->view}.list", $shareData);
        }
    }

    public function create()
    {
        if (method_exists($this, '_shareData')) {
            $shareData = $this->_shareData('create');
        } else {
            $shareData = [];
        }

        return view("backend.{$this->view}.create", $shareData);
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

        if (method_exists($this, '_shareData')) {
            $shareData = $this->_shareData('show', $id);
        } else {
            $shareData = [];
        }

        return view("backend.{$this->view}.show", compact('record')+$shareData);
    }

    public function edit(string $id)
    {
        $record = $this->_select($id);

        if ($record instanceof \Illuminate\Http\RedirectResponse) {
            return $record;
        }

        if (method_exists($this, '_shareData')) {
            $shareData = $this->_shareData('edit', $id);
        } else {
            $shareData = [];
        }

        return view("backend.{$this->view}.edit", compact('id', 'record')+$shareData);
    }

    public function update(Request $request, string $id)
    {
        return $this->_action($request, $id);
    }

    public function destroy(string $id)
    {
        DB::beginTransaction(); 
        
        $record = $this->_select($id);

        if ($record instanceof \Illuminate\Http\RedirectResponse) {
            return $record;
        }

        $result = $record->delete();

        if ($result) {
            DB::commit();
            
            $message = "{$this->message} deleted successfully";
            
            if (request()->ajax()) {
                return response()->json(ajaxResponse(true, $message, []));
            }

            return redirect(baseURL($this->redirect))->with("success",$message);
        }else{
            DB::rollBack();

            $message = "Something went wrong.";

            if (request()->ajax()) {
                return response()->json(ajaxResponse(false, $message, []));
            }

            return redirect(baseURL($this->redirect))->with("danger", $message);
        }
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
            return redirect(baseURL($this->redirect))->with("danger", "{$this->message} not found.");
        }
    }

    protected function _action($request, $id = '')
    {
        $validate = $this->_validate($id);
        
        if ($validate) {
            return $validate;
        }

        DB::beginTransaction(); 

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
            DB::commit();

            if ($id == '') {
                $message = "{$this->message} created successfully.";
                
                if ($request->ajax()) {
                    return response()->json(ajaxResponse(true, $message, []));
                }

                return redirect(baseURL($this->redirect))->with("success", $message);
            } else {
                $message = "{$this->message} updated successfully.";
                
                if ($request->ajax()) {
                    return response()->json(ajaxResponse(true, $message, []));
                }

                return redirect(baseURL($this->redirect))->with("success", $message);
            }
        }else{
            DB::rollBack();

            $message = "Something went wrong";

            if ($request->ajax()) {
                return response()->json(ajaxResponse(false, $message, []));
            }

            return redirect(baseURL($this->redirect))->with("danger", $message);
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
            if (request()->ajax()) {
                return response()->json(ajaxResponse(false, "Something went wrong", $validator->errors()), 422);
            }

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
