<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Education;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\Exam;
use App\Models\University;
use App\Models\User;
use Illuminate\Http\Request;

class EducationController extends Controller
{
//    public function index($student_id)
//    {
//
//        $user = User::query()->with('educations')->findOrFail($student_id);
//        return view('students.educations.index', compact( 'user'));
//
//    }
//
//    public function create($student_id)
//    {
//        $user = User::query()->with('educations')->findOrFail($student_id);
//        $exams = Exam::all();
//        $universities = University::all();
//        return view('students.educations.create', compact( 'user','exams','universities'));
//    }
//
//    public function storeEducation(Request $request)
//    {
//        try {
//            $request->validate([
//                'user_id' => 'required|string',
//                'degree' => 'nullable|string',
//                'university' => 'nullable|string',
//                'profession' => 'nullable|string',
//                'faculty' => 'nullable|string',
//                'gno' => 'nullable|string',
//                'university_start_date' => 'nullable',
//                'university_end_date' => 'nullable',
//            ]);
//
//            $user = User::query()->findOrFail($request->user_id);
//            $user->educations()->create($request->except('tab_type'));
//
//            return redirect()->route('educations.index',$request->user_id)->with('message', 'Təhsil uğurla əlavə edildi.');
//        }catch (\Exception $exception){
//            return response()->json($exception->getMessage());
//        }
//    }
//
//    public function edit($id)
//    {
//        $education = Education::query()->findOrFail($id);
//        $user = User::query()->with('educations')->findOrFail($education->user_id);
//        return view('students.educations.edit', compact('education','user'));
//    }
//
//
//    public function updateEducation(Request $request, $id)
//    {
//        $request->validate([
//            'degree' => 'required|string',
//            'university' => 'required|string',
//            'profession' => 'required|string',
//            'faculty' => 'nullable|string',
//            'gno' => 'nullable|string',
//            'university_start_date' => 'nullable',
//            'university_end_date' => 'nullable',
//        ]);
//
//        $education = Education::findOrFail($id);
//        $education->update($request->all());
//
//        return redirect()->route('educations.index',$education->user_id)->with('message', 'Təhsil uğurla yeniləndi.');
//    }
//
//    public function destroy($id)
//    {
//        $education = Education::query()->findOrFail($id);
//        $education->delete();
//        return redirect()->route('educations.index',$education->user_id)->with('message', 'Təhsil silindi');
//    }


    public function index($userId)
    {
        $user = User::findOrFail($userId);
        $educations = Education::where('user_id', $userId)->get();
        $universities = University::all();
        $exams = Exam::all();

        return view('students.educations.index', compact('user', 'educations', 'universities', 'exams'));
    }

    public function create($userId)
    {
        $user = User::findOrFail($userId);
        $universities = University::all();
        $exams = Exam::all();

        return view('students.educations.create', compact('user', 'universities', 'exams'));
    }

    public function store(Request $request)
    {
//        dd($request->all());
        $data = $request->all();

        Education::create($data);

        return redirect()->route('educations.index', $request->user_id)
            ->with('success', 'Təhsil məlumatı uğurla əlavə edildi');
    }

    public function edit($id)
    {
        $education = Education::findOrFail($id);
        $user = $education->user;
        $universities = University::all();
        $exams = Exam::all();

        return view('students.educations.edit', compact('education', 'user', 'universities', 'exams'));
    }

    public function update(Request $request, $id)
    {
        $education = Education::findOrFail($id);


        $data = $request->all();



        $education->update($data);

        return redirect()->route('educations.index', $education->user_id)
            ->with('success', 'Təhsil məlumatı uğurla yeniləndi');
    }

    public function destroy($id)
    {
        $education = Education::findOrFail($id);
        $userId = $education->user_id;
        $education->delete();

        return redirect()->route('educations.index', $userId)
            ->with('success', 'Təhsil məlumatı uğurla silindi');
    }

    public function getFields($degree)
    {
        $universities = University::all();
        $exams = Exam::all();
        $html = '';

        if ($degree === 'Məktəb') {
            $html = view('students.educations.partials.school_fields', compact('exams'))->render();
        } elseif ($degree === 'Kollec') {
            $html = view('students.educations.partials.college_fields', compact('exams'))->render();
        } elseif ($degree === 'Bakalavr' || $degree === 'Magistr') {
            $html = view('students.educations.partials.university_fields', compact('universities', 'exams'))->render();
        } elseif ($degree === 'Denklik') {
            $html = view('students.educations.partials.equivalence_fields')->render();
        }

        return response()->json(['html' => $html]);
    }
}
