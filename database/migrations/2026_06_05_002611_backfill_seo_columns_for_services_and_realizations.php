<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        $this->backfillTable('services');
        $this->backfillTable('realizations');
    }

    public function down(): void
    {
        $this->clearTable('services');
        $this->clearTable('realizations');
    }

    private function backfillTable(string $tableName): void
    {
        if (! $this->hasSeoColumns($tableName)) {
            return;
        }

        DB::table($tableName)
            ->select(['id', 'name', 'excerpt', 'content', 'meta_title', 'meta_description', 'meta_keywords'])
            ->chunkById(100, function ($records) use ($tableName): void {
                foreach ($records as $record) {
                    DB::table($tableName)
                        ->where('id', $record->id)
                        ->update([
                            'meta_title' => filled($record->meta_title) ? $record->meta_title : $this->title($record->name),
                            'meta_description' => filled($record->meta_description) ? $record->meta_description : $this->description($record->excerpt, $record->content),
                            'meta_keywords' => filled($record->meta_keywords) ? $record->meta_keywords : $this->keywords([$record->name, $record->excerpt, $record->content]),
                        ]);
                }
            });
    }

    private function clearTable(string $tableName): void
    {
        if (! $this->hasSeoColumns($tableName)) {
            return;
        }

        DB::table($tableName)->update([
            'meta_title' => null,
            'meta_description' => null,
            'meta_keywords' => null,
        ]);
    }

    private function hasSeoColumns(string $tableName): bool
    {
        return Schema::hasTable($tableName)
            && Schema::hasColumn($tableName, 'meta_title')
            && Schema::hasColumn($tableName, 'meta_description')
            && Schema::hasColumn($tableName, 'meta_keywords');
    }

    private function title(?string $title): string
    {
        $title = $this->plainText($title);

        return $title === '' ? 'FPROTECT' : "{$title} - FPROTECT";
    }

    private function description(?string ...$values): ?string
    {
        foreach ($values as $value) {
            $text = $this->plainText($value);

            if ($text !== '') {
                return Str::limit($text, 160, '');
            }
        }

        return null;
    }

    /**
     * @param  array<int, string|null>  $values
     */
    private function keywords(array $values): ?string
    {
        $keywords = ['FPROTECT'];
        $source = $this->plainText(implode(' ', array_filter($values)));

        if ($this->plainText($values[0] ?? null) !== '') {
            $keywords[] = $this->plainText($values[0]);
        }

        $stopWords = [
            'oraz', 'jest', 'dla', 'przez', 'przy', 'jako', 'jego', 'jej', 'ich', 'pod', 'nad', 'bez',
            'się', 'sie', 'nie', 'tak', 'jak', 'lub', 'czy', 'aby', 'które', 'ktore', 'których', 'ktorych',
            'państwa', 'panstwa', 'nasze', 'nasza', 'naszą', 'naszych', 'temu', 'tego', 'tym',
            'ten', 'tej', 'wraz', 'zakres', 'opis',
        ];

        foreach (preg_split('/[^\pL\pN]+/u', mb_strtolower($source)) ?: [] as $word) {
            if (mb_strlen($word) < 4 || in_array($word, $stopWords, true)) {
                continue;
            }

            $keywords[] = $word;
        }

        $keywords = array_values(array_unique(array_filter($keywords)));

        return $keywords === [] ? null : implode(', ', array_slice($keywords, 0, 10));
    }

    private function plainText(?string $value): string
    {
        return Str::of($value ?? '')
            ->stripTags()
            ->replace('&nbsp;', ' ')
            ->squish()
            ->toString();
    }
};
