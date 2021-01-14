<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employees;
use Validator;
use DB;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employees::with('teams')->get();
          return $employees;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   

   
     public function store(Request $request)
    {
        
        // $validator = Validator::make($request->all(), [
        //     'firstname' => 'required|max:55',
        //     'lastname'  => 'required|max:55',
        //     'email'     => 'required|email',
        //     'image'     => 'required|image|mimes:jpeg,jpg,svg,png,gif|max:5048',
        //     'identity'  => 'required|unique:employees|min:6',
        //     'phone'  => 'required|unique:employees|min:8|max:55'
        // ]);

        // if($validator->fails()){
        //     return response()->json(['error' => $validator->errors()], 401);
        // }

        $employees = [
            'firstname' => $request->firstname,
            'lastname' => $request->lastname,
            'identity' => $request->identity,
            'image' => null,
            'email'    => $request->email,
            'phone'    => $request->phone,
            'team_id' => $request->team_id,
            
        ];
            if($request->image)
           {
               $image = $request->image;
               $name = time().'_' . $image->getClientOriginalName();
               $filePath = $request->file('image')->storeAs('', $name, 'public');
               $employees['image'] = $name;  
            }
            Employees::create($employees);
            
            return response()->json('Successfully added');
        
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->all();  //dd is to dump and die to print
        $employees = Employees::where('id' , $id)->first();       
        $employees->firstname = $data['firstname'];
        $employees->lastname = $data['lastname'];
        $employees->email = $data['email'];
        $employees->phone = $data['phone'];
        $employees->image = $data['image'];
        $employees->update($data);
               
        if($request->image)
        {

            $image = $request->image;
            $name = time().'_' . $image->getClientOriginalName();
            $filePath = $request->file('image')->storeAs('', $name, 'public');
            $employees['image'] = $name;  
          
         }
         $employees->save();
         
         return response()->json('Successfully updated');
     
    
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Employees::where('id' ,$id)->delete();
        return response()->json('Deleted!');
    }
}
