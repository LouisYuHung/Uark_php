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
        Schema::create('orgs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('org_no');
            $table->time('created_at');
            $table->time('updated_at');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('org_id');
            $table->string('name');
            $table->date('birthday');
            $table->string('email');
            $table->string('account');
            $table->string('password');
            $table->number('status');
            $table->time('created_at');
            $table->time('updated_at');
        });

        Schema::create('apply_file', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->string('file_path');
            $table->time('created_at');
            $table->time('updated_at');
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
