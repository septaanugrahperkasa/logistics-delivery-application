            <!DOCTYPE html>
<html>
    <head>
        <title>Dashboard Rider {{$name}}</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <link rel="stylesheet" href="rider_dash.css">
    </head>
    <body>
        <div class="card">
            {{-- <div class="img">
              <img src="{{asset("images/just-logo-blitz-blue.jpeg")}}">
            </div> --}}
            <div class="infos">
              <div class="name">
                <h2>Rider {{$name}}</h2>
                {{-- <h4>Email: {{$email}}</h4> --}}
              </div>
              <h3 class="text">
                “Nama pengguna adalah <span class="span">{{$name}}</span> dan ia tergabung dalam grup <span class="span">{{$group}}</span>.”
              </h3>
              {{-- <a href="delivery?hub={{$group}}" class="hyper"><button type="button" class="btn btn-primary" id="go-button">GO</button></a> --}}
              <a href="delivery?hub=Kota Jakarta Barat" class="hyper"><button type="button" class="btn btn-primary" id="go-button">GO</button></a>
            </div>
          </div>
    </body>
</html>