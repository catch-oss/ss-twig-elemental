# Migration Plan: ss-twig-elemental

## Summary

- **Package**: catchdesign/twig-elemental
- **Type**: B (Silverstripe module)
- **Tier**: 4
- **Risk Level**: Low
- **Estimated Scope**: 3 source files, 3 classes, 2 twig templates, 4 config files
- **Current State**: No tests, no phpunit.xml, no .gitignore

## Change Inventory

### Namespace Renames Required

No SS5 core namespace renames needed in source files. All imports reference `DNADesign\Elemental\*` and `Azt3k\SS\Twig\*` — namespace changes in those packages are handled by their own SS6 migrations.

| Old Namespace | New Namespace | Files Affected |
|---|---|---|
| _(none in source)_ | | |

### Composer Dependency Changes

| Package | Current Version | Target Version |
|---|---|---|
| php | _(not declared)_ | ^8.5 |
| silverstripe/framework | ^5 | ^6.0 |
| dnadesign/silverstripe-elemental | ^5 | ^6.0 |
| azt3k/silverstripe-twig | dev-master | dev-release/6 |
| phpunit/phpunit _(new, dev)_ | - | ^11.0 |
| silverstripe/recipe-cms _(new, dev)_ | - | ^6.0 |
| silverstripe/vendor-plugin _(new, dev)_ | - | ^3.0 |

### API Changes Required

| Pattern | Migration | Files Affected |
|---|---|---|
| _(none)_ | Source classes are thin wrappers — no direct SS API calls that need migration | |

### PHP 8.5 Compatibility Fixes

| Issue | Fix | Files Affected |
|---|---|---|
| _(none)_ | All 3 source files are clean — no implicit nullable params, no deprecated patterns | |

### PHPUnit Migration

| Issue | Fix | Files Affected |
|---|---|---|
| No tests exist | Create test suite from scratch | _(new files)_ |

### GraphQL Config Changes

| File | Change Required |
|---|---|
| _config/graphql.yml | Verify `SilverStripe\GraphQL\Schema\Schema` still exists in graphql v6; update if API changed |
| _graphql/config.yml | Verify resolver class path `DNADesign\Elemental\GraphQL\Resolvers\Resolver` still valid in elemental v6 |
| _graphql/models.yml | Verify field/operation definitions compatible with elemental v6 |

### Config Changes

| File | Change Required |
|---|---|
| _config.php | No changes needed — `ModuleLoader::getModule()` and `TwigContainer::extendConfig()` should remain valid |
| _config/Injector.yml | No changes needed — Injector class overrides are namespace-stable |
| README.md | Update unnamed extension example to use named key (SS6 requirement) |

## Risk Assessment

| Area | Risk | Notes |
|---|---|---|
| Namespace renames | Low | No SS core namespaces used directly in source |
| API changes | Low | Thin wrapper classes — no direct SS API calls |
| PHP 8.5 compat | Low | Code is minimal and clean |
| GraphQL config | Medium | graphql v5→v6 may change schema/resolver APIs |
| Test creation | Medium | No existing tests — need to build from scratch for 80% coverage |
| Dependency chain | Medium | Depends on silverstripe-twig (Tier 3) completing SS6 migration first |

## Migration Steps (Ordered)

### Phase 1: composer.json

- [ ] Update `silverstripe/framework` to `^6.0`
- [ ] Update `dnadesign/silverstripe-elemental` to `^6.0`
- [ ] Update `azt3k/silverstripe-twig` to `dev-release/6`
- [ ] Add `"php": "^8.5"` to require
- [ ] Add require-dev: `phpunit/phpunit: ^11.0`, `silverstripe/recipe-cms: ^6.0`
- [ ] Add autoload-dev with PSR-4 for tests namespace and classmap for Page/PageController
- [ ] Add allow-plugins: `composer/installers`, `silverstripe/vendor-plugin`, `silverstripe/recipe-plugin`
- [ ] Update description to reference SilverStripe 6
- [ ] Remove stale `composer.lock`
- [ ] Run `composer validate`

### Phase 2: Namespace Renames

- [ ] No source namespace renames needed
- [ ] Verify elemental v6 class paths still match imports after `composer update`

### Phase 3: API Changes

- [ ] No API changes needed in source files
- [ ] Verify `TwigRenderer` trait from silverstripe-twig still works with SS6 base classes

### Phase 4: PHP 8.5 Compatibility

- [ ] No fixes needed — code is already compatible

### Phase 5: Logging Integration

- [ ] Minimal logging opportunity — this module does template rendering only
- [ ] Add Monolog 3.2+ as optional dependency if any logging is warranted

### Phase 6: Config Updates

- [ ] Verify `_config/graphql.yml` classexists check works with graphql v6
- [ ] Verify `_graphql/config.yml` resolver path valid in elemental v6
- [ ] Verify `_graphql/models.yml` field/operation defs compatible with elemental v6
- [ ] Update README.md extension example to use named key

### Phase 7: Test Suite (Silverstripe Best Practices)

- [ ] Create `phpunit.xml.dist` with bootstrap `vendor/silverstripe/framework/tests/bootstrap.php`
- [ ] Add `silverstripe/recipe-cms: ^6.0` to require-dev (provides Page/PageController)
- [ ] Add `silverstripe/recipe-plugin: true` to allow-plugins
- [ ] Add autoload-dev classmap for `app/src/Page.php`, `app/src/PageController.php`
- [ ] Create `.gitignore` with: `vendor/`, `app/`, `public/`, `.htaccess`, `index.php`, `web.config`, `.phpunit.cache/`, `composer.lock`
- [ ] Create `tests/TwigElementalAreaTest.php` — SapphireTest verifying Injector override, TwigRenderer trait, ElementControllers rendering
- [ ] Create `tests/TwigElementControllerTest.php` — SapphireTest verifying Injector override, TwigRenderer trait
- [ ] Create `tests/TwigElementalPageExtensionTest.php` — SapphireTest verifying has_one to TwigElementalArea, extension applies to Page
- [ ] Use `$usesDatabase = true` for tests needing ElementalArea/BaseElement fixtures
- [ ] Use `Page::create()` not `SiteTree::create()` for test pages
- [ ] Use `::create()` instead of `new` for SS classes
- [ ] Target 80% line coverage minimum
- [ ] Migrate to PHPUnit 11 syntax (attributes, static data providers)

## Dependencies

- **Depends on**:
  - `azt3k/silverstripe-twig` (Tier 3) — must complete SS6 migration and have `release/6` branch
  - `dnadesign/silverstripe-elemental` ^6.0 — must be published on Packagist
- **Blocks**:
  - None (no higher-tier repos depend on this)
