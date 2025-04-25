<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_infos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('address')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->date('birthday')->nullable();
            $table->string('marital_status')->nullable();
            $table->string('gender')->nullable();
            $table->string('contact_email')->nullable();
            $table->enum('status',[
                'WAITING',
                'IN_PROGRESS',
                'APPLIED',
                'MISSING_DOCUMENT',
                'ACCEPTED',
                'PENDING_REGISTRATION',
                'REJECTED',
                'SECOND_STEP',
                'WILL_ATTEND_INTERVIEW'
            ])->default('WAITING')->comment('1. Gözləyir 2. İcradadır 3.
             Müraciət olunub 4. Əksik Sənəd 5. Qəbul 6. Qeydiyyat Gözləyir 7.
              İmtina 8. İkinci Tur 9. Mülakata Girəcək')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_infos');
    }
};
