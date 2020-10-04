<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

use App\Student;

/**
 * Class StudentController
 * @package App\Http\Controllers
 */
class StudentController extends Controller
{
    /**
     * return json response to show student list
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $students = Student::all();
        return response()->json($students);

    } // function end

    /**
     * Return validation
     * @param $request
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validation($request)
    {

        $validator = Validator::make($request->all(), [
            'firstname'    => 'required',
            'lastname'     => 'required',
            'email'        => 'required',
            'pocketmoney'  => 'required',
            'password'     => 'required',
            'age'          => 'required',
            'city'         => 'required',
            'state'        => 'required',
            'zip'          => 'required',
            'country'      => 'required',
        ]);

        return $validator;
    } // function end

    /**
     * Create student information
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        /**
         * Return form validation.
         */
        $validator = $this->validation($request);

        if($validator->fails()) {
            return response()->json($validator->messages(), 422);

        } else {

               $student = new Student();
               $result = $student->addStudent($request);

              return response()->json($result, 201);
        }
    } // function end

    /**
     * Get 2nd Highest pocket money.
     * @return \Illuminate\Http\JsonResponse
     */
    public function getPocketMoney()
    {
        $student = new Student();

        $result = $student->getMoney();

           if($result->count() > 0) {
                return response()->json($result, 200);
           } else {
                return response()->json(array('message' => 'No records at the moment !','status' => '200'));
           }
    } // function end
      
} // class end
