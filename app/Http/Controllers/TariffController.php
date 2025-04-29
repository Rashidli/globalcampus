<?php

namespace App\Http\Controllers;

use App\Exports\TariffsExport;
use App\Models\Settings\Country;
use App\Models\Settings\Currency;
use App\Models\Settings\EducationCost;
use App\Models\Settings\EducationLanguage;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\Profession;
use App\Models\Settings\SchoolType;
use App\Models\Settings\Town;
use App\Models\Settings\UniversityEducationLevel;
use App\Models\Settings\UniversityList;
use App\Models\Tariff;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class TariffController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:list-tariffs|create-tariffs|edit-tariffs|delete-tariffs', ['only' => ['index', 'show']]);
        $this->middleware('permission:create-tariffs', ['only' => ['create', 'store']]);
        $this->middleware('permission:edit-tariffs', ['only' => ['edit']]);
        $this->middleware('permission:delete-tariffs', ['only' => ['destroy']]);
    }

    private function applyFilters(Request $request)
    {
        return Tariff::query()
            ->when($request->filled('university_list_id'), fn ($q) => $q->whereIn('university_list_id', $request->university_list_id))
            ->when($request->filled('education_level_id'), fn ($q) => $q->where('education_level_id', $request->education_level_id))
            ->when($request->filled('school_type_id'), fn ($q) => $q->whereIn('school_type_id', $request->school_type_id))
            ->when($request->filled('country_id'), fn ($q) => $q->whereIn('country_id', $request->country_id))
            ->when($request->filled('profession_id'), fn ($q) => $q->whereIn('profession_id', $request->profession_id))
            ->when($request->filled('education_language_id'), fn ($q) => $q->whereIn('education_language_id', $request->education_language_id))
            ->when($request->filled('currency_id'), fn ($q) => $q->whereIn('currency_id', $request->currency_id))
            ->when($request->filled('town_id'), fn ($q) => $q->whereIn('town_id', $request->town_id))
            ->when($request->filled(['min_price', 'max_price']), function ($q) use ($request): void {
                $q->whereBetween('discounted_price', [$request->min_price, $request->max_price]);
            });
    }

    public function index(Request $request)
    {
        //        dd($request->all());
        $filteredQuery = $this->applyFilters($request);

        $count = $filteredQuery->count();

        $tariffs = $filteredQuery->orderByDesc('created_at')
            ->paginate(10)->withQueryString();

        $education_levels            = EducationLevel::with('school_types')->get();
        $towns                       = Town::all();
        $professions                 = Profession::all();
        $education_languages         = EducationLanguage::all();
        $school_types                = SchoolType::all();
        $university_lists            = UniversityList::all();
        $countries                   = Country::all();
        $currencies                  = Currency::all();
        $university_education_levels = UniversityEducationLevel::all();

        return view('tariffs.index', compact(
            'tariffs',
            'education_levels',
            'towns',
            'professions',
            'education_languages',
            'count',
            'school_types',
            'university_lists',
            'countries',
            'currencies',
            'university_education_levels'
        ));
    }

    public function export_excel(Request $request)
    {
        $filteredQuery = $this->applyFilters($request);

        return Excel::download(new TariffsExport($filteredQuery), 'universities.xlsx');
    }

    //    public function export_pdf(Request $request)
    //    {
    //
    //        $filteredQuery = $this->applyFilters($request);
    //        return Excel::download(new TariffsExport($filteredQuery), 'universities.pdf',\Maatwebsite\Excel\Excel::MPDF);
    //    }

    public function export_pdf(Request $request)
    {
        $filteredQuery = $this->applyFilters($request);
        $tariffs       = $filteredQuery->get();

        $pdf = Pdf::loadView('pdf.tariff', compact('tariffs'))->setPaper('a4', 'landscape');

        return $pdf->download('tariffs.pdf');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $education_levels    = EducationLevel::query()->with('school_types')->get();
        $towns               = Town::all();
        $professions         = Profession::all();
        $education_languages = EducationLanguage::all();
        $university_lists    = UniversityList::all();
        $countries           = Country::all();
        $currencies          = Currency::all();
        $education_costs     = EducationCost::all();

        return view('tariffs.create', compact(
            'education_languages',
            'towns',
            'education_levels',
            'professions',
            'university_lists',
            'countries',
            'currencies',
            'education_costs'
        ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'education_level_id'    => 'nullable',
            'school_type_id'        => 'nullable',
            'university_list_id'    => 'nullable',
            'education_language_id' => 'nullable',
            'town_id'               => 'nullable',
            'country_id'            => 'nullable',
            'currency_id'           => 'nullable',
            'profession_id'         => 'required|array',
            'profession_id.*'       => 'exists:professions,id',
            'price'                 => 'required|array',
            'price.*'               => 'required|numeric|min:0',
        ], [
            'price.numeric' => 'Yalnız rəqəm daxil edin.',
        ]);

        $selectedProfessions = $request->input('profession_id');
        $prices              = $request->input('price');
        $discountedPrices    = $request->input('discounted_price');

        foreach ($selectedProfessions as $professionId) {
            $professionPrice           = $prices[$professionId]           ?? null;
            $professionDiscountedPrice = $discountedPrices[$professionId] ?? null;
            if ($professionPrice) {
                Tariff::create([
                    'education_level_id'    => $request->education_level_id,
                    'school_type_id'        => $request->school_type_id,
                    'education_language_id' => $request->education_language_id,
                    'town_id'               => $request->town_id,
                    'university_list_id'    => $request->university_list_id,
                    'country_id'            => $request->country_id,
                    'currency_id'           => $request->currency_id,
                    'profession_id'         => $professionId,
                    'price'                 => $professionPrice,
                    'discounted_price'      => $professionDiscountedPrice,
                ]);
            }
        }

        return redirect()->route('tariffs.index')->with('message', 'Yeni umiversitet əlavə olundu.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tariff $tariff): void {}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tariff $tariff)
    {
        $education_levels    = EducationLevel::query()->with('school_types')->get();
        $towns               = Town::all();
        $professions         = Profession::all();
        $education_languages = EducationLanguage::all();
        $university_lists    = UniversityList::all();
        $countries           = Country::all();
        $currencies          = Currency::all();

        return view('tariffs.edit', compact(
            'tariff',
            'education_languages',
            'education_levels',
            'towns',
            'professions',
            'university_lists',
            'countries',
            'currencies'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tariff $tariff)
    {
        $request->validate([
            'education_level_id'    => 'nullable',
            'school_type_id'        => 'nullable',
            'education_language_id' => 'nullable',
            'university_list_id'    => 'nullable',
            'country_id'            => 'nullable',
            'profession_id'         => 'nullable',
            'currency_id'           => 'nullable',
            'town_id'               => 'nullable',
            'price'                 => 'numeric',
            'discounted_price'      => 'numeric',
        ], [
            'price.numeric'            => 'Yalnız rəqəm daxil edin.',
            'discounted_price.numeric' => 'Yalnız rəqəm daxil edin.',
        ]);

        $tariff->update([
            'education_level_id'    => $request->education_level_id,
            'school_type_id'        => $request->school_type_id,
            'education_language_id' => $request->education_language_id,
            'profession_id'         => $request->profession_id,
            'country_id'            => $request->country_id,
            'town_id'               => $request->town_id,
            'currency_id'           => $request->currency_id,
            'university_list_id'    => $request->university_list_id,
            'price'                 => $request->price,
            'discounted_price'      => $request->discounted_price,
        ]);

        return redirect()->route('tariffs.index', request()->query())->with('message', 'Mövcud universitet dəyişdirildi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tariff $tariff)
    {
        $tariff->delete();

        return redirect()->route('tariffs.index', request()->query())->with('message', 'Universitet silindi.');
    }

    public function allEdit($university_id)
    {
        $tariffs     = Tariff::query()->where('university_list_id', $university_id)->get();
        $university  = UniversityList::query()->findOrFail($university_id);
        $currencies  = Currency::all();
        $professions = Profession::all();

        return view('tariffs.all_edit', compact(
            'tariffs',
            'currencies',
            'university',
            'professions'
        ));
    }

    public function allUpdate(Request $request, $university_id)
    {
        $request->validate([
            'profession_id'    => 'required|array',
            'price'            => 'required|array',
            'discounted_price' => 'required|array',
            'currency_id'      => 'required|array',
        ]);

        foreach ($request->profession_id as $index => $professionId) {
            Tariff::where('university_list_id', $university_id)
                ->where('profession_id', $professionId)
                ->update([
                    'price'            => $request->price[$index],
                    'discounted_price' => $request->discounted_price[$index],
                    'currency_id'      => $request->currency_id[$index],
                ]);
        }

        return redirect()
            ->route('tariffs.index', request()->query())
            ->with('message', 'Universitet qiymətləri dəyişdirildi.');
    }

    public function tariff()
    {
        return view('tariff.index');
    }
}
