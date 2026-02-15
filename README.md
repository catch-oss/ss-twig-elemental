# Twig Elemental Blocks

<!-- PROJECT SHIELDS -->
[![SonarCloud](https://github.com/catch-oss/ss-twig-elemental/actions/workflows/sonar.yml/badge.svg)](https://github.com/catch-oss/ss-twig-elemental/actions/workflows/sonar.yml)
[![Test](https://github.com/catch-oss/ss-twig-elemental/actions/workflows/test.yml/badge.svg)](https://github.com/catch-oss/ss-twig-elemental/actions/workflows/test.yml)
[![Quality Gate Status](https://sonarcloud.io/api/project_badges/measure?project=catch-design_https-github-com-catch-oss-ss-twig-elemental&metric=alert_status)](https://sonarcloud.io/summary/new_code?id=catch-design_https-github-com-catch-oss-ss-twig-elemental)
[![Bugs](https://sonarcloud.io/api/project_badges/measure?project=catch-design_https-github-com-catch-oss-ss-twig-elemental&metric=bugs)](https://sonarcloud.io/component_measures?id=catch-design_https-github-com-catch-oss-ss-twig-elemental)
[![Code Smells](https://sonarcloud.io/api/project_badges/measure?project=catch-design_https-github-com-catch-oss-ss-twig-elemental&metric=code_smells)](https://sonarcloud.io/component_measures?id=catch-design_https-github-com-catch-oss-ss-twig-elemental)
[![Coverage](https://sonarcloud.io/api/project_badges/measure?project=catch-design_https-github-com-catch-oss-ss-twig-elemental&metric=coverage)](https://sonarcloud.io/component_measures?id=catch-design_https-github-com-catch-oss-ss-twig-elemental)
[![Duplicated Lines Density](https://sonarcloud.io/api/project_badges/measure?project=catch-design_https-github-com-catch-oss-ss-twig-elemental&metric=duplicated_lines_density)](https://sonarcloud.io/component_measures?id=catch-design_https-github-com-catch-oss-ss-twig-elemental)
[![Lines of Code](https://sonarcloud.io/api/project_badges/measure?project=catch-design_https-github-com-catch-oss-ss-twig-elemental&metric=ncloc)](https://sonarcloud.io/component_measures?id=catch-design_https-github-com-catch-oss-ss-twig-elemental)
[![Reliability Rating](https://sonarcloud.io/api/project_badges/measure?project=catch-design_https-github-com-catch-oss-ss-twig-elemental&metric=reliability_rating)](https://sonarcloud.io/component_measures?id=catch-design_https-github-com-catch-oss-ss-twig-elemental)
[![Security Rating](https://sonarcloud.io/api/project_badges/measure?project=catch-design_https-github-com-catch-oss-ss-twig-elemental&metric=security_rating)](https://sonarcloud.io/component_measures?id=catch-design_https-github-com-catch-oss-ss-twig-elemental)
[![Technical Debt](https://sonarcloud.io/api/project_badges/measure?project=catch-design_https-github-com-catch-oss-ss-twig-elemental&metric=sqale_index)](https://sonarcloud.io/component_measures?id=catch-design_https-github-com-catch-oss-ss-twig-elemental)
[![Maintainability Rating](https://sonarcloud.io/api/project_badges/measure?project=catch-design_https-github-com-catch-oss-ss-twig-elemental&metric=sqale_rating)](https://sonarcloud.io/component_measures?id=catch-design_https-github-com-catch-oss-ss-twig-elemental)
[![Vulnerabilities](https://sonarcloud.io/api/project_badges/measure?project=catch-design_https-github-com-catch-oss-ss-twig-elemental&metric=vulnerabilities)](https://sonarcloud.io/component_measures?id=catch-design_https-github-com-catch-oss-ss-twig-elemental)

This extension allows Twig templates to be used for Elemental Blocks

## Usage

Add to your project (something like this - maybe manually put it in the composer.json)

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
