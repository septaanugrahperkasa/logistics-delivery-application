      <!DOCTYPE html>
<html lang="en" >
  <head>
    <meta charset="UTF-8">
    <title>CodePen - multi step form</title>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css'>
    <link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;800;900&amp;display=swap'><link rel="stylesheet" href="./style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </head>
  <body>
    <div>
      <form method="POST" action="http://127.0.0.1:8000/delivery">
        <input type="text" value="delivery?hub={{$group}}&slot={{$shift}}" class="url">
          <input type="text" class="outlet" placeholder="search your outlet" name="outlet">
          <button type="button" class="findOutlet">Search</button>
      </form>
    </div>  




    <div class="container-fluid-md mt-2">
        <div class="row justify-content-center">
          <div class="col-12 col-md-10 col-lg-8">
            <form id="msform" method="POST" action="/store">
                @if($key === true)
                  @csrf
                  <fieldset class="rounded">
                  <input type="hidden" name="hubId" value="{{ $hubId }}">
                  <input type="hidden" name="assignee[]" value="{{ $email }}">

                  @if (isset($message))
                      <h3 class="fs-title">{{ $message }}</h3>
                  @else
                      <h3 class="fs-title">FAKTUR HUB: {{$group}}</h3>
                  @endif
                @endif

                <div class="container">



                  {{-- <form method="POST" action="/kasa">
                    <input type="text" id="sell_id" placeholder="search your faktur" value="">
                    <button type="submit" id="search_button">Search</button>
                  </form> --}}

                  
                  
                  

                    <h1>SLOT TIME</h1>
                    <button type="button" class="btn btn-primary"><a href="delivery?hub={{$hub}}&slot=NDS" style="color:wheat; text-decoration:none;">NDS</a></button>
                    <button type="button" class="btn btn-success"><a href="delivery?hub={{$hub}}&slot=SDS1" style="color:wheat; text-decoration:none;">SDS1</a></button>
                    <button type="button" class="btn btn-danger"><a href="delivery?hub={{$hub}}&slot=SDS2" style="color:wheat; text-decoration:none;">SDS2</a></button>
                </div>
              
                @if($key === true)
                  <div class="box">
                      @foreach ($data as $result)
                        <div class="form-check">
                          <input class="form-check-input" type="checkbox" name="fakturs[]" value="{{$result["sell_id"]}}" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                            {{-- {{$result['sell_id']}} [{{$result["coe_name"]}}]  ({{$result['co_city']}}) --}}
                            {{$result->sell_id}}
                          </label>
                        </div>
                      @endforeach
                  </div>

                  @if (!isset($message))
                    <button type="submit" name="next" class="next rounded btn btn-md My-Button-see-live px-5 p-2">SEND</button>
                  @else
                    <button type="button" name="previous" class="previous rounded btn btn-md My-Button-see-live-2 px-4 p-2 m-md-0 my-2"><a href="dashboard" style="text-decoration: none">BACK</a></button>
                  @endif

                @elseif($key == "keys")
                <div class="box">
                  <h1>Kami ucapkan selamat datang di BLITZ, di mana Anda akan menjadi bagian penting dari tim pengiriman logistik kami.</h1>
                </div>
                @else
                  <div class="box">
                    <h1>Terima kasih banyak atas pengiriman yang cepat dan tepat waktu. Saya sangat menghargai kerja keras Anda.</h1>
                  </div>
                @endif
              </fieldset>
            </form>
          </div>
        </div>
      </div>


      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js" integrity="sha512-0QbL0ph8Tc8g5bLhfVzSqxe9GERORsKhIn1IrpxDAgUsbBGz/V7iSav2zzW325XGd1OMLdL4UiqRJj702IeqnQ==" crossorigin="anonymous"></script>
      {{-- <script>
        $('.next').click(function() {
          if ($('input[type="checkbox"]').is(':checked')) {
            // window.location.href = 'http://127.0.0.1:8000/find';
          } else {
              alert('error');
          }
      });
    </script> --}}
    <script>
      document.querySelector('.next').addEventListener('click', (event) => {
          // cek apakah setidaknya satu kotak centang telah dipilih
          const checkboxes = document.querySelectorAll('input[type=checkbox]');
          let isChecked = false;
          checkboxes.forEach(checkbox => {
              if (checkbox.checked) {
                  isChecked = true;
              }
          });
          
          if (!isChecked) {
              // jika tidak ada kotak centang yang dipilih, tampilkan pesan error dan batalkan pengiriman formulir
              event.preventDefault();
              alert('Masukan faktur Anda, untuk memulai pengiriman');
          }
      });
  </script>
  <script>
      // ambil elemen dengan class time
      let timeElement = document.querySelector('.time');
  
      // ambil semua elemen dengan class btn
      let buttons = document.querySelectorAll('.btn');
  
      // tambahkan event listener untuk setiap tombol
      buttons.forEach(function(button) {
          button.addEventListener('click', function() {
              // ambil teks dari tombol yang ditekan
              let buttonText = button.textContent;
  
              // ubah teks dari elemen dengan class time
              // alert(buttonText);
              timeElement.value = buttonText;
          });
      });
  </script>
  <script>
    document.querySelector(".findOutlet").addEventListener("click", function() {
      // mengambil nilai dari input
      var userInput = document.querySelector(".outlet").value;
      var url = document.querySelector(".url").value;

      // redirect ke URL dengan parameter berdasarkan user input
      window.location.href = url+"&outlet=" + encodeURIComponent(userInput);
  });
  </script>
  </body>
</html>
<?php
// if (!isset($_COOKIE['canAccessDelivery'])) {
//     // jika cookie tidak ada atau tidak valid, redirect ke halaman login
//     return redirect('/login');
// }
