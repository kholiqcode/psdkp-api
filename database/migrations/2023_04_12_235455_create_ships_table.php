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
        Schema::create('ships', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('code')->unique();
            $table->string('name');
            $table->string('owner_name');
            $table->string('owner_street_address');
            $table->unsignedBigInteger('ship_size')->comment('in meters');
            $table->string('photo_path');
            $table->unsignedInteger('total_crew');
            $table->string('permission_number');
            $table->string('permission_document_path');
            $table->boolean('is_verified')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ships');
    }
};
