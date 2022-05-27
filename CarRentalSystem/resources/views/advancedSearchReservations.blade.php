<!DOCTYPE html>
<html lang="en">

<head>
    <title>Advanced Search</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: linear-gradient(120deg, #2980b9, #8e44ad);
            height: 180vh;
        }

        .center {
            position: absolute;
            top: 70%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: white;
            border-radius: 10px;
            width: 400px;
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
    </style>
</head>

<body>
    <div class="center">
        <h1>Advanced Search</h1>
        <form action='advancedSearchReservationsHandle' method="POST">
            @csrf
            <input class="txt-field" type="text" name="username" placeholder="Username" /><br>
            <span style="color:red">@error ('username') {{$message}} @enderror</span><br>
            <input class="txt-field" type="text" name="name" placeholder="Name" /><br>
            <span style="color:red">@error ('name') {{$message}} @enderror</span><br>
            <input class="txt-field" type="text" name="email" placeholder="E-mail" /><br>
            <span style="color:red">@error ('email') {{$message}} @enderror</span><br>
            <input class="txt-field" type="text" name="phone" placeholder="Phone" /><br>
            <span style="color:red">@error ('Phone') {{$message}} @enderror</span><br>
            <input class="txt-field" type="text" name="model" placeholder="Model" /><br>
            <span style="color:red">@error ('model') {{$message}} @enderror</span><br>
            <input class="txt-field" type="text" name="model_year" placeholder="Year" /><br>
            <span style="color:red">@error ('model_year') {{$message}} @enderror</span><br>
            <input class="txt-field" type="text" name="price_per_hour" placeholder="Price per day" /><br>
            <span style="color:red">@error ('price_per_hour') {{$message}} @enderror</span><br>
            <input class="txt-field" type="text" name="cc" placeholder="CC" /><br>
            <span style="color:red">@error ('cc') {{$message}} @enderror</span><br>
            <input class="txt-field" type="text" name="office_location" placeholder="Office location" /><br>
            <span style="color:red">@error ('office_location') {{$message}} @enderror</span><br>
            <input class="txt-field" type="text" name="reservation_id" placeholder="Reservation number" /><br>
            <span style="color:red">@error ('reservation_id') {{$message}} @enderror</span><br>
            <input class="txt-field" type="text" name="res_price" placeholder="Reservation price" /><br>
            <span style="color:red">@error ('res_price') {{$message}} @enderror</span><br>
            <input class="txt-field" type="text" name="paid" placeholder="Paid" /><br>
            <span style="color:red">@error ('paid') {{$message}} @enderror</span>
            <h4>Date of reservation</h4>
            <input type="date" name="date_of_reservation">
            <h4>Return date</h4>
            <input type="date" name="return_date"><br><br>
            <button type="submit">Search</button><br><br>
        </form>
    </div>
</body>

</html>