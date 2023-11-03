<?php
namespace App\Imports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\WithCustomCsvSettings;

class ProductImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure, WithCustomCsvSettings
{
    use Importable, SkipsFailures;

    public $errors = [];
    public $data = [];
    private $columns;

    public function __construct($columns = [])
    {
        $this->columns = $columns;
    }

    public function model(array $row)
    {
        $this->data[] = $row;
        return new Product([
            "sell_id" => isset($row["sell_id"]) ? $row["sell_id"] : null,
            "co_name" => isset($row["co_name"]) ? $row["co_name"] : null,
            "coe_mobile" => isset($row["coe_mobile"]) ? $row["coe_mobile"] : null,
            "co_city" => isset($row["co_city"]) ? $row["co_city"] : null,
            "coe_name" => isset($row["coe_name"]) ? $row["coe_name"] : null,
            "coe_add" => isset($row["coe_add"]) ? $row["coe_add"] : null,
            "artc" => isset($row["artc"]) ? $row["artc"] : null,
            "packages" => isset($row["packages"]) ? $row["packages"] : null,
            "weight" => isset($row["weight"]) ? $row["weight"] : null
        ]);
    }

    public function rules(): array
{
    return [
        "sell_id" => "required",
        "co_name" => "required",
        "coe_mobile" => "required",
        "co_city" => "required",
        "coe_name" => "required",
        "coe_add" => "required",
        "artc" => "required",
        "packages" => "required",
        "weight" => "required"
    ];
}


    public function onFailure(Failure ...$failures)
    {
        foreach ($failures as $failure) {
            // Jika terdapat kesalahan pada kolom faktur
            if ($failure->attribute() == 'sell_id') {
                // Tambahkan baris data yang gagal ke array errors
                array_push($this->errors, $failure->values());
            }
        }
    }

    public function getCsvSettings(): array
{
    return [
        'input_encoding' => 'UTF-8',
        'delimiter' => "\t",
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'include_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
        'only_columns' => $this->columns,
    ];
}

}