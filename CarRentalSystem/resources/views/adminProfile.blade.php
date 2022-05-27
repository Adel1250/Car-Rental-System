<!DOCTYPE html>
<html lang="en">

<head>
    <title>Admin Profile</title>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        * {
            padding: 0;
            margin: 0;
            font-family: sans-serif;
            text-decoration: none;
            list-style: none;
            box-sizing: border-box;
        }

        body {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
            background: linear-gradient(100deg, #2980b9, #8e44ad);
            color: white;
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
            width: 150px;
            float: none;
            display: list-item;
            position: relative;
        }

        nav ul ul ul li {
            position: relative;
            top: -60px;
            left: 100px;
        }

        .center {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 400px;
            border-radius: 10px;
        }
    </style>
</head>

<body>
    <div class="dropdown">
        <nav>
            <label class="logo"><em>Welcome {{session('username')}}</em></label>
            <ul>
                <li><a href="/">Home</a>
                <li><a>Reports <i class="fas fa-caret-down"></i></a></a>

                    <ul>
                        <li><a href="specificPeriod">Report 1</a></li>
                        <li><a href="specificCar">Report 2</a></li>
                        <li><a href="repCon3">Report 3</a></li>
                        <li><a href="specificClient">Report 4</a></li>
                    </ul>


                </li>
                <li><a>Advanced Search <i class="fas fa-caret-down"></i></a></a>

                    <ul>
                        <li><a href="advancedSearchCar">Car</a></li>
                        <li><a href="advancedSearchClient">Client</a></li>
                        <li><a href="advancedSearchReservations">Reservations</a></li>
                    </ul>


                </li>
                <li><a>Car <i class="fas fa-caret-down"></i></a></a>

                    <ul>
                        <li><a href="carRegistration">New</a></li>
                        <li><a href="carUpdate">Update</a></li>
                    </ul>

                </li>
                <li><a href="logout">Logout</a>
            </ul>
        </nav>
    </div>
    <img src="/images/image.png" alt="Admin" class="center">
</body>

</html>