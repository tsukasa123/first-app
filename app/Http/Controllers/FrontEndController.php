<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Storage;

class FrontEndController extends Controller
{
    public function index(){
        
        $logo = Storage::disk('s3')->url('feartalk.png');
        $first_image = Storage::disk('s3')->url('first-image.png');
        $second_image = Storage::disk('s3')->url('second-image.png');

        return view('welcome')->with('logo', $logo)
                              ->with('first_image', $first_image)
                              ->with('second_image', $second_image);
    }
}
