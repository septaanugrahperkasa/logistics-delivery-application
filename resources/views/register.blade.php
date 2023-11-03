<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Join with BLITZ</title>
    <link rel="stylesheet" href="rider_reg.css">
        <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   </head>
    <body>
        <div class="wrapper">
            <form action="/register" method="POST">
            @csrf
                <div class="box">
                    <div class="title">
                        <h2>BLITZ ELECTRIC</h2>
                    </div>
                    <div class="container">
                        <div class="select-btn">
                            <span class="btn-text">HUBS</span>
                            <span class="arrow-dwn">
                                <i class="fa-solid fa-chevron-down"></i>
                            </span>
                        </div>
                        <ul class="list-items">
                            <li class="item">
                                <input type="hidden" name="hubs[]" value="">
                                <label>
                                    <span class="checkbox">
                                        <i class="fa-solid fa-check check-icon"></i>
                                    </span>
                                    <span class="item-text">GRAB MERCHANT</span>
                                </label>
                            </li>
                        </ul>                        
                    </div><div class="clear"></div>
                </div>
                
                <div class="input-box">
                    <input type="text" name="name" placeholder="Enter your name" required>
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-box">
                    <input type="number" name="telephone" placeholder="Enter your telephone" required>
                </div>
                <div class="input-box button">
                    <input type="Submit" value="Go with BLITZ">
                </div>
                <div class="text">
                    <h3>Already have an account? <a href="/login">Login now</a></h3>
                </div>
                @if (session('success'))
                    <div class="alert alert-success text" style="text-align: center;">
                        <h3 style="color: #5a7bd3">{{ session('success') }}</h3>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-success text" style="text-align: center;">
                        <h3 style="color: #e13c3c">{{ session('error') }}</h3>
                    </div>
                @endif
            </form>
        </div>
        <!-- JavaScript -->
    <script src="rider_reg.js"></script>
    </body>
</html>