<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

use App\Traits\Backend\Crud;

class BaseController extends Controller
{
    use Crud;
}
