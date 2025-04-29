<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Settings\UniversityList;
use App\Models\User;
use Illuminate\Http\Request;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): void {}

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $user)
    {
        $university_lists = UniversityList::all();

        return view('contracts.create', compact('user', 'university_lists'));
    }

    public function store(Request $request, User $student)
    {
        $validated = $request->validate([
            'customer_name'            => 'required|string|max:255',
            'customer_identity_number' => 'nullable|string|max:255',
            'relative_mobile'          => 'nullable|string|max:255',
            'whatsapp_number'          => 'nullable|string|max:255',
            'address'                  => 'nullable|string',
            'education_level'          => 'required|string',
            'service'                  => 'required|string|max:255',
            'service_price'            => 'nullable|numeric',
            'initial_payment'          => 'nullable|numeric',
            'remaining_amount'         => 'nullable|numeric',
            'university_id'            => 'nullable|exists:universities,id',
            'majors'                   => 'nullable|array',
            'majors.*'                 => 'string',
            'country'                  => 'nullable|string|max:255',
            'verification_code'        => 'nullable|string|max:255',
        ]);

        $validated['student_id'] = $student->id;

        Contract::create($validated);

        return redirect()->route('students.show', $student)->with('success', 'Müqavilə uğurla əlavə edildi.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract): void {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract): void {}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract): void {}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract): void {}
}
