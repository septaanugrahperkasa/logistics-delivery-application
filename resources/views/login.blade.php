<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>OTP Verification Form</title>
    <link rel="stylesheet" href="rider_log.css" />
      <!-- Boxicons CSS -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
      <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  </head>
  <body>
    {{-- @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    @if ($errors->any())
        <div class="alert alert-danger">
            {{ $errors->first() }}
        </div>
    @endif --}}
    {{-- <div class="container"> --}}
    {{-- <form method="POST" action="/login">
      @csrf --}}
    


    <div class="container">
      <form method="POST" action="/login">
        @csrf
        <div class="form">
      <h4>Enter Your PIN</h4>
      
        <div class="input-field">
            <input type="number" name="digit1" />
            <input type="number" name="digit2" disabled />
            <input type="number" name="digit3" disabled />
            <input type="number" name="digit4" disabled />
        </div>
        <button>BLITZ</button>
        <div class="text">
          <h3>Let’s join? <a href="/register">Register now</a></h3>
        </div>
        @if (session('error'))
            <div class="alert alert-success text" style="text-align: center">
                {{ session('error') }}
            </div>
        @endif
        </div>
        


        <div class="box">
          <div class="title">
              <h2>RIDEBLITZ</h2>
          </div>
          <div class="container-top">
              <div class="select-btn">
                  <span class="btn-text">HUBS</span>
                  <span class="arrow-dwn">
                      <i class="fa-solid fa-chevron-down"></i>
                  </span>
              </div>
              <ul class="list-items">
                <input type="hidden" name="hubs" value="" class="hubs">
                @foreach ($groups as $group)
                  <li class="item">
                    {{-- <input type="hidden" name="hub" value="{{$group}}">
                    <input type="text" name="hub" value=""> --}}

                    <label>
                        <span class="checkbox">
                            <i class="fa-solid fa-check check-icon"></i>
                        </span>
                        <span class="item-text">{{$group}}</span>
                    </label>
                  </li>
                @endforeach
              </ul>                        
          </div><div class="clear"></div>
      </div>
    </form>
    </div>
  
    <script src="rider_log.js"></script>
  </body>
</html>
