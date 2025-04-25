<?php

namespace App\Http\Services;

use App\Enums\StudentStatus;
use App\Enums\UserType;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserService
{
    public function createUser(array $data): User
    {
        $data['email'] = $data['email'] ?? strtolower($data['name'] . '.' . $data['surname'] . '@gmail.com');

        $data['password'] = $data['password'] ?? 'password123';

        if(isset($data['image'])){

            $file = $data['image'];

            $filename = Str::uuid() .  '.' . $file->getClientOriginalExtension();

            $file->move(public_path('files'), $filename);
        }

        $user = User::create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'phone' => $data['phone'],
            'agent_id' => $data['agent_id'],
            'type' => UserType::STUDENT,
            'password' => Hash::make($data['password']),
            'email' => $data['email'],
            'image' => $filename ?? null,
        ]);

        $data['marital_status'] = $data['marital_status'] ?? null;
        $data['gender'] = $data['gender'] ?? null;


        $user->student_info()->create([
            'contact_email' => $data['contact_email'] ?? null,
            'father_name' => $data['father_name'],
            'mother_name' => $data['mother_name'],
            'birthday' => $data['birthday'],
            'passport_number' => $data['passport_number'],
            'citizenship' => $data['citizenship'],
            'identity_number' => $data['identity_number'],
            'address' => $data['address'] ?? null,
            'marital_status' => $data['marital_status'],
            'gender' => $data['gender'],
        ]);

        return $user;
    }


    // UserService.php

    public function addOrUpdateEducations(User $user, array $educations): void
    {
        // Get the IDs of existing educations from the database
        $existingEducationIds = $user->educations()->pluck('id')->toArray();

        // Collect the IDs from the submitted education data
        $submittedEducationIds = array_column($educations, 'education_id');

        // Determine the IDs to delete (those in the database but not in the submitted data)
        $idsToDelete = array_diff($existingEducationIds, array_filter($submittedEducationIds));

        // Delete the educations that are no longer present in the submitted data
        if (!empty($idsToDelete)) {
            $user->educations()->whereIn('id', $idsToDelete)->delete();
        }

        // Add or update the submitted educations
        foreach ($educations as $education) {
            if (isset($education['education_id']) && in_array($education['education_id'], $existingEducationIds)) {
                // Update existing education
                $user->educations()->where('id', $education['education_id'])->update([
                    'university' => $education['university'],
                    'gno' => $education['gno'],
                    'degree' => $education['degree'],
                    'profession' => $education['profession'],
                    'faculty' => $education['faculty'],
                    'university_start_date' => $education['university_start_date'],
                    'university_end_date' => $education['university_end_date'],
                ]);
            } else {
                // Create a new education entry if it doesn't have an ID
                if (!empty($education['degree'])) {
                    $user->educations()->create([
                        'university' => $education['university'],
                        'gno' => $education['gno'],
                        'degree' => $education['degree'],
                        'profession' => $education['profession'],
                        'faculty' => $education['faculty'],
                        'university_start_date' => $education['university_start_date'],
                        'university_end_date' => $education['university_end_date'],
                    ]);
                }
            }
        }
    }


    public function addOrUpdateExperiences(User $user, array $experiences): void
    {
        // Get existing IDs from the database
        $existingExperienceIds = $user->experiences()->pluck('id')->toArray();
        // Collect submitted IDs
        $submittedExperienceIds = array_column($experiences, 'experience_id');
        // Determine IDs to delete
        $idsToDelete = array_diff($existingExperienceIds, array_filter($submittedExperienceIds));

        // Delete experiences not in the submitted data
        if (!empty($idsToDelete)) {
            $user->experiences()->whereIn('id', $idsToDelete)->delete();
        }

        // Add or update experiences
        foreach ($experiences as $experience) {
            if (isset($experience['experience_id']) && in_array($experience['experience_id'], $existingExperienceIds)) {
                $user->experiences()->where('id', $experience['experience_id'])->update([
                    'experience_company' => $experience['experience_company'],
                    'position' => $experience['position'],
                    'experience_start_date' => $experience['experience_start_date'],
                    'experience_end_date' => $experience['experience_end_date'],
                ]);
            } else {
                if (!empty($experience['experience_company'])) {
                    $user->experiences()->create([
                        'experience_company' => $experience['experience_company'],
                        'position' => $experience['position'],
                        'experience_start_date' => $experience['experience_start_date'],
                        'experience_end_date' => $experience['experience_end_date'],
                    ]);
                }
            }
        }
    }

    public function addOrUpdateLanguages(User $user, array $languages): void
    {
        $existingLanguageIds = $user->languages()->pluck('id')->toArray();
        $submittedLanguageIds = array_column($languages, 'language_id');
        $idsToDelete = array_diff($existingLanguageIds, array_filter($submittedLanguageIds));

        if (!empty($idsToDelete)) {
            $user->languages()->whereIn('id', $idsToDelete)->delete();
        }

        foreach ($languages as $language) {
            if (isset($language['language_id']) && in_array($language['language_id'], $existingLanguageIds)) {
                $user->languages()->where('id', $language['language_id'])->update([
                    'language' => $language['language'],
                    'level' => $language['level'],
                ]);
            } else {
                if (!empty($language['language'])) {
                    $user->languages()->create([
                        'language' => $language['language'],
                        'level' => $language['level'],
                    ]);
                }
            }
        }
    }

    public function addOrUpdatePrograms(User $user, array $programs): void
    {
        $existingProgramIds = $user->programs()->pluck('id')->toArray();
        $submittedProgramIds = array_column($programs, 'program_id');
        $idsToDelete = array_diff($existingProgramIds, array_filter($submittedProgramIds));

        if (!empty($idsToDelete)) {
            $user->programs()->whereIn('id', $idsToDelete)->delete();
        }

        foreach ($programs as $program) {
            if (isset($program['program_id']) && in_array($program['program_id'], $existingProgramIds)) {
                $user->programs()->where('id', $program['program_id'])->update([
                    'program_education' => $program['program_education'],
                    'country' => $program['country'],
                    'program_university' => $program['program_university'],
                    'program_profession' => $program['program_profession'],
                    'program_date' => $program['program_date'],
                    'donem' => $program['donem'],
                    'donem_start' => $program['donem_start'],
                    'donem_end' => $program['donem_end'],
                ]);
            } else {
                if (!empty($program['program_education'])) {
                    $user->programs()->create([
                        'program_education' => $program['program_education'],
                        'country' => $program['country'],
                        'program_university' => $program['program_university'],
                        'program_profession' => $program['program_profession'],
                        'program_date' => $program['program_date'],
                        'donem' => $program['donem'],
                        'donem_start' => $program['donem_start'],
                        'donem_end' => $program['donem_end'],
                    ]);
                }
            }
        }
    }



    public function addDocuments(User $user, array $files, array $fileTitles, array $titles): void
    {
        foreach ($files as $index => $file) {
            $filename = $file->getClientOriginalName();

            $file->move(public_path('files'), $filename);

            $user->documents()->create([
                'file_title' => $fileTitles[0],
                'title' => $titles[$index] ?? 'Untitled',
                'file' => $filename, // Store only the file name in the database
            ]);
        }
    }


}
