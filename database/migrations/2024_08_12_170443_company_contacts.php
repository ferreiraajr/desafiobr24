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
        Schema::create('company_contacts', function (Blueprint $table) {
            $table->unsignedBigInteger("ID")->primary();
            $table->unsignedBigInteger("COMPANY_ID");
            $table->unsignedBigInteger("CONTACT_ID");
            $table->timestamps();

            $table->foreign('COMPANY_ID')->references('ID')->on('companies')->onDelete('cascade');
            $table->foreign('CONTACT_ID')->references('ID')->on('contacts')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
