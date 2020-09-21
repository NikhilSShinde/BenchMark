<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Student;

class TestController extends Controller
{
    public function list() 
    {
        $students = Student::all();

        return response()->json($students);

    }

    /**
     * 
     */
    public function store(Request $request) 
    {

        $validator = Validator::make($request->all(), [
            'firstname'    => 'required',
            'lastname'     => 'required',
            'email'        => 'required',
            'pocketmoney'  => 'required',
         ]);
     
         if($validator->fails()) 
         {
            return response()->json($validator->messages(), 200);
        
        } else {

               $student = new Student();

               $student->first_name     = $request->firstname;
               $student->last_name      = $request->lastname;
               $student->email          = $request->email;
               $student->pocket_money   = $request->pocketmoney;

               $result = $student->save();
 
               if($result) {
                    return response()->json(array('message' => 'Record Inserted Successfully'));
               } else {
                    return response()->json(array('message' => 'something went wrong','status' => '200'));
               }

        }
       
    }

    /**
     * 2nd Highest Pocket Money
     */
    public function getSendHighestPocketmoney(Request $request) 
    {
        
        $students = Student::select('first_name', 'last_name', 'pocket_money')
                            ->orderBy('pocket_money', 'DESC')->skip(1)->take(1)->first();
        
                            
           if($students->count() > 0) 
           {
                return response()->json($students);
           } else {
                return response()->json(array('message' => 'No records at the moment !','status' => '200'));
           }
                   

    }
      
}
