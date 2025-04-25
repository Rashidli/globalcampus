<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Exports\ApplicationsExport;
use App\Models\Program;
use App\Models\Settings\Country;
use App\Models\Settings\Currency;
use App\Models\Settings\EducationLanguage;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\Period;
use App\Models\Settings\ProgramStatus;
use App\Models\Settings\SchoolType;
use App\Models\Settings\Town;
use App\Models\Settings\UniversityList;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
//        dd($request->all());
        //        \DB::enableQueryLog();
        try {
            $filteredQuery = $this->applyFilters($request);

            $applications = $filteredQuery->orderByDesc('created_at')
                ->paginate(10)->withQueryString();

            $education_levels = EducationLevel::with('school_types')->get();
            $education_languages = EducationLanguage::all();
            $school_types = SchoolType::all();
            $university_lists = UniversityList::all();
            $countries = Country::all();
            $periods = Period::all();
            $program_statuses = ProgramStatus::all();
            $agents = User::query()->where('type', UserType::AGENT)->get();

            //        dd(\DB::getQueryLog());
            return view('applications.index', compact('applications', 'education_levels',
                'education_languages', 'periods', 'program_statuses',
                'school_types', 'university_lists', 'countries', 'agents'));
        }catch (\Exception $exception){
            return $exception->getMessage();
        }
    }

    private function applyFilters(Request $request)
    {
        $user = auth()->user();

        return Program::query()->whereHas('user')
            ->when($user->type === UserType::AGENT->value, function ($q) use ($user) {
                $q->whereHas('user', function ($q) use ($user) {
                    $q->where('agent_id', $user->id);
                });
            })
            ->when($request->filled('name'), fn ($q) => $q->whereHas('user', function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->name.'%');
            }))
            ->when($request->filled('surname'), fn ($q) => $q->whereHas('user', function ($q) use ($request) {
                $q->where('surname', 'like', '%'.$request->surname.'%');
            }))
            ->when($request->filled('agent_id'), fn ($q) => $q->whereHas('user', function ($q) use ($request) {
                $q->whereIn('agent_id', $request->agent_id);
            }))
            ->when($request->filled('university_list_id'), fn ($q) => $q->whereIn('university_list_id', $request->university_list_id))
            ->when($request->filled('period_id'), fn ($q) => $q->where('period_id', $request->period_id))
            ->when($request->filled('education_level_id'), fn ($q) => $q->where('education_level_id', $request->education_level_id))
//            ->when($request->filled('school_type_id'), fn ($q) => $q->where('school_type_id', $request->school_type_id))
            ->when($request->filled('country_id'), fn ($q) => $q->whereIn('country_id', $request->country_id))
            ->when($request->filled('program_status_id'), fn ($q) => $q->whereIn('program_status_id', $request->program_status_id))
            ->when($request->filled('profession_id'), fn ($q) => $q->whereHas('tariff', function ($q) use ($request) {
                $q->whereIn('profession_id', $request->profession_id);
            }));

        //            ->when($request->filled('currency_id'), fn($q) => $q->where('currency_id', $request->currency_id))
        //            ->when($request->filled('town_id'), fn($q) => $q->where('town_id', $request->town_id));
    }

    public function export_excel(Request $request)
    {

        $filteredQuery = $this->applyFilters($request);

        return Excel::download(new ApplicationsExport($filteredQuery), 'applications.xlsx');

    }

    public function export_pdf(Request $request)
    {
        $filteredQuery = $this->applyFilters($request);
        $applications = $filteredQuery->get();

        $pdf = Pdf::loadView('pdf.application', compact('applications'))->setPaper('a4', 'landscape');

        return $pdf->download('applications.pdf');
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'application_id' => 'required|exists:programs,id',
            'program_status_id' => 'required|exists:program_statuses,id',
        ]);

        $application = Program::findOrFail($request->application_id);
        $application->program_status_id = $request->program_status_id;
        $application->save();

        return redirect()->back()->with('success', 'Status uğurla dəyişdirildi.');
    }

}
