<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Shift;
use App\Models\Doctor;
use App\Models\DoctorShift;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\DoctorDetailResource;

class UserController extends Controller
{
    public function indexAdmins()
    {
        $admins = User::where('role', 'admin')->get();
        return response()->json($admins->makeHidden(['created_at', 'updated_at']));
    }

    public function indexDoctors()
    {
        $doctors = Doctor::with('user', 'shifts')->get();

        if ($doctors->isEmpty()) {
            return response()->json(['message' => 'No doctors found'], 200);
        }

        return DoctorResource::collection($doctors);
    }

    public function showAdmin($id)
    {
        $admin = User::where('role', 'admin')->findOrFail($id);
        return response()->json($admin->makeHidden(['created_at', 'updated_at']));
    }

    public function showDoctor($id)
    {
        $user = User::where('role', 'doctor')
                ->with([
                    'doctor.shifts',
                    'doctor.checkups',
                    ])
                ->findOrFail($id);

        return new DoctorDetailResource($user->doctor);
    }

    public function storeDoctor(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'specialization' => 'required|in:Dental,General',
            'shifts' => 'required|array',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => $validatedData['password'],
            'role' => 'doctor',
        ]);

        $doctor = Doctor::create([
            'user_id' => $user->id,
            'specialization' => $validatedData['specialization'],
        ]);

        foreach ($validatedData['shifts'] as $shiftId) {
            $shift = Shift::findOrFail($shiftId);
            DoctorShift::create([
                'doctor_id' => $doctor->id,
                'shift_id' => $shift->id,
            ]);
        }

        return response()->json(['message' => 'Doctor added successfully']);
    }

    public function editDoctor(Request $request, $id)
    {
        $doctor = User::where('role', 'doctor')->with('doctor.shifts')->find($id);
        $user = $doctor;

        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'specialization' => 'required|in:Dental,General',
            'shifts' => 'required|array',
        ]);        

        $user->name = $validatedData['name'];
        $user->save();

        $user->doctor->update([
            'specialization' => $validatedData['specialization'],
        ]);

        DoctorShift::where('doctor_id', $user->doctor->id)->delete();

        foreach ($validatedData['shifts'] as $shiftId) {
            $shift = Shift::findOrFail($shiftId);
            DoctorShift::create([
                'doctor_id' => $user->doctor->id,
                'shift_id' => $shift->id,
            ]);
        }

        return response()->json(['message' => 'Doctor edited successfully']);
    }

    public function deleteDoctor($id)
    {
        $doctor = Doctor::findOrFail($id);
        $user = $doctor->user;

        DoctorShift::where('doctor_id', $doctor->id)->delete();
        $doctor->delete();
        $user->delete();

        return response()->json(['message' => 'Doctor deleted successfully']);
    }
}