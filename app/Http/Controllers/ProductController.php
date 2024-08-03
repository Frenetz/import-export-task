<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\AdditionalField;
use App\Models\ProductImage;

class ProductController extends Controller
{
    public function showProductCard($id)
    {
        if (!Product::exists()) {
            return redirect()->route("menu")->with("error", "You didn't import an excel file");
        }
        $product = Product::find($id);
        $additional_fields = AdditionalField::where('product_id', $id)->get();
        $product_images = ProductImage::where('product_id', $id)->get();

        return view("product-card")->with("product", $product)->with("additional_fields", $additional_fields)->with("product_images", $product_images);
    }

    public function showProducts()
    {
        if (!Product::exists()) {
            return redirect()->route("menu")->with("error", "You didn't import an excel file");
        }
        $products = Product::all();

        return view("products")->with("products", $products);
    }

    public function deleteAllProducts()
    {
        if (Product::exists()) {
            ProductImage::query()->delete();
            AdditionalField::query()->delete();
            Product::query()->delete();

            $files = Storage::disk('public')->files('images');
            foreach ($files as $file) {
                Storage::disk('public')->delete($file);
            }

            DB::statement('ALTER TABLE products AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE additional_fields AUTO_INCREMENT = 1');
            DB::statement('ALTER TABLE product_images AUTO_INCREMENT = 1');

            return redirect()->route("menu")->with("success", "You have successfully deleted all products");
        }
        else {
            return redirect()->route("menu")->with("error", "You didn't import an excel file");
        }
    }
}
