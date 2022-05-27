<!DOCTYPE html>
<html lang="en">

<head>
    <title>Results</title>
    <link rel="shortcut icon" href="/assets/favicon.ico">
    <link rel="stylesheet" href="/assets/dcode.css">
    <meta name="viewport" content="width=device-widthy, initial-scale=1.0">

    <style>
        * {
            font-family: sans-serif;
            text-decoration: none;
            list-style: none;
            box-sizing: border-box;
        }

        body {
            font-family: sans-serif;
            background: linear-gradient(100deg, #2980b9, #8e44ad);
            color: white;
        }

        nav {
            height: 80px;
            width: 100%;
        }

        label.logo {
            font-family: sans-serif;
            color: white;
            font-size: 30px;
            line-height: 50px;
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

        a:hover {
            background: #2980b9;
            transition: .5s;
        }

        body {
            font-family: sans-serif;
            background: linear-gradient(100deg, #2980b9, #8e44ad);
            color: white;
        }

        .content-table {
            border-collapse: collapse;
            margin: 25 px 0;
            font-size: 0.9em;
            min-width: 400px;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
        }

        .content-table thead tr {
            background-color: white;
            color: #2980b9;
            text-align: left;
            font-weight: bold;
        }

        .content-table th,
        .content-table td {
            padding: 12px 15px;
        }

        .content-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .content-table tbody tr:nth-of-type(even) {
            background-color: #8e44ad;

        }

        .content-table tbody tr:last-of-type {
            border-bottom: 4px solid #dddddd;
        }

        .w-5 {
            display: none;
        }

        button[type="submit"] {
            width: 100%;
            height: 30px;
            border: 1px solid;
            background: white;
            border-radius: 25px;
            font-size: 18px;
            color: #e9f4fb;
            font-weight: 700;
            cursor: pointer;
            outline: none;
            color: purple;
        }

        button[type="submit"]:hover {
            border-color: #2691d9;
            transition: -5s;
        }

        .card {
            width: 15%;
            background-color: white;
            color: black;
            border-radius: 10px;
            border: solid black 1px;
            margin-bottom: 15px;
            text-align: center;
        }
    </style>

</head>

<body>
    <h1>Available Cars</h1>
    <table class="content-table">
        <thead>
            <tr>
                <td>Car Model</td>
                <td>Model Year</td>
                <td>Price per day</td>
                <td>CC</td>
                <td>Available after</td>
                <td>Operation</td>
            </tr>

        </thead>

        <tbody>

            @foreach($search as $item)
            <tr>
                <td>{{$item->model}}</td>
                <td>{{$item->model_year}}</td>
                <td>{{$item->price_per_hour}}</td>
                <td>{{$item->cc}}</td>
                <td>{{$item->ret}}</td>
                <td>
                    <form action='/reserve' method="POST">
                        @csrf
                        <input type="hidden" name="id" value="{{$item->plate_id}}" /><br>
                        <button type="submit">Reserve</button><br><br>
                    </form>
                </td>
            </tr>
            @endforeach

        </tbody>
    </table>
    <br>
</body>

</html>