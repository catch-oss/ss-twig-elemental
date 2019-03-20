<?php

namespace CatchDesign\SS\TwigElemental;

use DNADesign\Elemental\Extensions\ElementalPageExtension;

class TwigElementalPageExtension extends ElementalPageExtension
{
    private static $has_one = [
        'ElementalArea' => TwigElementalArea::class,
    ];
}
