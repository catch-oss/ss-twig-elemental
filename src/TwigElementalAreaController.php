<?php

namespace CatchDesign\SS\TwigElemental;

use DNADesign\Elemental\Controllers\ElementalAreaController;
use DNADesign\Elemental\Services\ElementTypeRegistry;

class TwigElementalAreaController extends ElementalAreaController
{
    public function getClientConfig()
    {
        $clientConfig = parent::getClientConfig();

        echo 'aaa'.$this->ID;
        print_r($this->getRequest());

        $clientConfig['name'] = ElementalAreaController::class;

        // $elems = [];
        // $inElems = $clientConfig['elementTypes'];
        // foreach ($inElems as $elem) {
        //     if($elem['name'] == 'AccordionBlock' )
        //         $elems[] = $elem;
        // }
        //
        // $clientConfig['elementTypes'] = $elems;

        return $clientConfig;
    }
}
