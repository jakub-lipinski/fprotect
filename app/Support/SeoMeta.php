<?php

namespace App\Support;

use Illuminate\Support\Str;

class SeoMeta
{
    public const SiteName = 'FPROTECT';

    public static function title(?string $title): string
    {
        $title = self::plainText($title);

        return $title === '' ? self::SiteName : "{$title} - ".self::SiteName;
    }

    public static function description(?string ...$values): ?string
    {
        foreach ($values as $value) {
            $text = self::plainText($value);

            if ($text !== '') {
                return Str::limit($text, 160, '');
            }
        }

        return null;
    }

    /**
     * @param  array<int, string|null>  $values
     */
    public static function keywords(array $values, int $limit = 10): ?string
    {
        $keywords = [self::SiteName];
        $source = self::plainText(implode(' ', array_filter($values)));
        $primaryKeyword = self::plainText($values[0] ?? null);

        if ($primaryKeyword !== '') {
            $keywords[] = $primaryKeyword;
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

        return $keywords === [] ? null : implode(', ', array_slice($keywords, 0, $limit));
    }

    /**
     * @return array{title: string, description: string|null, keywords: string|null}
     */
    public static function forContent(
        ?string $name,
        ?string $excerpt,
        ?string $content,
        ?string $metaTitle = null,
        ?string $metaDescription = null,
        ?string $metaKeywords = null,
    ): array {
        return [
            'title' => filled($metaTitle) ? self::plainText($metaTitle) : self::title($name),
            'description' => filled($metaDescription) ? self::description($metaDescription) : self::description($excerpt, $content),
            'keywords' => filled($metaKeywords) ? self::plainText($metaKeywords) : self::keywords([$name, $excerpt, $content]),
        ];
    }

    private static function plainText(?string $value): string
    {
        return Str::of($value ?? '')
            ->stripTags()
            ->replace('&nbsp;', ' ')
            ->squish()
            ->toString();
    }
}
