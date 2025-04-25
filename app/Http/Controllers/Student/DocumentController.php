<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Settings\EducationLevel;
use App\Models\Settings\SettingDocument;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Settings;
use PhpParser\Comment\Doc;
use Illuminate\Support\Facades\File;
class DocumentController extends Controller
{
    public function index($student_id)
    {
        $user = User::query()->with('documents')->findOrFail($student_id);
        $documents = $user->documents()->orderByDesc('id')->get();
        $education_levels = EducationLevel::all();
        return view('students.documents.index', compact('documents', 'user', 'education_levels'));
    }

    public function create(Request $request)
    {
        $education_level = EducationLevel::query()->with('setting_documents')->findOrFail($request->education_level_id);
        $user = User::query()->findOrFail($request->user_id);
        return view('students.documents.create', compact('education_level', 'user'));
    }

    public function fileUpload(Request $request)
    {
        try {

            foreach ($request->file('file') as $index => $uploadedFile) {
                $title = $request->title[$index] ?? 'Sənəd';

                $filename = Str::slug($title) . '-' . $request->user_id . '.' . $uploadedFile->getClientOriginalExtension();

                $uploadedFile->move(public_path('files'), $filename);

                Document::create([
                    'user_id' => $request->user_id,
                    'file_title' => $request->file_title,
                    'title' => $title,
                    'file' => $filename,
                ]);
            }
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return redirect()->route('documents.index', $request->user_id)->with('message', 'Fayl uğurla əlavə edildi');
    }

    public function update(Request $request, $id)
    {
        $document = Document::findOrFail($id);
        $user = User::findOrFail($request->user_id);

        $fileTitle = $request->file_title;
        $title = $request->title;

        $data = [
            'file_title' => $fileTitle,
            'title' => $title,
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');

            $filename = Str::slug($title) . '-' . $user->id . '.' . $file->getClientOriginalExtension();

            $oldFilePath = public_path('files/' . $document->file);
            if (File::exists($oldFilePath)) {
                File::delete($oldFilePath);
            }

            $file->move(public_path('files'), $filename);

            $data['file'] = $filename;
        }

        $document->update($data);

        return redirect()->route('documents.index', $request->user_id)
            ->with('message', 'Fayl uğurla dəyişdirildi');
    }

    public function edit($id)
    {

        $document = Document::query()->findOrFail($id);
        $user = User::query()->findOrFail($document->user_id);
        $education_levels = EducationLevel::all();
        $education_level_id = EducationLevel::query()->where('title', $document->file_title)->first();
        $setting_documents = SettingDocument::query()->where('education_level_id', $education_level_id->id)->get();
        return view('students.documents.edit', compact('document', 'user', 'education_levels', 'setting_documents'));

    }

    public function deleteFile(Request $request, $id)
    {
        $document = Document::query()->findOrFail($id);

        $filePath = public_path('files/' . $document->file);

        if (file_exists($filePath) && is_file($filePath)) {
            unlink($filePath);
        }

        $document->delete();

        return redirect()->route('documents.index', $document->user_id)->with('message', 'Fayl uğurla silindi');
    }
}
