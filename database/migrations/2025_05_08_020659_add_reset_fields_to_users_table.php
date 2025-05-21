<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddResetFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('reset_token', 255)
                  ->nullable()
                  ->after('notification_token');
            $table->timestamp('reset_token_created_at')
                  ->nullable()
                  ->after('reset_token');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['reset_token', 'reset_token_created_at']);
        });
    }
}
