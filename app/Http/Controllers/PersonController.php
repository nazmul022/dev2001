<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PersonController extends Controller
{
    function person(){
        $person = "This is the first person";
        return view('persons/person', compact('person'));
    }
}
