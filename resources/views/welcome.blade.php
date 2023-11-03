      <!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style type="text/css">
      td{
        font-size: 15px;
      }
    </style>
  </head>
  <body>
    @if (session()->has('success'))
        <div class="alert alert-success" role="alert">
            {{ session('success') }}
        </div>
    @endif

    @if (session('errors'))
        <div class="alert alert-danger">
            <ul>
                @foreach (session('errors') as $error)
                    <li>Faktur {{ $error['sell_id'] }} sudah ada di database</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="px-4 py-5 my-5 text-center">
        <img class="d-block mx-auto mb-4" src="{{asset("images/blitz.png")}}" alt="rideblitz" width="210" height="100">
        {{-- <h1 class="display-5 fw-bold text-body-emphasis">Laravel Excel.KASA</h1> --}}
        <div class="col-lg-6 mx-auto">
          <p class="lead mb-4">Masukan data pengiriman faktur melalui ekstensi excel</p>
          <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <button type="button" class="btn btn-success btn-lg px-4 gap-3" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Import</button>
            <button type="button" class="btn btn-info btn-lg px-4 gap-3"><a href="ops-blitz-ops/export" style="text-decoration: none">Export</a></button>
          </div>
        </div>
      </div>
      {{-- <div>
        <h1 style="text-decoration: underline;">SLOT: <span style="color:aquamarine;">NDS</span></h1>
      </div> --}}
      <table class="table mx-auto w-75">
        <thead>
          <tr>
            <th scope="col">Faktur</th>
            <th scope="col">Cabang</th>
            <th scope="col">Nama</th>
            <th scope="col">Nomor Telepon</th>
            <th scope="col">Kota</th>
            <th scope="col">Alamat</th>
          </tr>
        </thead>
        <tbody class="table-group-divider">
          @foreach($product as $item)
            <tr>
              <td>{{$item->sell_id}}</td>
              <td>{{$item->co_name}}</td>
              <td>{{$item->coe_name}}</td>
              <td>{{$item->coe_mobile}}</td>
              <td>{{$item->co_city}}</td>
              <td>{{$item->coe_add}}</td>
            </tr>
          @endforeach
        </tbody>
      </table>

        <!-- Modal -->
     <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Masukan data pengiriman Anda</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{route('product.import')}}" method="POST" enctype="multipart/form-data">
                      @csrf
                        <div class="form-group mb-1">
                            <label for="">Pilih file</label>
                            <input type="file" class="form-control" name="file">
                            <button class="btn btn-success mt-2" type="submit">Import</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
     </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>