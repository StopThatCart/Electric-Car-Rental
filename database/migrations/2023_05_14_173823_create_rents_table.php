<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Offer;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Offer::class)->constrained();
            $table->foreignIdFor(User::class)->constrained()->onDelete('cascade');
            $table->decimal('cost');
            $table->date('date_rent', 30);
            $table->date('date_return', 30);
            $table->enum('state', ['In progress', 'Waiting for you', 'Rented', 'Returned', 'Canceled']);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rents');
    }
};
