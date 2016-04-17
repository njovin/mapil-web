<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUuids extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('uuid')->unique()->nullable()->after('id');
        });
        Schema::table('api_credentials', function (Blueprint $table) {
            $table->string('uuid')->unique()->nullable()->after('id');
        });
        Schema::table('email_addresses', function (Blueprint $table) {
            $table->string('uuid')->unique()->nullable()->after('id');
        });                
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
        Schema::table('api_credentials', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });
        Schema::table('email_addresses', function (Blueprint $table) {
            $table->dropColumn('uuid');
        });                
    }
}
