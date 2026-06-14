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
        Schema::create('berita_acara', function (Blueprint $table) {
            $table->id();
            $table->string('nomor', 100)->unique();
            $table->foreignId('customer_id')->constrained('customers')->onDelete('cascade');
            $table->date('tanggal');
            $table->enum('jenis', ['Serah Terima', 'Instalasi', 'Maintenance', 'Pekerjaan Selesai']);
            $table->longText('isi');
            $table->timestamps();

            $table->index(['nomor', 'customer_id', 'tanggal', 'jenis']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita_acara');
    }
};