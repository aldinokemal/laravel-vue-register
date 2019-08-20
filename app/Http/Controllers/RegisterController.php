<?php

namespace App\Http\Controllers;

use Exception;
use App\Registration;
use App\Http\Requests\RegValidate;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
    	return view('registration');
    }

    public function login()
    {
        echo "INI HALAMAN LOGIN";
    }

    public function getMonth()
    {	
    	$output = [
    		'message' => 'Data found',
    		'result' => [
    			['id' => '01', 'name' => 'January'],
    			['id' => '02', 'name' => 'February'],
    			['id' => '03', 'name' => 'March'],
    			['id' => '04', 'name' => 'April'],
    			['id' => '05', 'name' => 'May'],
    			['id' => '06', 'name' => 'June'],
    			['id' => '07', 'name' => 'July'],
    			['id' => '08', 'name' => 'August'],
    			['id' => '09', 'name' => 'September'],
    			['id' => '10', 'name' => 'October'],
    			['id' => '11', 'name' => 'November'],
    			['id' => '12', 'name' => 'December'],
    		]
    	];
    	return response()->json($output);
    }

    public function register(RegValidate $request)
    {
        $dataInsert = [
            'reg_email'      => $request->email,
            'reg_phone'      => $request->phone,
            'reg_firstname'  => $request->fname,
            'reg_lastname'   => $request->lname,
            'reg_gender'     => $request->gender,
            'reg_birthdate'  => $request->date,
            'reg_birthmonth' => $request->month,
            'reg_birthyear'  => $request->year
        ];

        // try {
            $insertUser = Registration::create($dataInsert);
            return response()->json(['message' => 'Data register success'], 200);
        // } catch (Exception $e) {
        //     return response()->json(['message' => 'Data already registered, try with different email or phone'], 400);
        // }
    }
}
