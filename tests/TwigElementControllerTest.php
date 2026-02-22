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
        // GIVEN the TwigElementController class
        // WHEN we check its class hierarchy
        // THEN it should extend ElementController
        $this->assertTrue(is_subclass_of(TwigElementController::class, ElementController::class));
    }

    public function testUsesTwigRenderer(): void
    {
        // GIVEN the TwigElementController class
        // WHEN we inspect its traits
        $traits = class_uses(TwigElementController::class);

        // THEN it should include TwigRenderer
        $this->assertArrayHasKey(TwigRenderer::class, $traits);
    }

    public function testInjectorConfigured(): void
    {
        // GIVEN the Injector is configured with default SS6 config
        // WHEN we look up the spec for ElementController
        $spec = Injector::inst()->getServiceSpec(ElementController::class);

        // THEN it should be overridden with TwigElementController
        $this->assertNotNull($spec, 'ElementController should have an Injector specification');
        $this->assertEquals(TwigElementController::class, $spec['class'] ?? null);
    }
}
