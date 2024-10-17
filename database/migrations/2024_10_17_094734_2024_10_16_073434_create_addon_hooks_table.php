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
        Schema::create('addon_hooks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('addon_id')->nullable()->constrained('addons')->onDelete('cascade');
            $table->string('app_route')->nullable();
            $table->string('addon_route')->nullable();
            $table->json('dom')->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('addon_hooks');
    }
};