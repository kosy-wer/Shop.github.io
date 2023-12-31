<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEcommerceTables extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('Product_Name');
            $table->decimal('Price', 10, 2);
            $table->text('Description');
            // $table->unsignedBigInteger('Category_ID'); // Jika ingin menambahkan foreign key
            // $table->foreign('Category_ID')->references('id')->on('categories');
            $table->timestamps();
        });

        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('Customer_Name');
            $table->string('Email');
            $table->string('Address');
            $table->string('Phone_Number');
            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Customer_ID');
            $table->foreign('Customer_ID')->references('id')->on('customers');
            $table->date('Order_Date');
            $table->decimal('Total_Amount', 10, 2);
            $table->timestamps();
        });

        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('Order_ID');
            $table->unsignedBigInteger('Product_ID');
            $table->foreign('Order_ID')->references('id')->on('orders');
            $table->foreign('Product_ID')->references('id')->on('products');
            $table->integer('Quantity');
            $table->decimal('Unit_Price', 10, 2);
            $table->decimal('Subtotal', 10, 2);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_details');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('customers');
        Schema::dropIfExists('products');
    }
}

