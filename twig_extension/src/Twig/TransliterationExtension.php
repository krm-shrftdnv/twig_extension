<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class TransliterationExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('translit', [$this, 'translit']),
        ];
    }

    public function translit(string $source = ''): string
    {
        return $source;
    }
}