<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Carbon\Carbon;


class ProductsExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return Product::all()->map(function ($product) {
            return [
                'sell_id' => $product->sell_id,
                'co_name' => $product->co_name,
                'coe_mobile' => $product->coe_mobile,
                'co_city' => $product->co_city,
                'coe_name' => $product->coe_name,
                'coe_add' => $product->coe_add,
                'artc' => $product->artc,
                'packages' => $product->packages,
                'weight' => $product->weight
            ];
        });
    }

    public function headings(): array
    {
        return [
            'sell_id',
            'co_name',
            'coe_mobile',
            'co_city',
            'coe_name',
            'coe_add',
            'artc',
            'packages',
            'weight'
        ];
    }
}