<?php

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
    else if ($type == 3) return Carbon::parse($value)->format('d-m-Y');
    else if ($type == 4) return Carbon::parse($value)->format('d-m-Y H:i:s');
}

function lists($type) 
{
    if ($type == 'gender') {
        return [
            'male' => 'Male',
            'female' => 'Female',
            'other' => 'Other'
        ];
    } else if ($type == 'status') {
        return [
            'active' => 'Active',
            'inactive' => 'Inactive'
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