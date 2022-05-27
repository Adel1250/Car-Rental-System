<!DOCTYPE html>
<html lang="en">

<head>
    <title>Search for a car</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: linear-gradient(120deg, #2980b9, #8e44ad);
            height: 100vh;
            overflow: hidden;
        }

        .center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            background: white;
            border-radius: 10px;
        }

        .center h1 {
            text-align: center;
            padding: 0 0 20px 0;
            border-bottom: 1px solid silver;
        }

        .center form {
            padding: 0 40px;
            box-sizing: border-box;
        }

        .txt_field {
            position: relative;
            border-bottom: 2px solid #adadad;
            margin: 30px 0;
            width: 100%;
            padding: 0 5px;
            height: 40px;
            font-size: 16px;
            border: 1.5px solid;
        }

        button[type="submit"] {
            width: 100%;
            height: 50px;
            border: 1px solid;
            background: #2691d9;
            border-radius: 25px;
            font-size: 18px;
            color: #e9f4fb;
            font-weight: 700;
            cursor: pointer;
            outline: none;
        }

        button[type="submit"]:hover {
            border-color: #2691d9;
            transition: -5s;
        }

        .signup_link {
            text-align: center;
            font-weight: bold;
        }

        .signup_link a {
            margin: 30px 0;
            text-align: center;
            font-size: 16px;
            color: #2691d9;
            text-decoration: none;
        }

        nav {
            height: 40px;
            width: 100%;
        }

        .dropdown {
            margin: auto;
        }

        label.logo {
            font-family: sans-serif;
            color: white;
            font-size: 30px;
            line-height: 50px;
            padding: 0 10px;
            font-weight: bold;
        }

        nav ul {
            float: right;
            margin-right: 30px;
            margin: 0;
            padding: 0;
        }

        nav ul li {
            display: inline-block;
            position: relative;
            list-style: none;
        }

        nav ul li a {
            color: white;
            font-size: 17px;
            text-transform: uppercase;
            display: block;
            padding: 0 15px;
            text-decoration: none;
            line-height: 60px;
        }

        a {
            cursor: pointer;
        }

        nav ul ul a {
            cursor: pointer;
        }

        a:hover {
            background: #2980b9;
            transition: .5s;
        }

        nav ul ul {
            position: absolute;
            top: 60px;
            display: none;
            padding: 0;
            margin: 0;
        }

        nav ul li:hover>ul {
            display: block;
            z-index: 100;

        }

        nav ul ul li {
            width: 100px;
            float: none;
            display: list-item;
            position: relative;
        }

        nav ul ul ul li {
            position: relative;
            top: -60px;
            left: 100px;
        }
    </style>
</head>

<body>
    <div class="dropdown">
        <nav>
            <label class="logo"><em>Welcome {{session('username')}}</em></label>
            <ul>
                <li><a href="/">Home</a>
                <li><a>Reservations <i class="fas fa-caret-down"></i></a></a>
                    <ul>
                        <li><a href="reservations">Current</a></li>
                        <li><a href="pay">Pay</a></li>
                        <li><a href="returnCar">Return</a></li>
                    </ul>
                </li>
                <li><a href="logout">Logout</a>
            </ul>
        </nav>
    </div>
    <div class="center">
        <h1>Searching for a car?</h1>
        <form action='getCarSearchInfo' method="POST">
            @csrf
            <input class="txt-field" type="text" name="model" placeholder="Model" /><br>
            <span style="color:red">@error ('model') {{$message}} @enderror</span><br><br>
            <input class="txt-field" type="text" name="model_year" placeholder="Year" /><br>
            <span style="color:red">@error ('model_year') {{$message}} @enderror</span><br><br>
            <input class="txt-field" type="text" name="price_per_hour" placeholder="Price per day" /><br>
            <span style="color:red">@error ('price_per_hour') {{$message}} @enderror</span><br><br>
            <input class="txt-field" type="text" name="cc" placeholder="CC" /><br>
            <span style="color:red">@error ('cc') {{$message}} @enderror</span><br><br>
            <input class="txt-field" type="text" name="office_location" placeholder="Office location" /><br>
            <span style="color:red">@error ('office_location') {{$message}} @enderror</span><br>
            <?php
            if (isset($_SESSION['error'])) {
                echo "<h4 style=color:red><center>" . $_SESSION['error'] . "</center></h4>";
                unset($_SESSION['error']);
            }
            ?>
            <br>
            <button type="submit">Search</button><br><br>
        </form>
    </div>
</body>

</html>