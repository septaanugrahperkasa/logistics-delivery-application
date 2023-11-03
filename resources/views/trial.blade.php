            <!DOCTYPE html>
<html>
    <head>
        <title>SLOT TIME</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
        <style>
            .container{
                text-align: center;
                height: 100vh;
            }
            button, h1{
                margin: 0 .5rem;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h1>SLOT TIME</h1>
            <button type="button" class="btn btn-primary"><a href="dashboard?slot=NDS" style="color:wheat; text-decoration:none;">NDS</a></button>
            <button type="button" class="btn btn-success"><a href="?slot=SDS1" style="color:wheat; text-decoration:none;">SDS1</a></button>
            <button type="button" class="btn btn-danger"><a href="?slot=SDS2" style="color:wheat; text-decoration:none;">SDS2</a></button>
        </div>
        @foreach ($data as $result)
            <h1>{{ $result }}</h1>
        @endforeach
    </body>
</html>