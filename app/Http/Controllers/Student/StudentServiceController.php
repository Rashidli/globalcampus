<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\User;
use Illuminate\Http\Request;

class StudentServiceController extends Controller
{
    public function index($student_id)
    {

        $services = Service::all();
        $user = User::query()->with('services')->findOrFail($student_id);
        return view('students.services.index', compact('services','user'));

    }

    public function addServices(User $user, Request $request)
    {
        $serviceIds = $request->input('service_id');
        $servicePrices = $request->input('price');

        $services = [];
        foreach ($serviceIds ?? [] as $index => $serviceId) {
            if ($serviceId) {
                $services[$serviceId] = ['price' => $servicePrices[$index]];
            }
        }

        $user->services()->sync($services);

        return redirect()->back()->with('message','Xidmətlər uğurla yeniləndi');
    }

}
