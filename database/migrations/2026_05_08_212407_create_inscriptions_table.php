    <?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('inscriptions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('evenement_id')->constrained()->onDelete('cascade');
            $table->dateTime('date_inscription');
            $table->enum('statut', ['confirmée', 'liste_attente', 'annulée'])->default('confirmée');
            $table->timestamps();
        });
    }
    public function down(): void {
        Schema::dropIfExists('inscriptions');
    }
};