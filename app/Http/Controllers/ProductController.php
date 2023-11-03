<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Imports\ProductImport;
use Illuminate\Contracts\View\View;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use App\Exports\ProductsExport;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ProductController extends Controller
{
    public function getData(){
        $client = new Client();
        $response = $client->request('GET', 'http://localhost/app2/app/Http/Controllers/rider.json');
        $data = json_decode($response->getBody(), true);
    
        // ambil semua group dari data
        $groups = array_keys($data);
    
        // inisialisasi array untuk menyimpan data yang diambil
        $result = [];
    
        // loop melalui setiap group
        foreach ($groups as $group) {
            // loop melalui setiap item dalam group
            foreach ($data[$group] as $item) {
                // ambil value name, email, telephone, dan pin
                $name = $item['name'];
                $email = $item['email'];
                $telephone = $item['telephone'];
                $pin = $item['pin'];
    
                // simpan data ke dalam array result
                $result[] = [
                    'group' => $group,
                    'name' => $name,
                    'email' => $email,
                    'telephone' => $telephone,
                    'pin' => $pin
                ];
            }
        }
    
        // tampilkan view dan teruskan data result ke view
        return view('getdata', ['result' => $result]);
    }

    









    public function index(){
        return view("welcome", [
            "product"=>Product::all(),
        ]);
    }
    public function import(Request $request){
        
    
        // check if any data was successfully imported
        $successMessage = count($import->data) > 0 ? 'Data berhasil di import' : null;
    
        // check if admin cookie exists
        if (isset($_COOKIE['isAdmin'])) {
            // if admin cookie exists, redirect to admin page
            return redirect('/ops-blitz-ops')->with('success', $successMessage)->with('errors', $import->errors);
        } else {
            // if admin cookie does not exist, redirect to main page
            return redirect('/')->with('success', $successMessage)->with('errors', $import->errors);
        }
    }
    














    // public function export(){
    //     // cek apakah cookie admin ada
    //     if (isset($_COOKIE['isAdmin'])) {
    //         // jika cookie admin ada, eksekusi kode untuk mengekspor data
    //         return Excel::download(new ProductsExport, 'products.xlsx');
    //     } else {
    //         // jika cookie admin tidak ada, tampilkan pesan error
    //         return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    //     }
    // }
    public function export(){
        // cek apakah cookie admin ada
        if (isset($_COOKIE['isAdmin'])) {
            // jika cookie admin ada, eksekusi kode untuk mengekspor data
            $fileName = 'task-export-' . date('Y-m-d') . '-merapi.xlsx';
            return Excel::download(new ProductsExport, $fileName);
        } else {
            // jika cookie admin tidak ada, tampilkan pesan error
            return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }
    }
    
    
}