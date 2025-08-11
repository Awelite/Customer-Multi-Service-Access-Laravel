<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('providers', function (Blueprint $table) {
        $table->date('dob')->nullable();
        $table->string('gender')->nullable();
        $table->string('experience')->nullable();
        $table->text('message')->nullable();
        $table->string('photo_path')->nullable();
        $table->string('proof_document_path')->nullable();
        $table->text('full_address')->nullable();
        $table->text('postal_address')->nullable();
    });
}

public function down()
{
    Schema::table('providers', function (Blueprint $table) {
        $table->dropColumn([
            'dob', 'gender', 'experience', 'message',
            'photo_path', 'proof_document_path',
            'full_address', 'postal_address'
        ]);
    });
}

};
