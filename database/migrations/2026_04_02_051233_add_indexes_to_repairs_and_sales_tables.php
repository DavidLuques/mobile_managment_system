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
        Schema::table('repairs', function (Blueprint $table) {
            $table->index('status');
            $table->index('customer_name');
            $table->index('phone_brand');
            $table->index('phone_model');
        });

        Schema::table('sale_phones', function (Blueprint $table) {
            $table->index('status');
            $table->index('brand');
            $table->index('model');
            $table->index('sold_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('repairs', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['customer_name']);
            $table->dropIndex(['phone_brand']);
            $table->dropIndex(['phone_model']);
        });

        Schema::table('sale_phones', function (Blueprint $table) {
            $table->dropIndex(['status']);
            $table->dropIndex(['brand']);
            $table->dropIndex(['model']);
            $table->dropIndex(['sold_at']);
        });
    }
};
