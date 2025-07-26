<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStripeFieldsToOrdersTable extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('stripe_payment_intent_id')->nullable()->after('razorpay_signature');
            $table->string('stripe_payment_method_id')->nullable()->after('stripe_payment_intent_id');
            $table->string('stripe_client_secret')->nullable()->after('stripe_payment_method_id');
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'stripe_payment_intent_id',
                'stripe_payment_method_id',
                'stripe_client_secret',
            ]);
        });
    }
}
