<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserSubscriptionFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
 */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('stripe_customer_id')->unique()->nullable()->after('email');
            $table->enum('status',['active','inactive'])->default('active')->after('stripe_customer_id');
            $table->integer('message_credits')->default(0)->after('status');
            $table->timestamp('next_renewal_at')->nullable()->after('message_credits');
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
            $table->dropColumn('stripe_customer_id');
            $table->dropColumn('message_credits');
            $table->dropColumn('next_renewal_at');
            $table->dropColumn('status');
        });
    }
}
