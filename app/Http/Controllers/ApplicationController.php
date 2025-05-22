<?php

namespace App\Http\Controllers;

use App\Enums\UserType;
use App\Exports\ApplicationsExport;
use App\Models\Program;
use App\Models\Settings\Country;
use App\Models\Settings\EducationLanguage;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\Period;
use App\Models\Settings\ProgramStatus;
use App\Models\Settings\SchoolType;
use App\Models\Settings\UniversityList;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Exception;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ApplicationController extends Controller
{
    private function applyFilters(Request $request)
    {
        $user = auth()->user();

        return Program::query()->whereHas('user')
            ->filterByUser($user)
            ->when($request->filled('user_id'), fn ($q) => $q->FilterByStudent($request->user_id))
            ->when($request->filled('agent_id'), fn ($q) => $q->filterByAgentIds($request->agent_id))
            ->when($request->filled('university_list_id'), fn ($q) => $q->filterByUniversity($request->university_list_id))
            ->when($request->filled('period_id'), fn ($q) => $q->filterByPeriod($request->period_id))
            ->when($request->filled('education_level_id'), fn ($q) => $q->filterByEducationLevel($request->education_level_id))
            ->when($request->filled('country_id'), fn ($q) => $q->filterByCountry($request->country_id))
            ->when($request->filled('program_status_id'), fn ($q) => $q->filterByProgramStatus($request->program_status_id))
            ->when($request->filled('profession_id'), fn ($q) => $q->filterByProfession($request->profession_id));
    }

    public function index(Request $request)
    {
        try {
            $filteredQuery = $this->applyFilters($request);

            $applications = $filteredQuery->orderByDesc('created_at')
                ->paginate(10)->withQueryString();

            $education_levels    = EducationLevel::with('school_types')->get();
            $education_languages = EducationLanguage::all();
            $school_types        = SchoolType::all();
            $university_lists    = UniversityList::all();
            $countries           = Country::all();
            $periods             = Period::all();
            $program_statuses    = ProgramStatus::all();
            $agents              = User::query()->where('type', UserType::AGENT)->get();
            $users               = User::query()->where('type', UserType::STUDENT)->orderByDesc('id')->get();

            return view('applications.index', compact(
                'applications',
                'education_levels',
                'education_languages',
                'periods',
                'program_statuses',
                'school_types',
                'university_lists',
                'countries',
                'agents',
                'users'
            ));
        } catch (Exception $exception) {
            return $exception->getMessage();
        }
    }

    public function export_excel(Request $request)
    {
        $filteredQuery = $this->applyFilters($request);

        return Excel::download(new ApplicationsExport($filteredQuery), 'applications.xlsx');
    }

    public function export_pdf(Request $request)
    {
        $filteredQuery = $this->applyFilters($request);
        $applications  = $filteredQuery->get();

        $pdf = Pdf::loadView('pdf.application', compact('applications'))->setPaper('a4', 'landscape');

        return $pdf->download('applications.pdf');
    }

    public function changeStatus(Request $request)
    {
        $request->validate([
            'application_id'    => 'required|exists:programs,id',
            'program_status_id' => 'required|exists:program_statuses,id',
        ]);

        $application                    = Program::findOrFail($request->application_id);
        $application->program_status_id = $request->program_status_id;
        $application->save();

        return redirect()->back()->with('success', 'Status uğurla dəyişdirildi.');
    }
}
