<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\SettingDocument;
use Illuminate\Http\Request;

class SettingDocumentController extends Controller
{
    public function index(Request $request)
    {
        $education_levels = EducationLevel::all();


        $filteredQuery = $this->applyFilters($request);

        $count = $filteredQuery->count();

        $setting_documents = $filteredQuery->orderByDesc('created_at')
            ->paginate(10)->withQueryString();
        return view('settings.setting_documents.index', compact('setting_documents','education_levels','count'));
    }

    private function applyFilters(Request $request)
    {
        return SettingDocument::query()
            ->when($request->filled('education_level_id'), fn($q) => $q->where('education_level_id', $request->education_level_id));
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {

        return view('settings.setting_documents.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|max:255',
            'education_level_id' => 'required',
        ], [
            'title.required' => 'Sənəd adı doldurulmalıdır.',
            'education_level_id.required' => 'Təhsil pilləsi seçilməlidir.',
            'title.max' => 'Sənəd adı maksimum 255 simvol ola bilər.',
        ]);

        SettingDocument::create([
            'title' => $request->title,
            'education_level_id' => $request->education_level_id,
        ]);

        return redirect()->back()->with('message', 'Sənəd adı əlavə olundu.');

    }

    /**
     * Display the specified resource.
     */
    public function show(SettingDocument $setting_document)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SettingDocument $setting_document)
    {
        $education_levels = EducationLevel::all();
        return view('settings.setting_documents.edit', compact('setting_document','education_levels'));

    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, SettingDocument $setting_document)
    {
        $request->validate([
            'title' => 'required|max:255',
            'education_level_id' => 'required',
        ], [
            'title.required' => 'Sənəd adı doldurulmalıdır.',
            'education_level_id.required' => 'Təhsil pilləsi seçilməlidir.',
            'title.max' => 'Sənəd adı maksimum 255 simvol ola bilər.',
        ]);

        $setting_document->update([
            'title' => $request->title,
            'education_level_id' => $request->education_level_id,
        ]);

        return redirect()->back()->with('message', 'Sənəd adı dəyişdirildi.');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SettingDocument $setting_document)
    {

        $setting_document->delete();
        return redirect()->route('setting_documents.index')->with('message', 'Sənəd adı silindi.');

    }
}
