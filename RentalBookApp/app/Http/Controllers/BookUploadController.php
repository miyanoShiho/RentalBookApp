<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BookUploadController extends Controller
{
    /**
     * Show the application dashboard.
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function uplode()
    {
        $data = session()->all();
        dd($data);
        return view('uplode');
    }

    /**
     * Save Book imformation.
     * 
     * 
     */
    public function save(){
        
    }
}