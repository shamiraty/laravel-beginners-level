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
    Schema::create('products', function (Blueprint $table) {
        $table->id();
        $table->string('product_name');
        $table->date('registered_date');
        $table->decimal('purchasing_price', 10, 2);
        $table->decimal('selling_price', 10, 2);
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        $table->string('status');
        $table->foreignId('region_id')->constrained('regions')->onDelete('cascade');
        $table->foreignId('district_id')->constrained('districts')->onDelete('cascade');
        $table->date('expiry_date');
        $table->timestamps();
    });
}

    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
