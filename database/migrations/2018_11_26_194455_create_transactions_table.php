<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->increments('id');
            $table->timestamps();
            $table->integer('account_id');
            $table->integer('category_id');
            $table->integer('user_id');
            $table->decimal('sum_amount', 30);
            $table->integer('currency')->default('643');
            $table->timestamp('date')->default(DB::raw('CURRENT_TIMESTAMP'));

            $table->index(['user_id', 'account_id'], 'user_account_index');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
