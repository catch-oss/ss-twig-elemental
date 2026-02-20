<?php

namespace CatchDesign\SS\TwigElemental\Tests;

use Azt3k\SS\Twig\TwigRenderer;
use CatchDesign\SS\TwigElemental\TwigElementController;
use DNADesign\Elemental\Controllers\ElementController;
use SilverStripe\Core\Injector\Injector;
use SilverStripe\Dev\SapphireTest;

class TwigElementControllerTest extends SapphireTest
{
    protected $usesDatabase = false;

    public function testExtendsElementController(): void
    {
        $this->assertTrue(is_subclass_of(TwigElementController::class, ElementController::class));
    }

    public function testUsesTwigRenderer(): void
    {
        $traits = class_uses(TwigElementController::class);
        $this->assertArrayHasKey(TwigRenderer::class, $traits);
    }

    public function testInjectorConfigured(): void
    {
        // ElementController requires a BaseElement in constructor,
        // so we verify the Injector spec is configured correctly instead
        $spec = Injector::inst()->getServiceSpec(ElementController::class);
        $this->assertNotNull($spec, 'ElementController should have an Injector specification');
        $this->assertEquals(TwigElementController::class, $spec['class'] ?? null);
    }
}
