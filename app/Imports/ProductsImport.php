<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\AdditionalField;
use App\Models\ProductImage;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

use Maatwebsite\Excel\Imports\HeadingRowFormatter;


class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $product = new Product([
            "external_code" => $row["UUID"],
            "name" => $row["Наименование"],
            "description" => $row["Описание"],
            "price" => str_replace(',', '.', $row["Цена: Цена продажи"]),
            "discount" => 0.0
        ]);

        $product->save();
        $photos = "";

        foreach ($row as $key => $value) {
            if (strpos($key, 'Доп. поле:') === 0) {
                $additionalKey = substr($key, strlen('Доп. поле: '));
                if ($additionalKey === "Ссылки на фото") {
                    $photos = $value;
                }
                AdditionalField::create([
                    'product_id' => $product->id,
                    'key' => $additionalKey,
                    'value' => $value === null ? "null" : $value
                ]);
            }
        }

        $photoUrls = explode(', ', $photos);

        foreach ($photoUrls as $url) {
            $url = trim($url);
            $response = Http::get($url);
            if ($response->successful()) {
                $extension = pathinfo($url, PATHINFO_EXTENSION);
                $filename = Str::uuid() . '.' . $extension;
                $path = 'images/' . $filename;
                Storage::put('public/' . $path, $response->body());

                ProductImage::create([
                    'product_id' => $product->id,
                    'url' => $url,
                    'path' => $path
                ]);
            }
        }

        return $product;
    }

}
