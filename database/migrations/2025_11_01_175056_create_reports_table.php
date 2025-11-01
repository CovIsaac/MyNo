<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('project_id')->constrained();
            $table->foreignId('report_type_id')->constrained();
            $table->foreignId('priority_id')->constrained();
            $table->date('report_date');
            $table->text('body');
            $table->string('attachment')->nullable(); // Guardará la RUTA del archivo
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};