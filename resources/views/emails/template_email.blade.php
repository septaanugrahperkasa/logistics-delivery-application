{{-- <!DOCTYPE html>
<html>
<head>
    <title>{{ $mailData['title'] }}</title>
</head>
<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['body'] }}</p>
    <p>Name: {{ $mailData['name'] }}</p>
    <p>Hubs: {{ $mailData['hubs'] }}</p>
</body>
</html> --}}
<!DOCTYPE html>
<html>
<head>
    <title>{{ $mailData['title'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .logo {
            display: block;
            margin-bottom: 20px;
        }
        .content {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 5px;
        }
        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <img src="https://www.rideblitz.com/wp-content/uploads/2019/08/Blitz-Logo-copy-1024x409.png" alt="BLITZ ELECTRIC" class="logo" style="width: 50%">
        <div class="content">
            <p>Dear {{ $mailData['name'] }},</p>
            <p>{{ $mailData['body'] }}</p>
            <p>You have registered for the following hubs:</p>
            <ul>
                @foreach (explode(", ", $mailData['hubs']) as $hub)
                    <li>{{ $hub }}</li>
                @endforeach
            </ul>
            <p>Thank you for choosing BLITZ ELECTRIC.</p>
        </div>
        <div class="footer">
            © {{ date('Y') }} BLITZ ELECTRIC. All rights reserved.
        </div>
    </div>
</body>
</html>
