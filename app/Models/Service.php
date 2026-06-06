<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'excerpt',
        'image',
        'content',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    /**
     * @return Attribute<string, never>
     */
    protected function footerName(): Attribute
    {
        return Attribute::get(fn (): string => match ($this->slug) {
            'bierna-ochrona-przeciwpozarowa-projektowanie-i-wykonanie-systemow' => 'Bierna ochrona PPOŻ',
            'projektowanie-i-instalacja-systemow-przeciwpozarowych' => 'Instalacje PPOŻ',
            'kompleksowa-obsluga-ppoz-i-optymalizacja-kosztow' => 'Obsługa PPOŻ',
            'staly-nadzor-i-cykliczne-przeglady-systemow-przeciwpozarowych' => 'Nadzór i przeglądy PPOŻ',
            'kompleksowa-modernizacja-i-nadzor-budynkow' => 'Modernizacja budynków',
            'analiza-ryzyka-i-planowanie-bezpieczenstwa-pozarowego' => 'Analiza ryzyka PPOŻ',
            default => Str::of($this->name)
                ->before(' - ')
                ->words(4, '')
                ->toString(),
        });
    }
}
