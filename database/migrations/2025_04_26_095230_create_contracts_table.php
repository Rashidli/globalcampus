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
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Tələbənin ID-si
            $table->string('customer_name'); // 1. Sifarişçi
            $table->string('customer_identity_number')->nullable(); // 2. Sifarişçi Kimlik No
            $table->string('relative_mobile')->nullable(); // 3. Mobil nömrə (yaxını)
            $table->string('whatsapp_number')->nullable(); // 4. Whatsapp nömrə
            $table->text('address')->nullable(); // 5. Ünvan
            $table->enum('education_level', ['Bakalavriat(Əyani)', 'Bakalavriat(Qiyabi)', 'Magistratura', 'Doktorantura', 'Türk Dili İmtahanı']); // 6. Müraciət Ediləcək Təhsil Pilləsi
            $table->string('service')->default('Rəsmi Qəbulun Alınması'); // 7. Xidmət
            $table->decimal('service_price', 10, 2)->nullable(); // 8. Xidmətin dəyəri
            $table->decimal('initial_payment', 10, 2)->nullable(); // 9. İlkin ödəniş
            $table->decimal('remaining_amount', 10, 2)->nullable(); // 10. Qalıq məbləğ
            $table->foreignId('university_id')->nullable()->constrained('universities'); // 11. Universitet seçimi (Bazadan)
            $table->json('majors')->nullable(); // 12. İxtisas seçimi (JSON şəkildə saxlayacağıq çünki birdən çox ola bilər)
            $table->string('country')->default('Türkiye'); // Ölkə
            $table->string('verification_code')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contracts');
    }
};
