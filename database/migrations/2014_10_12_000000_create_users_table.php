<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('status')->default('active');
            $table->string('password_changed')->default('0');
            $table->foreignId('role_id')->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('department_id')->nullable()->constrained()->onDelete('cascade')->onUpdate('cascade');
            $table->string('image')->nullable();
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->text('about_me')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });

        User::create([
            'id' => 1,
            'name' => 'Darren',
            'email' => 'darrenassah@yahoo.com',
            'role_id' => 2,
            'password' => Hash::make('darren'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
