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
        // GIVEN a page with TwigElementalPageExtension applied
        $page = Page::create();
        $page->Title = 'Test Page';
        $page->write();

        // WHEN we access the ElementalArea relation
        $area = $page->ElementalArea();

        // THEN it should be a TwigElementalArea instance
        $this->assertTrue($page->hasMethod('ElementalArea'));
        $this->assertInstanceOf(TwigElementalArea::class, $area);
    }

    public function testElementalAreaCanHaveElements(): void
    {
        if (!class_exists(ElementContent::class)) {
            $this->markTestSkipped('ElementContent class not available');
        }

        // GIVEN a page with an elemental area
        $page = Page::create();
        $page->Title = 'Test Page';
        $page->write();
        $area = $page->ElementalArea();
        $area->write();

        // WHEN we add an ElementContent to the area
        $element = ElementContent::create();
        $element->Title = 'Test Element';
        $element->ParentID = $area->ID;
        $element->write();

        // THEN the area should contain the element
        $this->assertGreaterThan(0, $area->Elements()->count());
    }

    public function testElementControllerUsesTwigElementController(): void
    {
        if (!class_exists(ElementContent::class)) {
            $this->markTestSkipped('ElementContent class not available');
            return;
        }

        // GIVEN an ElementContent instance
        $element = ElementContent::create();
        $element->Title = 'Test Element';
        $element->write();

        // WHEN we get its controller
        $controller = $element->getController();

        // THEN it should be a TwigElementController
        $this->assertInstanceOf(TwigElementController::class, $controller);
    }

    public function testElementalAreaForTemplateReturnsString(): void
    {
        // GIVEN a page with an elemental area written to the database
        $page = Page::create();
        $page->Title = 'Test Page';
        $page->write();
        $area = $page->ElementalArea();
        $area->write();

        // WHEN we call forTemplate on the area
        $output = $area->forTemplate();

        // THEN it should return renderable string content
        $this->assertIsString((string) $output);
    }
}
