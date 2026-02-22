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
        // GIVEN the TwigElementalPageExtension class
        // WHEN we check its class hierarchy
        // THEN it should extend ElementalPageExtension
        $this->assertTrue(
            is_subclass_of(TwigElementalPageExtension::class, ElementalPageExtension::class)
        );
    }

    public function testHasOneRelationshipToTwigElementalArea(): void
    {
        // GIVEN the TwigElementalPageExtension config
        // WHEN we read the has_one relationships
        $hasOne = Config::inst()->get(TwigElementalPageExtension::class, 'has_one');

        // THEN ElementalArea should point to TwigElementalArea
        $this->assertArrayHasKey('ElementalArea', $hasOne);
        $this->assertSame(TwigElementalArea::class, $hasOne['ElementalArea']);
    }
}
