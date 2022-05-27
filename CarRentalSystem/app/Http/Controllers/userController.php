<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class userController extends Controller
{
    function getLoginInfo(Request $loginReq)
    {
        $loginReq->validate([
            'username' => 'required',
            'user_password' => 'required',
            'ssn' => 'required',
            'radio' => 'required|in:client,admin'
        ]);
        if ($loginReq['radio'] == "client") {
            $client = NULL;
            $pass = md5($loginReq->user_password);
            $client = DB::select('SELECT *
                                    FROM client
                                    WHERE username = ? AND user_password = ? AND ssn = ?', [$loginReq->username, $pass, $loginReq->ssn]);
            if ($client) {
                $loginReq->session()->put('username', $loginReq->username);
                $loginReq->session()->put('userType', 'client');
                $loginReq->session()->put('ssn', $loginReq->ssn);
                return redirect('clientProfile');
            } else {
                $_SESSION['error'] = "Wrong username or password or SSN";
                return view('login');
            }
        } else if ($loginReq['radio'] == "admin") {
            $admin = NULL;
            $adpass = md5($loginReq->user_password);
            $admin = DB::select('SELECT *
                                    FROM admin
                                    WHERE username = ? AND user_password = ? AND ssn = ?', [$loginReq->username, $adpass, $loginReq->ssn]);
            if ($admin) {
                $loginReq->session()->put('username', $loginReq->username);
                $loginReq->session()->put('userType', 'admin');
                return redirect('adminProfile');
            } else {
                $_SESSION['error'] = "Wrong username or password or SSN";
                return view('login');
            }
        } else {
            return view('login');
        }
    }

    function getRegisterInfo(Request $registerReq)
    {
        $registerReq->validate([
            'username' => 'required | max:10 | min:5',
            'user_password' => 'required | min:8',
            'ssn' => 'required | max:9 | min:9',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required'

        ]);
        $test = NULL;
        $test = DB::select('SELECT *
                            FROM client
                            WHERE username = ? OR ssn = ?', [$registerReq->username, $registerReq->ssn]);
        if ($test) {
            $_SESSION['error'] = "Already existing data";
            return view('signup');
        }
        $client = array('ssn' => $registerReq->ssn, 'username' => $registerReq->username, 'user_password' => md5($registerReq->user_password), 'name' => $registerReq->name, 'email' => $registerReq->email, 'phone' => $registerReq->phone);
        DB::table('client')->insert($client);
        return redirect('login');
    }

    function getCarRegisterInfo(Request $registerReq)
    {
        $registerReq->validate([
            'plate_id' => 'required',
            'model' => 'required',
            'model_year' => 'required',
            'price_per_hour' => 'required',
            'cc' => 'required',
            'office_location' => 'required'
        ]);
        $test = NULL;
        $test = DB::select('SELECT *
                            FROM car
                            WHERE plate_id = ?', [$registerReq->plate_id]);
        if ($test) {
            $_SESSION['error'] = "Already existing data";
            return view('carRegistration');
        }
        if ($registerReq['radio'] == "active") {
            $status = 1;
        } else {
            $status = 0;
        }
        $car = array('plate_id' => $registerReq->plate_id, 'model' => $registerReq->model, 'model_year' => $registerReq->model_year, 'price_per_hour' => $registerReq->price_per_hour, 'cc' => $registerReq->cc, 'status' => $status, 'office_location' => $registerReq->office_location);
        DB::table('car')->insert($car);
        return redirect('adminProfile');
    }

    function getCarUpdateInfo(Request $updateReq)
    {
        $updateReq->validate([
            'plate_id' => 'required',
            'price_per_hour' => 'required'
        ]);
        $test = NULL;
        $test = DB::select('SELECT *
                            FROM car
                            WHERE plate_id = ?', [$updateReq->plate_id]);
        if ($test == NULL) {
            $_SESSION['error'] = "Car not found! Please check the plate id.";
            return view('carUpdate');
        } else {
            if ($updateReq['radio'] == "active") {
                $status = 1;
            } else {
                $status = 0;
            }
            DB::statement('Update car set price_per_hour = ?, status = ? WHERE plate_id = ?', [$updateReq->price_per_hour, $status, $updateReq->plate_id]);
            return redirect('adminProfile');
        }
    }

    function getCarSearchInfo(Request $searchReq)
    {
        $searchReq->validate([
            'office_location' => 'required'
        ]);
        $office_location = $searchReq->office_location;
        $model = $searchReq->model;
        $model_year = $searchReq->model_year;
        $price_per_hour = $searchReq->price_per_hour;
        $cc = $searchReq->cc;
        $query = NULL;
        $query = DB::table('car')->select('car.plate_id', 'model', 'model_year', 'price_per_hour', 'cc', DB::raw('MAX(return_date) AS ret'))->where('status', 1)->where('office_location', $office_location)->LeftJoin('reservations', 'reservations.plate_id', '=', 'car.plate_id')->groupBy('car.plate_id', 'model', 'model_year', 'price_per_hour', 'cc');
        if ($model) {
            $query->where('model', $model);
        }
        if ($model_year) {
            $query->where('model_year', $model_year);
        }
        if ($price_per_hour) {
            $query->where('price_per_hour', '<=', $price_per_hour);
        }
        if ($cc) {
            $query->where('cc', $cc);
        }
        $search = $query->get();
        return view('searchResults', ['search' => $search]);
    }

    public function reserve(Request $req)
    {
        $req->session()->put('plate_id', $req->id);
        return redirect('reserveForm');
    }

    function confirmRegistration(Request $conReq)
    {
        $conReq->validate([
            'date_of_reservation' => 'required',
            'return_date' => 'required'
        ]);
        $check = NULL;
        $check1 = NULL;
        $check2 = NULL;
        $check = DB::select('SELECT plate_id
                            FROM car
                            WHERE plate_id = ? AND `status` = 1', [session('plate_id')]);
        $check1 = DB::select('SELECT plate_id
                            FROM reservations
                            WHERE (plate_id = ? AND return_date >= ?)', [session('plate_id'), $conReq->date_of_reservation]);
        $check2 = DB::select('SELECT *
                            FROM reservations
                            WHERE plate_id = ? AND paid = 0', [session('plate_id')]);
        $start_time = \Carbon\Carbon::parse($conReq->input('date_of_reservation'));
        $finish_time = \Carbon\Carbon::parse($conReq->input('return_date'));
        $result = $finish_time->gt($start_time);
        $todayDate = date("Y-m-d");
        $result1 = $start_time->gte($todayDate);
        if ($result && $result1) {
            if ($check) {
                if ($check1 || $check2) {
                    $_SESSION['error'] = "OOPS! This car is not available. Try reserving this car later.";
                    return view('clientProfile');
                } else {
                    $price = DB::table('car')->select('price_per_hour')->where('plate_id', session('plate_id'))->get();
                    $result = $start_time->diffInDays($finish_time, false);
                    $reservation = array('plate_id' => session('plate_id'), 'ssn' => session('ssn'), 'date_of_reservation' => $conReq->date_of_reservation, 'return_date' => $conReq->return_date, 'res_price' => $result * $price[0]->price_per_hour, 'paid' => 0);
                    DB::table('reservations')->insert($reservation);
                    return view('clientProfile');
                }
            } else {
                $_SESSION['error'] = "Car is not active right now. Try reserving it later.";
                return view('clientProfile');
            }
        } else {
            $_SESSION['error'] = "Unavailable dates!";
            return view('clientProfile');
        }
    }

    function payment(Request $paymentReq)
    {
        $paymentReq->validate([
            'reservation_id' => 'required'
        ]);
        $check = NULL;
        $check = DB::select('SELECT reservation_id
                            FROM reservations
                            WHERE reservation_id = ? AND ssn = ?', [$paymentReq->reservation_id, session('ssn')]);
        if ($check) {
            DB::statement('Update reservations set paid = 1 WHERE reservation_id = ?', [$paymentReq->reservation_id]);
            return view('clientProfile');
        } else {
            $_SESSION['error'] = "Wrong reservation number!";
            return view('pay');
        }
    }

    function carReturning(Request $returnReq)
    {
        $returnReq->validate([
            'reservation_id' => 'required'
        ]);
        $check = NULL;
        $check = DB::select('SELECT reservation_id
                            FROM reservations
                            WHERE reservation_id = ? AND ssn = ?', [$returnReq->reservation_id, session('ssn')]);
        if ($check) {
            $check2 = NULL;
            $check2 = DB::select('SELECT reservation_id
                                FROM reservations
                                WHERE reservation_id = ? AND ssn = ? AND paid = 1', [$returnReq->reservation_id, session('ssn')]);
            if ($check2) {
                DB::statement('Delete FROM reservations WHERE reservation_id = ?', [$returnReq->reservation_id]);
                return view('clientProfile');
            } else {
                $_SESSION['error'] = "Please pay for your reservation before returning the car.";
                return view('pay');
            }
        } else {
            $_SESSION['error'] = "Wrong reservation number!";
            return view('returnCar');
        }
    }

    function reservations()
    {
        $result = DB::select('SELECT plate_id, reservation_id, date_of_reservation, return_date, res_price
                            FROM reservations
                            WHERE ssn = ?', [session('ssn')]);
        return view('myReservations', ['result' => $result]);
    }

    function advancedSearchCarHandle(Request $searchReq)
    {
        $plate_id = $searchReq->plate_id;
        $office_location = $searchReq->office_location;
        $model = $searchReq->model;
        $model_year = $searchReq->model_year;
        $price_per_hour = $searchReq->price_per_hour;
        $cc = $searchReq->cc;
        $query = NULL;
        $query = DB::table('car')->select('car.plate_id', 'model', 'model_year', 'price_per_hour', 'cc');
        if ($office_location) {
            $query->where('office_location', $office_location);
        }
        if ($model) {
            $query->where('model', $model);
        }
        if ($model_year) {
            $query->where('model_year', $model_year);
        }
        if ($price_per_hour) {
            $query->where('price_per_hour', $price_per_hour);
        }
        if ($cc) {
            $query->where('cc', $cc);
        }
        if ($plate_id) {
            $query->where('plate_id', $plate_id);
        }
        $search = $query->get();
        return view('resCar', ['search' => $search]);
    }

    function advancedSearchClientHandle(Request $searchReq)
    {
        $ssn = $searchReq->ssn;
        $username = $searchReq->username;
        $name = $searchReq->name;
        $email = $searchReq->email;
        $phone = $searchReq->phone;
        $query = NULL;
        $query = DB::table('client')->select('ssn', 'username', 'name', 'email', 'phone');
        if ($ssn) {
            $query->where('ssn', $ssn);
        }
        if ($username) {
            $query->where('username', $username);
        }
        if ($name) {
            $query->where('name', $name);
        }
        if ($email) {
            $query->where('email', $email);
        }
        if ($phone) {
            $query->where('phone', $phone);
        }
        $search = $query->get();
        return view('resClient', ['search' => $search]);
    }

    function advancedSearchReservationsHandle(Request $searchReq)
    {
        $username = $searchReq->username;
        $name = $searchReq->name;
        $email = $searchReq->email;
        $phone = $searchReq->phone;
        $office_location = $searchReq->office_location;
        $model = $searchReq->model;
        $model_year = $searchReq->model_year;
        $price_per_hour = $searchReq->price_per_hour;
        $cc = $searchReq->cc;
        $reservation_id = $searchReq->reservation_id;
        $res_price = $searchReq->res_price;
        $paid = $searchReq->paid;
        $date_of_reservation = $searchReq->date_of_reservation;
        $return_date = $searchReq->return_date;
        $query = NULL;
        $query = DB::table('reservations')->select('username', 'name', 'email', 'phone', 'office_location', 'model', 'model_year', 'price_per_hour', 'cc', 'reservation_id', 'res_price', 'paid', 'date_of_reservation', 'return_date')
            ->Join('client', 'client.ssn', '=', 'reservations.ssn')
            ->Join('car', 'car.plate_id', '=', 'reservations.plate_id');
        if ($username) {
            $query->where('username', $username);
        }
        if ($name) {
            $query->where('name', $name);
        }
        if ($email) {
            $query->where('email', $email);
        }
        if ($phone) {
            $query->where('phone', $phone);
        }
        if ($office_location) {
            $query->where('office_location', $office_location);
        }
        if ($model) {
            $query->where('model', $model);
        }
        if ($model_year) {
            $query->where('model_year', $model_year);
        }
        if ($price_per_hour) {
            $query->where('price_per_hour', $price_per_hour);
        }
        if ($cc) {
            $query->where('cc', $cc);
        }
        if ($reservation_id) {
            $query->where('reservation_id', $reservation_id);
        }
        if ($res_price) {
            $query->where('res_price', $res_price);
        }
        if ($paid) {
            $query->where('paid', $paid);
        }
        if ($date_of_reservation) {
            $query->where('date_of_reservation', $date_of_reservation);
        }
        if ($return_date) {
            $query->where('return_date', $return_date);
        }
        $search = $query->get();
        return view('resReserve', ['search' => $search]);
    }

    function repCon1(Request $req)
    {
        $result = DB::select('SELECT *
                            FROM reservations JOIN client ON (reservations.ssn = client.ssn) JOIN car ON (reservations.plate_id = car.plate_id)
                            WHERE date_of_reservation >= ? AND return_date <= ?', [$req->date_of_reservation, $req->return_date]);
        return view('report1', ['result' => $result]);
    }

    function repCon2(Request $req)
    {
        $req->validate([
            'plate_id' => 'required'
        ]);
        $result = DB::select('SELECT *
                            FROM reservations
                            WHERE date_of_reservation >= ? AND return_date <= ? AND plate_id = ?', [$req->date_of_reservation, $req->return_date, $req->plate_id]);
        return view('report2', ['result' => $result]);
    }

    function repCon3()
    {
        $result = DB::select('SELECT *
                            FROM car');
        return view('report3', ['result' => $result]);
    }

    function repCon4(Request $req)
    {
        $req->validate([
            'ssn' => 'required'
        ]);
        $result = DB::select('SELECT *
                            FROM reservations
                            WHERE date_of_reservation >= ? AND return_date <= ? AND ssn = ?', [$req->date_of_reservation, $req->return_date, $req->ssn]);
        return view('report4', ['result' => $result]);
    }
}
