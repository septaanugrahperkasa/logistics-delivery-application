<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use App\Models\DBproduct;
use Mail;
use App\Mail\MailNotify;
use Illuminate\Http\Client\ConnectionException;



class RiderController extends Controller
{
    protected $data;
    public function __construct()
    {
        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI2MmNmZWY2NDQ4NGMxZTcwMTU0YjQ5YjIiLCJqdGkiOiIwYWQ3OGI1MTBmN2U0Yjg2NGVjOTgyYmFlNDZiZGQwMzhkODEwYjkyNDI0YWU1OTMyOTczN2U0Njc5MTIzMWZiYmY5Y2ZlNjg3Zjc4MzRjYSIsImlhdCI6MTY4Nzc4MDE5My4yNDA1OTcsIm5iZiI6MTY4Nzc4MDE5My4yNDA2MDQsImV4cCI6NDg0MzQ1Mzc5My4yMzc3NDYsInN1YiI6IjY0N2NiMzI1OTI4NmNkMTVjYzJlYjQxOCIsInNjb3BlcyI6W119.UiXvE6EzJnIj1rklZjtyiNJRQ0Mle1347KFdGl4VJaqP-pSl5jST_w8UULXGBeTTwhJJjEFetEUHS_6nUljXis8cxs1_a0cH3WB2iSbn3Yb2Ad_G1BL7cbQDdTIYtoxLXnv9J5-CRqdfMMkTqBLgu8HoJ4p3pC9S--Fneo3uVrzFqHo007Js68lnhrmYidthtrYW32EkTo95GZmnRJoHrdAa6iW6lKeANFzwSEZGm7jUhf_Ip6ykRxnBE6IKkofO6qEAH6RjrwkEj_b7rBEGKvhyJGRhKT-KDNku3oMgQYFwackozvCd8YqmVuAwuPwLxlLVIDwr7nKdMILesasjBT6kLhSX0l4Tft6OhB7rlGbA-mi1ZeLrv_PSpdrIaMwP9hWsnPpyM61WgoVDnMC3Va1xnFYCgbJcG7Ugy1s41po6vPBVk_q7McfgfQV4Z6f_XnlROUa0GomRSzOqU1hnENHKWc7UXcwag-V0tIlI9EnzGGD9VJTqqtC4EipV98A57LbuGwzB9Sn4uxuOautCpQBFu8uOm9LAqEtu5FNwNpcmXkJv-tamxaMU2azdcAJI9wLvUtVIsYbEVWMD7WIRqCHvlIiKZIkRd2t6-Vgc9N_1LwKvnBw731X9Wzav-QANNphGcgUhI5k7GOjqEZLUXf1wp5ep5jxU8IcxZeJ_aa0',
            'Cache-Control' => 'no-cache,private',
            'Content-Type' => 'application/json',
        ])->get('https://apiweb.mile.app/api/v3/hubs?fields=name');
        $this->data = $response->json();
    }
            //VALIDASI ENDPOINT
    // protected $data;
    // public function __construct()
    // {
    //     try {
    //         $response = Http::withHeaders([
    //             'Accept' => 'application/json',
    //             'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI2MmNmZWY2NDQ4NGMxZTcwMTU0YjQ5YjIiLCJqdGkiOiJjZWIxYzA3ZGIxMGVhZTg0NTExNjcxZGJkNGJiYTViMWJlOTBiZmQ0NzJjMTk5NTQzYTJiMWU2MWRlNzE3NDkxYmMzNjI0MTM4YWRiMDE2NiIsImlhdCI6MTY4NTg5NDYwMywibmJmIjoxNjg1ODk0NjAzLCJleHAiOjQ4NDE1NjgyMDMsInN1YiI6IjY0N2NiMzI1OTI4NmNkMTVjYzJlYjQxOCIsInNjb3BlcyI6W119.FP4orzupTqo6nfuPqlDVRILI-7IYZup_sEpydaT-n1i8rHffPRYHd2H4mbgCUDmCZyKilDFsFf-dl2_6UCe9PX-y2uhcg10P9IuR0hA23sLOKhAV-a8_y4NMJsLludOkp8vK_Y9ZOPrICW9OuYUrYRhX4p3xUIDn2VRHns0-xseAyVG0etedS5q9AtrfuYGZQ1HgDCGeAmAzycFSC4YB2ULN0B9XiOVmvY7uA5cWvP_KKat_FUF04Rl7LVBvpzb-R-aZfuzCZNjrVNU6Cd_6J_4mbA52NjrOVxo6hxFRauuxzjnyVs0TJwHTugm_pnTgB-2UJBRe_22kNIZAiawqRh3Sj9-f7bMQ-nQpWpEGUYqql4qUBtmk0UzNole3ZvFZEEqHAGrWqy34N5VbipxlbsMdRSpc8-_SZRo3uhFWKzFgHXZpgTLPILNpGlG07NXBLS0Ifog0WEK9lxxJR0r1mZ74UWf9VgGh_l5Bf8v8T9uWxbeD4ISqSSS0PkPNyQH35DpUlWEt06VnOfH_6jg-KaNe5-bn5bhl4nnWZuNIYI6bMVVpgYTqjMFpFF9S3PHsysJ_sshLDBe4bxXVcLN_KX0JlhVOVFvRYw3d8Rt9z9YvkkfUhINS22DTDSj6Y2V8Z5pZtxFeZbM8XNfOtrFYvSxdKI0D8LXeOsi1ELxTNbI',
    //             'Cache-Control' => 'no-cache,private',
    //             'Content-Type' => 'application/json',
    //         ])->get('https://apiweb.mile.app/api/v3/hubs?fields=name');

    //         $this->data = $response->json();
    //     } catch (ConnectionException $e) {
    //         // tampilkan pesan lain atau hiraukan saja
    //     }
    // }


            //REGISTER
    public function register(Request $request){
        // buat 4 digit PIN secara acak
        $pin = rand(1000, 9999);
    
        $hubs = array_values(array_filter($request->input('hubs')));
    
        $data = [
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'telephone' => $request->input('telephone'),
            'hubs' => $hubs,
            'pin' => $pin
        ];
    
        $filePath = __DIR__ .'/rider.json';
    
        // cek apakah file rider.json sudah ada
        if (file_exists($filePath)) {
            // jika file sudah ada, baca data lama dari file
            $oldData = json_decode(file_get_contents($filePath), true);
            // cek apakah data lama adalah sebuah array
            if (is_array($oldData)) {
                // cek apakah email yang diinput sudah terdaftar di salah satu hub yang dipilih
                $emailRegistered = false;
                foreach ($hubs as $hub) {
                    if (isset($oldData[$hub])) {
                        foreach ($oldData[$hub] as $rider) {
                            if ($rider['email'] == $data['email']) {
                                // jika email sudah terdaftar di salah satu hub yang dipilih, tampilkan pop up informasi
                                return redirect()->back()->with('error', 'Email yang Anda masukan sudah terdaftar');
                            }
                        }
                    }
                }
                // jika email belum terdaftar di salah satu hub yang dipilih, lanjutkan proses penyimpanan data
                // cek apakah setiap hubs yang dipilih sudah ada di dalam array
                foreach ($hubs as $hub) {
                    if (isset($oldData[$hub])) {
                        // jika hubs yang dipilih sudah ada di dalam array, tambahkan data baru ke array tersebut
                        array_push($oldData[$hub], [
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'telephone' => $data['telephone'],
                            'pin' => $data['pin']
                        ]);
                    } else {
                        // jika hubs yang dipilih belum ada di dalam array, tambahkan data baru ke array tersebut
                        $oldData[$hub] = [[
                            'name' => $data['name'],
                            'email' => $data['email'],
                            'telephone' => $data['telephone'],
                            'pin' => $data['pin']
                        ]];
                    }
                }
                // simpan data gabungan ke file
                file_put_contents($filePath, json_encode($oldData));
            } else {
                // jika data lama bukan sebuah array, simpan data baru ke file
                $newData = [];
                foreach ($hubs as $hub) {
                    $newData[$hub] = [[
                        'name' => $data['name'],
                        'email' => $data['email'],
                        'telephone' => $data['telephone'],
                        'pin' => $data['pin']
                    ]];
                }
                file_put_contents($filePath, json_encode($newData));
            }
        } else {
            // jika file belum ada, simpan data baru ke file
            $newData = [];
            foreach ($hubs as $hub) {
                $newData[$hub] = [[
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'telephone' => $data['telephone'],
                    'pin' => $data['pin']
                ]];
            }
            file_put_contents($filePath, json_encode($newData));
        }
    
        // kirim email ke user dengan data yang telah disimpan
        // Mail::to($data['email'])->send(new MailNotify([
        //     "title" => "Mail from BLITZ ELECTRIC",
        //     "body" => "Thank you for registering with BLITZ ELECTRIC. Your PIN is: " . $pin,
        //     "hubs" => implode(", ",$hubs),
        //     "name" =>$data['name']
        // ]));
        Mail::to($data['email'])->send(new MailNotify([
            "title" => "Email dari BLITZ ELECTRIC",
            "body" => "Terima kasih telah mendaftar di BLITZ ELECTRIC. PIN Anda adalah: " . $pin,
            "hubs" => implode(", ",$hubs),
            "name" =>$data['name']
        ]));
        
    
        // kembalikan pesan sukses beserta PIN yang dibuat
        return redirect()->back()->with('success', 'PIN Anda akan dikirimkan melalui email!');
    }                
                //ENDPOINT RIDER JSON
    // public function register(Request $request){
    //     // buat 4 digit PIN secara acak
    //     $pin = rand(1000, 9999);
    
    //     $hubs = array_values(array_filter($request->input('hubs')));
    
    //     $data = [
    //         'name' => $request->input('name'),
    //         'email' => $request->input('email'),
    //         'telephone' => $request->input('telephone'),
    //         'hubs' => $hubs,
    //         'pin' => $pin
    //     ];
    
    //     // simpan data ke file rider.json pada server yang berbeda
    //     $newData = [];
    //     foreach ($hubs as $hub) {
    //         $newData[$hub] = [[
    //             'name' => $data['name'],
    //             'email' => $data['email'],
    //             'telephone' => $data['telephone'],
    //             'pin' => $data['pin']
    //         ]];
    //     }
    //     $ch = curl_init();
    //     curl_setopt($ch, CURLOPT_URL, 'http://localhost/app2/app/Api/Rider/save.php');
    //     curl_setopt($ch, CURLOPT_POST, 1);
    //     curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query(['data' => json_encode($newData)]));
    //     curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //     $response = curl_exec($ch);
    //     curl_close($ch);
    
    //     // kembalikan pesan sukses beserta PIN yang dibuat
    //     return redirect()->back()->with('success', 'PIN Anda akan dikirimkan melalui email!');
    // }
            //LOGIN
    public function getLogin(){
        $client = new Client();
        $response = $client->request('GET', 'http://localhost/app2/app/Http/Controllers/rider.json');
        $data = json_decode($response->getBody(), true);
    
        // ambil semua group dari data
        $groups = array_keys($data);
    
        // tampilkan view dan teruskan data group ke view
        return view('login', ['groups' => $groups]);
    }
            //LOGIN
    // public function login(Request $request){
    //     $client = new Client();
    //     $response = $client->request('GET', 'http://localhost/app2/app/Http/Controllers/rider.json');
    //     $data = json_decode($response->getBody(), true);
    
    //     // gabungkan nilai dari setiap digit PIN yang dimasukkan oleh pengguna
    //     $pin = $request->input('digit1') . $request->input('digit2') . $request->input('digit3') . $request->input('digit4');
    
    //     // cek apakah pengguna telah memilih hub
    //     $selectedHub = $request->input('hubs');
    //     // $selectedHub = "MUP_JK1";
    //     if (empty($selectedHub)) {
    //         // jika pengguna belum memilih hub, tampilkan pesan error
    //         return redirect()->back()->with('error', 'Masukan HUB Anda!');
    //     }
    
    //     // cek apakah PIN yang dimasukkan oleh pengguna ada di dalam data
    //     $found = false;
    //     foreach ($data as $hub => $riders) {
    //         if ($hub == $selectedHub) {
    //             foreach ($riders as $rider) {
    //                 if ($rider['pin'] == $pin) {
    //                     // jika PIN ditemukan, tampilkan data rider
    //                     // echo 'Hub: ' . $hub . '<br>';
    //                     // echo 'Nama: ' . $rider['name'] . '<br>';
    //                     // echo 'Email: ' . $rider['email'] . '<br>';
    //                     // echo 'Telepon: ' . $rider['telephone'] . '<br>';
    //                     // echo '<br>';
    //                     // $found = true;
                        
    //                     // set session untuk menyimpan data rider yang berhasil login
    //                     session([
    //                         'isLoggedIn' => true,
    //                         'group' => $hub,
    //                         'name' => $rider['name'],
    //                         'email' => $rider['email']
    //                     ]);
                        
    //                     // generate random string untuk digunakan sebagai parameter
    //                     $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    //                     $randomString = substr(str_shuffle($permitted_chars), 0, 16);
                        
    //                     // set cookie untuk menyimpan data rider yang berhasil login
    //                     setcookie('isLoggedIn', true, time() + (86400 * 30), "/");
    //                     setcookie('email', $rider['email'], time() + (86400 * 30), "/");
                        
    //                     // redirect ke halaman dashboard dengan parameter random string
    //                     return redirect('/dashboard?rider=' . urlencode($randomString));
    //                 }
    //             }
    //         }
    //     }
    
    //     if (!$found) {
    //         // jika PIN tidak ditemukan atau tidak cocok dengan hub yang dipilih, tampilkan pesan error
    //         return redirect()->back()->with('error', 'Akun belum terdaftar!');
    //     }
    // }
    public function login(Request $request){
        $group = Session::get('group');


        $client = new Client();
        $response = $client->request('GET', 'http://localhost/app2/app/Http/Controllers/rider.json');
        $data = json_decode($response->getBody(), true);
    
        // gabungkan nilai dari setiap digit PIN yang dimasukkan oleh pengguna
        $pin = $request->input('digit1') . $request->input('digit2') . $request->input('digit3') . $request->input('digit4');
    
        // cek apakah PIN yang dimasukkan adalah PIN admin
        $adminPin = '2019';
        if ($pin == $adminPin) {
            // jika PIN yang dimasukkan adalah PIN admin, set cookie admin dan redirect ke halaman admin
            setcookie('isAdmin', true, time() + (86400 * 30), "/");
            return redirect('/ops-blitz-ops');
        }

        // cek apakah request berasal dari URL yang diinginkan
        // if ($request->fullUrl() == "http://127.0.0.1:8000/delivery") {
        //     // lakukan sesuatu jika request berasal dari URL pertama
        //     return view("");
        // }

        // cek apakah pengguna telah memilih hub
        $selectedHub = $request->input('hubs');
        // $selectedHub = "MUP_JK1";
        if (empty($selectedHub)) {
            // jika pengguna belum memilih hub, tampilkan pesan error
            return redirect()->back()->with('error', 'Masukan HUB Anda!');
        }
    
        // cek apakah PIN yang dimasukkan oleh pengguna ada di dalam data
        $found = false;
        foreach ($data as $hub => $riders) {
            if ($hub == $selectedHub) {
                foreach ($riders as $rider) {
                    if ($rider['pin'] == $pin) {
                        // jika PIN ditemukan, tampilkan data rider
                        // echo 'Hub: ' . $hub . '<br>';
                        // echo 'Nama: ' . $rider['name'] . '<br>';
                        // echo 'Email: ' . $rider['email'] . '<br>';
                        // echo 'Telepon: ' . $rider['telephone'] . '<br>';
                        // echo '<br>';
                        // $found = true;
                        
                        // set session untuk menyimpan data rider yang berhasil login
                        session([
                            'isLoggedIn' => true,
                            'group' => $hub,
                            'name' => $rider['name'],
                            'email' => $rider['email']
                        ]);
                        
                        // generate random string untuk digunakan sebagai parameter
                        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                        $randomString = substr(str_shuffle($permitted_chars), 0, 16);
                        
                        // set cookie untuk menyimpan data rider yang berhasil login
                        setcookie('isLoggedIn', true, time() + (86400 * 30), "/");
                        setcookie('email', $rider['email'], time() + (86400 * 30), "/");
                        
                        // redirect ke halaman dashboard dengan parameter random string
                        // return redirect('/delivery?rider=' . urlencode($randomString));
                        return redirect("/delivery");
                }
            }
        }
    
        if (!$found) {
            // jika PIN tidak ditemukan atau tidak cocok dengan hub yang dipilih, tampilkan pesan error
            return redirect()->backd()->with('error', 'Akun belum terdaftar!');
        }
        }
    }


            //DELIVERY
    public function delivery(Request $request){
        // cek apakah pengguna sudah masuk
        if (!Session::has('isLoggedIn')) {
            // jika pengguna belum masuk, redirect ke halaman login
            return redirect('/login');
        }

        $hub = $request->input("hub");
        $slot = $request->input("slot");
        $outlet = $request->input("outlet");
    
        $user = Session::get('name');
        $group = Session::get('group');
        $email = Session::get('email');
        $found = false;
        $hubId = '';
        foreach ($this->data['data'] as $item) {
            if (isset($item['name']) && $item['name'] == $request->input('hub')) {
                $found = true;
                // $name = $item['name'];
                $hubId = $item['_id'];
                break;
            }            
        }
    
        if ($found) {
            // ambil data produk dari database berdasarkan hub
            $products = Product::where('co_city', $hub)->get();
            if ($outlet) {
                // $products = Product::where('sell_id', $outlet)->get();
                $products = Product::where('sell_id', 'LIKE', "%$outlet%")->get();
            }
    
            if ($products->isEmpty()) {
                // echo "Tidak ada faktur yang cocok ditemukan";
                return view('delivery', [
                    "slot" => $slot,
                    "group" => $group,
                    "hubId" => $hubId,
                    "email" => $email,
                    "message" => "“Tidak tersedia faktur: ".$outlet." untuk wilayah: ".$hub." pada slot: ".$slot.".”",
                    "key" => false,
                ]);
            } else {
                $results = collect();
                if ($slot) {
                    foreach ($products as $product) {
                        $hour = $product->updated_at->hour;
                        if ($hour >= 17 || $hour < 11) {
                            if ($slot == 'NDS') {
                                $results[] = $product;
                            }
                        } else if ($hour >= 11 && $hour < 14) {
                            if ($slot == 'SDS1') {
                                $results[] = $product;
                            }
                        } else {
                            if ($slot == 'SDS2') {
                                $results[] = $product;
                            }
                        }
                    }
    
                    if ($results->isEmpty()) {
                        // echo "Silakan pilih hub";
                        return view('delivery', [
                            "slot" => $slot,
                            "group" => $group,
                            "hubId" => $hubId,
                            "email" => $email,
                            "message" => "“Faktur untuk wilayah: ".$hub." pada slot: ".$slot." telah habis.”",
                            "key" => false,
                        ]);
                    } else {
                        $shift = ["NDS", "SDS1", "SDS2"];
                        if (in_array($slot, $shift)) {
                            return view('delivery', [
                                "data" => isset($results) ?$results : null,
                                "slot" => $slot,
                                "group" => $group,
                                "hubId" => $hubId,
                                "email" => $email,
                                "key" => true,
                            ]);
                        }
                    }
                } else {
                    // echo "Silakan pilih slot";
                    return view('delivery', [
                        "slot" => $slot,
                        "group" => $group,
                        "hubId" => $hubId,
                        "email" => $email,
                        "message" => "“Harap memilih slot waktu yang tersedia untuk memulai proses pengiriman.”",
                        "key" => false,
                    ]);
                }
            }
        } else {
            // echo "HOME PAGE";
            return view('delivery', [
                "hub" => $hub,
                "slot" => $slot,
                "group" => $group,
                "hubId" => $hubId,
                "email" => $email,
                "message" => "“Halo Rider: {$user}, Anda tergabung dalam grup: {$group} BLITZ. Teruslah bersemangat. Terima kasih atas kerja sama Anda.”",
                "key" => false,
            ]);
        }
    }


            //STORE TO ENDPOINT
    public function store(Request $request){
        // cek apakah pengguna sudah masuk
        if (!Session::has('isLoggedIn')) {
            // jika pengguna belum masuk, redirect ke halaman login
            return redirect('/login');
        }

        $fakturs = $request->input('fakturs');
        foreach($fakturs as $faktur){
            $product = Product::where('sell_id', $faktur)->first();
            if ($product){
                $response = Http::withHeaders([
                    'Accept' => 'application/json',
                    'Authorization' => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI2MmNmZWY2NDQ4NGMxZTcwMTU0YjQ5YjIiLCJqdGkiOiIwYWQ3OGI1MTBmN2U0Yjg2NGVjOTgyYmFlNDZiZGQwMzhkODEwYjkyNDI0YWU1OTMyOTczN2U0Njc5MTIzMWZiYmY5Y2ZlNjg3Zjc4MzRjYSIsImlhdCI6MTY4Nzc4MDE5My4yNDA1OTcsIm5iZiI6MTY4Nzc4MDE5My4yNDA2MDQsImV4cCI6NDg0MzQ1Mzc5My4yMzc3NDYsInN1YiI6IjY0N2NiMzI1OTI4NmNkMTVjYzJlYjQxOCIsInNjb3BlcyI6W119.UiXvE6EzJnIj1rklZjtyiNJRQ0Mle1347KFdGl4VJaqP-pSl5jST_w8UULXGBeTTwhJJjEFetEUHS_6nUljXis8cxs1_a0cH3WB2iSbn3Yb2Ad_G1BL7cbQDdTIYtoxLXnv9J5-CRqdfMMkTqBLgu8HoJ4p3pC9S--Fneo3uVrzFqHo007Js68lnhrmYidthtrYW32EkTo95GZmnRJoHrdAa6iW6lKeANFzwSEZGm7jUhf_Ip6ykRxnBE6IKkofO6qEAH6RjrwkEj_b7rBEGKvhyJGRhKT-KDNku3oMgQYFwackozvCd8YqmVuAwuPwLxlLVIDwr7nKdMILesasjBT6kLhSX0l4Tft6OhB7rlGbA-mi1ZeLrv_PSpdrIaMwP9hWsnPpyM61WgoVDnMC3Va1xnFYCgbJcG7Ugy1s41po6vPBVk_q7McfgfQV4Z6f_XnlROUa0GomRSzOqU1hnENHKWc7UXcwag-V0tIlI9EnzGGD9VJTqqtC4EipV98A57LbuGwzB9Sn4uxuOautCpQBFu8uOm9LAqEtu5FNwNpcmXkJv-tamxaMU2azdcAJI9wLvUtVIsYbEVWMD7WIRqCHvlIiKZIkRd2t6-Vgc9N_1LwKvnBw731X9Wzav-QANNphGcgUhI5k7GOjqEZLUXf1wp5ep5jxU8IcxZeJ_aa0',
                    'Cache-Control' => 'no-cache,private',
                    'Content-Type' => 'application/json'
                ])->post('https://apiweb.mile.app/api/v3/tasks/bulk', [
                    "tasks" => [
                        [
                            'hubId' => $request->input('hubId'),
                            'flow' => 'Merapi',
                            'assignee' => $request->input('assignee'),
                            'title' => $faktur,
                            'content' => $product->co_name,
                            'label' =>  $product->coe_name,
                        ],
                    ]
                ]);
                echo $response;
                
                // hapus produk dari database
                $product->delete();
            }
        }
    }
}