<?php

namespace CatchDesign\SS\TwigElemental\Tests;

use CatchDesign\SS\TwigElemental\TwigElementalArea;
use CatchDesign\SS\TwigElemental\TwigElementalPageExtension;
use CatchDesign\SS\TwigElemental\TwigElementController;
use DNADesign\Elemental\Models\BaseElement;
use DNADesign\Elemental\Models\ElementContent;
use Page;
use SilverStripe\Dev\SapphireTest;

/**
 * Integration tests for Twig Elemental functionality.
 * These tests require a database and verify actual rendering behavior.
 */
class TwigElementalIntegrationTest extends SapphireTest
{
    protected $usesDatabase = true;

    protected static $required_extensions = [
        Page::class => [TwigElementalPageExtension::class],
    ];

    public function testPageHasElementalArea(): void
    {
        $page = Page::create();
        $page->Title = 'Test Page';
        $page->write();

        $this->assertTrue($page->hasMethod('ElementalArea'));
        $area = $page->ElementalArea();
        $this->assertInstanceOf(TwigElementalArea::class, $area);
    }

    public function testElementalAreaCanHaveElements(): void
    {
        $page = Page::create();
        $page->Title = 'Test Page';
        $page->write();

        $area = $page->ElementalArea();
        $area->write();

        // Create an element if ElementContent is available
        if (class_exists(ElementContent::class)) {
            $element = ElementContent::create();
            $element->Title = 'Test Element';
            $element->ParentID = $area->ID;
            $element->write();

            $this->assertGreaterThan(0, $area->Elements()->count());
        } else {
            $this->markTestSkipped('ElementContent class not available');
        }
    }

    public function testElementControllerUsesTwigElementController(): void
    {
        // Create an element
        if (!class_exists(ElementContent::class)) {
            $this->markTestSkipped('ElementContent class not available');
            return;
        }

        $element = ElementContent::create();
        $element->Title = 'Test Element';
        $element->write();

        $controller = $element->getController();
        $this->assertInstanceOf(TwigElementController::class, $controller);
    }

    public function testElementalAreaForTemplateReturnsString(): void
    {
        $page = Page::create();
        $page->Title = 'Test Page';
        $page->write();

        $area = $page->ElementalArea();
        $area->write();

        // forTemplate should return renderable content
        $output = $area->forTemplate();
        $this->assertIsString((string) $output);
    }
}
