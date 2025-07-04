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
        Schema::table('events', function (Blueprint $table) {
            $table->string('location')->nullable()->after('description');
            $table->decimal('price', 8, 2)->default(0.00)->after('location');
            $table->enum('status', ['draft', 'published', 'cancelled'])->default('published')->after('price');
            $table->foreignId('created_by')->nullable()->constrained('users')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropColumn(['location', 'price', 'status', 'created_by']);
        });
    }
};
