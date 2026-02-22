<?php

namespace CatchDesign\SS\TwigElemental\Tests;

use Azt3k\SS\Twig\TwigRenderer;
use CatchDesign\SS\TwigElemental\TwigElementalArea;
use DNADesign\Elemental\Models\ElementalArea;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Dev\SapphireTest;

class TwigElementalAreaTest extends SapphireTest
{
    protected $usesDatabase = false;

    public function testExtendsElementalArea(): void
    {
        // GIVEN the TwigElementalArea class
        // WHEN we create an instance
        $area = TwigElementalArea::create();

        // THEN it should be an instance of ElementalArea
        $this->assertInstanceOf(ElementalArea::class, $area);
    }

    public function testUsesTwigRenderer(): void
    {
        // GIVEN the TwigElementalArea class
        // WHEN we inspect its traits
        $traits = class_uses(TwigElementalArea::class);

        // THEN it should include TwigRenderer
        $this->assertArrayHasKey(TwigRenderer::class, $traits);
    }

    public function testInjectorResolvesClass(): void
    {
        // GIVEN the Injector is configured with default SS6 config
        // WHEN we create a TwigElementalArea via Injector
        $area = Injector::inst()->create(TwigElementalArea::class);

        // THEN it should resolve to TwigElementalArea
        $this->assertInstanceOf(TwigElementalArea::class, $area);
    }
}
