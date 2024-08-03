<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class MenuController extends Controller
{
    public function showMenu()
    {
        return view("menu")->with("is_imported", Product::exists() ? true : false);
    }
}
