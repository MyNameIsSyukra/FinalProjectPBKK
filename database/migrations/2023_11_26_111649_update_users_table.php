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
        //
        Schema::table('users',function(Blueprint $table){
            $table->string('address')->nullable()->change();
            $table->string('phoneNumber')->nullable()->change();
            $table->string('role')->default('Buyer')->change();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users',function (Blueprint $table){
            $table->string('address')->change();
            $table->string('phoneNumber')->change();
            $table->string('role')->change();
        });
        //
    }
};
