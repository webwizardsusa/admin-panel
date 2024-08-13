<?php

use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

function baseURL($param = '') 
{
    if (str_contains(url()->current(), '/webadmin')) {
        return url('/webadmin/' . $param);
    } else {
        return url('/' . $param);
    }
}

function dateFormat($type, $value) 
{
    if ($type == 1) return Carbon::parse($value)->format('Y-m-d');
    else if ($type == 2) return Carbon::parse($value)->format('Y-m-d H:i:s');
    else if ($type == 3) return Carbon::parse($value)->format('m-d-Y');
    else if ($type == 4) return Carbon::parse($value)->format('m-d-Y H:i:s');
}

function lists($type) 
{
    if ($type == 'gender') {
        return [
            'male' => 'Male',
            'female' => 'Female',
            'other' => 'Other'
        ];
    }
}

function switches($value, $type, $subtype = '') 
{
    if ($type == 1) {
        $badge = 'primary';

        if (in_array($value, ['inactive'])) {
            $badge = 'danger';
        }
        
        return "<span class='fs-2 badge text-bg-{$badge}'>".ucfirst($value)."</span>";
    } else if ($type == 2) {
        if ($subtype == 1) {
            return $value == 'active' || $value == 1 ? true : false;
        }else if ($subtype == 2) {
            return $value == 1 ? 'active' : 'inactive';
        }
    }
}

function fileExists($file) 
{
    if ($file != '') {
        $file = str_replace(url('/storage'), '', $file);
        
        if (Storage::disk('public')->exists($file)) {
            return true;
        } 
    }
    
    return false;
}