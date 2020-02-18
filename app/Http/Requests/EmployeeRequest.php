<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest {
	public function authorize() {
		return true;
	}

	public function rules() {
		$employee = $this->employee ? "," . $this->employee : "";
		return [
			"name" => "required",
			"address" => "required",
			"contact" => "required|numeric",
			"gender" => "required",
			"date_of_joining" => "required",
			"email" => "required|email",
		];
	}
}