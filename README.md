# Twig Elemental Blocks

This extension allows Twig templates to be used for Elemental Blocks

## Usage

Add to your project

```
composer require catchdesign/twig-elemental
```

Extend your page with some config yaml

```
Page:
  extensions:
    - CatchDesign\SS\TwigElemental\TwigElementalPageExtension
```

Now pages have a ElementalArea which you can add in to your twig templates
like this:


```
{{ c.ElementalArea.forTemplate | raw }}
```


You can also make custom ElementalBlocks by extending the built in
ElementalBlocks

```
// src/SamBlock.php

<?php

use DNADesign\Elemental\Models\BaseElement;
use Azt3k\SS\Twig\TwigRenderer;

class SamBlock extends BaseElement
{
    use TwigRenderer;
    private static $singular_name = 'sblock';
    private static $plural_name = 'sblocks';
    private static $icon = 'font-icon-block-file';
    private static $table_name = 'S_EB_SamBlock';

    private static $db = [
        'SuchField' => 'Text'
    ];

    public function getType()
    {
        return 'SamBlock';
    }

}
```

```
// twig/SamBlock.twig

<p> ### Start Sam Block ###</p>
<h1>{{ c.Title }}</h1>
<h1>{{ c.SuchField }}</h1>
<p> ### End Sam Block ###</p>
```
