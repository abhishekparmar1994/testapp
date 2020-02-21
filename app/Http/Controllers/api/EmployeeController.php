<?php 

namespace App\Http\Controllers\api;

use App\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables; 

class EmployeeController extends Controller 
{
	public function index(){
		try{
			$employee=Employee::all();
			return response()->json([
				'status' => 'ok',
				'data' => $employee
			], 200);

		} catch(\Exception $ex){
			return response()->json([
				'status' => 'error',
				'data' => 'Something Went Wrong.'
			], 200);
		}
	}
	public function getemployees(){
		try{
			$employeelist=Employee::select('id','name','address','contact','gender','date_of_joining','email')->get();
			return response()->json([
				'status' => 'ok',
				'data' => $employeelist
			], 200);} catch(\Exception $ex){
			return response()->json([
				'status' => 'error',
				'data' => 'Something Went Wrong.'
			], 200);
		}
	}

	
	
	// public function edit($id) {
	// 	try{
	// 		$employee = Employee::whereId($id)->first();
	// 		return response()->json([
	// 			'status' => 'ok',
	// 			'data' => $employee
	// 		], 200);
	// 	} catch(\Exception $ex){
	// 		return response()->json([
	// 			'status' => 'error',
	// 			'data' => 'Something Went Wrong.'
	// 		], 200);
	// 	}
	// }

	public function getedit($id) {
		try{
			$employee = Employee::whereId($id)->first();
			return response()->json([
				'status' => 'ok',
				'data' => $employee
			], 200);
		} catch(\Exception $ex){
			return response()->json([
				'status' => 'error',
				'data' => 'Something Went Wrong.'
			], 200);
		}
	}

	public function update(Request $request){
		try{
			// $data = $request->all();
   
			$data = json_decode($request->data);
			dd($data);
			$employee = Employee::whereId($id)->first();
			$employee->update($request->all());
			return response()->json([
				'status' => 'ok',
				'data' => 'Success - Record Updated Successfully.'
			], 200);
		}catch(\Exception $ex){
			return response()->json([
				'status' => 'error',
				'data' => 'Something Went Wrong.'
			], 200);
		}
	}

	public function destroy($id) {
		$ids = explode(',', $id);
		try{
			$employee = Employee::whareIn('id',$ids)->delete();
			return response()->json([
				'status' => 'ok',
				'data' => 'Record Deleted Successfully.'
			], 200);
		}catch(\Exception $ex){
			return response()->json([
				'status' => 'error',
				'data' => 'Something Went Wrong.'
			], 200);
		}
	}
}
