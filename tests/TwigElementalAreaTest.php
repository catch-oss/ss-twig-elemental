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
        $area = TwigElementalArea::create();
        $this->assertInstanceOf(ElementalArea::class, $area);
    }

    public function testUsesTwigRenderer(): void
    {
        $traits = class_uses(TwigElementalArea::class);
        $this->assertArrayHasKey(TwigRenderer::class, $traits);
    }

    public function testInjectorResolvesClass(): void
    {
        $area = Injector::inst()->create(TwigElementalArea::class);
        $this->assertInstanceOf(TwigElementalArea::class, $area);
    }
}
