<?php

use Azt3k\SS\Twig\TwigContainer;

TwigContainer::extendConfig(array(
    'twig.module_template_paths' => [
        \SilverStripe\Core\Manifest\ModuleLoader::getModule(
            'catchdesign/twig-elemental'
        )->getPath() .
        '/twig'
    ]
));
