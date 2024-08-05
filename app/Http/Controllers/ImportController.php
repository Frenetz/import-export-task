<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Imports\ProductsImport;
use App\Imports\AdditionalFieldImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Product;
use App\Models\AdditionalField;
use App\Models\ProductImage;

class ImportController extends Controller
{
    public function showForm()
    {
        if (Product::exists()) {
            return redirect()->route("menu")->with("error", "You have already imported an excel file");
        }
        else {
            return view("import");
        }
    }

    public function import(Request $request)
    {
        if (Product::exists()) {
            return redirect()->route("menu")->with("error", "You have already imported an excel file");
        }
        
        $request->validate([
            "excel_file" => "required|file|mimes:xlsx,xls",
        ]);

        $file = $request->file("excel_file");
        Excel::import(new ProductsImport, $file);

        return redirect()->route("product.list");
    }
}
