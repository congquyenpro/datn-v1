<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('tb_transactions', function (Blueprint $table) {
            $table->id();
            $table->string('gateway');
            $table->timestamp('transaction_date');
            $table->string('account_number')->nullable();
            $table->string('sub_account')->nullable();
            $table->decimal('amount_in', 20, 2)->default(0.00);
            $table->decimal('amount_out', 20, 2)->default(0.00);
            $table->decimal('accumulated', 20, 2)->default(0.00);
            $table->string('code')->nullable();
            $table->text('transaction_content')->nullable();
            $table->string('reference_number')->nullable();
            $table->text('body')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tb_transactions');
    }
}
