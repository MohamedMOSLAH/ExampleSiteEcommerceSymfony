<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AmountExtension extends AbstractExtension {
    public function getFilters() {
        return [
            new TwigFilter('amount', [$this, 'amount'])
        ];
    }

    public function amount($value)
    {
        $value = $value / 100;
        $value = number_format($value,2,','," ");
        return $value;

    }
}