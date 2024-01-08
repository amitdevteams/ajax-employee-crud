<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employee');
    }

    public function store_employee(Request $request)
    {

        $employee = Employee::create([
            'task_title' => $request->task_title,
            'employee_name' => $request->employee_name,
            'task_status' => $request->task_status,
            'task_description' => $request->task_description,
        ]);
        $response = [
            'success' => true,

            'data' => $employee,
            'message' => 'Employee  stored successfully.',
        ];
        return response()->json($response, 200);

    }

    public function fetchEmployees()
    {
        // Fetch all employees from the database
        $employees = Employee::all();

        // Return the employee data as JSON
        return response()->json([
            'success' => true,
            'data' => $employees,
            'message' => 'Employee data fetched successfully.',
        ]);
    }

    public function editEmployee($id)
    {
        Log::info("edit me in kiye hai");
        // Fetch employee by ID
        $employee = Employee::findOrFail($id);

        // Return the employee data as JSON
        return response()->json([
            'success' => true,
            'data' => $employee,
            'message' => 'Employee data fetched for editing.',
        ]);
    }

    public function updateEmployee(Request $request, $id)
    {
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());

        return response()->json([
            'success' => true,
            'data' => $employee,
            'message' => 'Employee updated successfully.',
        ]);
    }

    public function delete($id)
    {
        Log::info("delete me in kiye hai");
        $employee = Employee::findOrFail($id);
        $employee->delete();
        return response()->json([
            'success' => true,
            'message' => 'Employee deleted successfully.',
        ]);
    }
}
