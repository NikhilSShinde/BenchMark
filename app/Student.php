<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

use DB;

class Student extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        '*'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Store student data.
     * @param $request
     * @return mixed
     */
    public function addStudent($request) {

              $data = array(
                'first_name'    =>   $request->firstname,
                'last_name'     =>   $request->lastname,
                'email'         =>   $request->email,
                'pocket_money'  =>   $request->pocketmoney,
                'password'      =>   Hash::make($request->password),
                'age'           =>   $request->age,
                'city'          =>   $request->city,
                'state'         =>   $request->state,
                'country'       =>   $request->country,
              );

        $result = Student::insert($data);

        if($result) {
                        return "Record Inserted succeessfully!";
        } else {
                        return "Something went wrong !";
        }
    }

    /**
     * Return student with 2nd heighest salary.
     * @return mixed
     */
    public function getMoney() {

        $students = Student::select('first_name', 'last_name', 'pocket_money')
            ->orderBy('pocket_money', 'DESC')
            ->skip(1)
            ->take(1)
            ->first();

        return $students;
    }
}
