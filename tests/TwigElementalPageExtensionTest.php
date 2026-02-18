<?php

namespace CatchDesign\SS\TwigElemental\Tests;

use CatchDesign\SS\TwigElemental\TwigElementalArea;
use CatchDesign\SS\TwigElemental\TwigElementalPageExtension;
use DNADesign\Elemental\Extensions\ElementalPageExtension;
use SilverStripe\Core\Config\Config;
use SilverStripe\Dev\SapphireTest;

class TwigElementalPageExtensionTest extends SapphireTest
{
    protected $usesDatabase = false;

    public function testExtendsElementalPageExtension(): void
    {
        $this->assertTrue(
            is_subclass_of(TwigElementalPageExtension::class, ElementalPageExtension::class)
        );
    }

    public function testHasOneRelationshipToTwigElementalArea(): void
    {
        $hasOne = Config::inst()->get(TwigElementalPageExtension::class, 'has_one');
        $this->assertArrayHasKey('ElementalArea', $hasOne);
        $this->assertSame(TwigElementalArea::class, $hasOne['ElementalArea']);
    }
}
