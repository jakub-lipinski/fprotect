<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        $this->addSeoColumns('services');
        $this->addSeoColumns('realizations');
    }

    public function down(): void
    {
        $this->dropSeoColumns('services');
        $this->dropSeoColumns('realizations');
    }

    private function addSeoColumns(string $tableName): void
    {
        if (! Schema::hasTable($tableName)) {
            return;
        }

        Schema::table($tableName, function (Blueprint $table) use ($tableName): void {
            if (! Schema::hasColumn($tableName, 'meta_title')) {
                $table->string('meta_title')->nullable();
            }

            if (! Schema::hasColumn($tableName, 'meta_description')) {
                $table->text('meta_description')->nullable();
            }

            if (! Schema::hasColumn($tableName, 'meta_keywords')) {
                $table->text('meta_keywords')->nullable();
            }
        });
    }

    private function dropSeoColumns(string $tableName): void
    {
        if (! Schema::hasTable($tableName)) {
            return;
        }

        $columns = array_values(array_filter([
            Schema::hasColumn($tableName, 'meta_title') ? 'meta_title' : null,
            Schema::hasColumn($tableName, 'meta_description') ? 'meta_description' : null,
            Schema::hasColumn($tableName, 'meta_keywords') ? 'meta_keywords' : null,
        ]));

        if ($columns === []) {
            return;
        }

        Schema::table($tableName, function (Blueprint $table) use ($columns): void {
            $table->dropColumn($columns);
        });
    }
};
