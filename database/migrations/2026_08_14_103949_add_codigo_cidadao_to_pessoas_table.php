
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('pessoas', function (Blueprint $table) {
            $table->string('codigo_cidadao', 50)
                ->unique()
                ->nullable()
                ->after('user_id');
        });
    }

    public function down(): void
    {
        Schema::table('pessoas', function (Blueprint $table) {
            $table->dropUnique(['codigo_cidadao']);
            $table->dropColumn('codigo_cidadao');
        });
    }
};
