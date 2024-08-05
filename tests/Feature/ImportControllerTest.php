<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Product;
use App\Models\AdditionalField;
use App\Models\ProductImage;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Schema;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductsImport;

class ImportControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test_import_form_is_displayed()
    {
        $response = $this->get(route('import.form'));

        $response->assertStatus(200);
        $response->assertViewIs('import');
    }

    public function test_import_validation()
    {
        $response = $this->post(route('import.process'), [
            'excel_file' => UploadedFile::fake()->create('invalid_file.txt', 100),
        ]);

        $response->assertSessionHasErrors('excel_file');
    }

    public function test_user_can_import_products()
    {
        Excel::fake();
        Storage::fake('public');

        $file = new UploadedFile(
            base_path('tests/fixtures/test_products.xlsx'),
            'test_products.xlsx',
            'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            null,
            true
        );

        $response = $this->post(route('import.process'), [
            'excel_file' => $file,
        ]);

        Excel::assertImported('test_products.xlsx', function (ProductsImport $import) {
            return true;
        });

        $response->assertRedirect(route('product.list'));
    }

    public function test_user_cannot_import_if_already_imported()
    {
        Product::factory()->create();

        $file = new UploadedFile(base_path('tests/fixtures/test_products.xlsx'), 'test_products.xlsx');

        $response = $this->post(route('import.process'), [
            'excel_file' => $file,
        ]);

        $response->assertRedirect(route('menu'));
        $response->assertSessionHas('error', 'You have already imported an excel file');
    }

}
