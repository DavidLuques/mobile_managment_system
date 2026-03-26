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
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            
            // Información del cliente
            $table->string('customer_name');
            $table->string('customer_phone')->nullable();
            $table->string('customer_email')->nullable();
            
            // Información del teléfono
            $table->string('phone_brand');
            $table->string('phone_model');
            $table->string('phone_color')->nullable();
            
            // Detalles de la reparación
            $table->text('problem_description');
            $table->text('technical_notes')->nullable();
            $table->decimal('repair_cost', 8, 2)->default(0);
            
            // Fechas de ingreso y egreso
            $table->dateTime('entrada_date');
            $table->dateTime('salida_date')->nullable();
            
            // Estado de la reparación
            $table->enum('status', ['pendiente', 'en_reparacion', 'reparado', 'no_reparable', 'entregado'])->default('pendiente');
            $table->text('observations')->nullable();
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
