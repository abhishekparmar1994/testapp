<?php 

namespace App\Http\Controllers;

use App\Employee;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Http\Request;

class EmployeeController extends Controller 
{
	public function index(){
		try{
			$meta = array("title"=>"Employee");
			$employee=Employee::all();
			$json=json_encode($employee);
			return view('employee',compact('meta','json'));
		} catch (\Exception $e) {
			\Session::flash("error","Error - Something Went Wrong..");
			return redirect()->back();
		}
	}

	public function create(){
		try{
			$meta = array("title"=>"Create Employee");
			return view('employee.create',compact('meta'));
		} catch (\Exception $e) {
			\Session::flash("error","Error - Something Went Wrong..");
			return redirect()->back();
		}
	}

	public function store(EmployeeRequest $request){
		try{
			$employee = new Employee($request->all());
			$employee->save();
			\Session::flash("ok","Success - Record Added Successfully..");
			return redirect()->route('employee.index');
		}catch(\Exception $ex){
			\Session::flash("error","Error - Something Went Wrong..");
			return redirect()->route('employee.index');
		}
	}

	public function edit($id) {
		try{
			$meta = array("title"=>"Edit Employee");
			$employee = Employee::whereId($id)->first();
			return view('employee.edit', compact('meta','employee'));
		}catch(\Exception $ex){
			\Session::flash("error","Error - Something Went Wrong..");
			return view('employee.edit', compact('meta','employee'));
		}
	}
	public function update(EmployeeRequest $request, $id){
		try{
			$employee = Employee::whereId($id)->first();
			$employee->update($request->all());
			\Session::flash("ok","Success - Record Updated Successfully..");
			return redirect()->route('employee.index');
		}catch(\Exception $ex){
			\Session::flash("error","Error - Something Went Wrong..");
			return redirect()->route('employee.index');
		}
	}

	public function destroy($id) {
		$ids = explode(',', $id);
		try{
			$employee = Employee::destroy($ids);
			\Session::flash("ok","Success - Record Deleted Successfully..");
			return redirect()->back();
		}catch(\Exception $ex){
			\Session::flash("error","Error in Record Delete...");
			return redirect()->back();
		}
	}

}
