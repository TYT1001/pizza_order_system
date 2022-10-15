<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CollectionController extends Controller
{
    public function index(){
        $array = collect([2,3,4,5]);
        dd($array);
    }
}
