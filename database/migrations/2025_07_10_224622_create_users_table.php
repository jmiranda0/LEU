<?php

use App\Enum\UserRoleEnum;
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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); //identificador unico del usuario
            $table->string('name'); //nombre del usuario
            $table->string('email')->unique(); //email del usuario
            $table->enum('role', UserRoleEnum::getValues()); //rol del usuario
            $table->timestamps(); //created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
