# Migration Plan: ss-twig-elemental

## Summary

- **Package**: catchdesign/twig-elemental
- **Type**: B (Silverstripe module)
- **Tier**: 4
- **Risk Level**: Low
- **Estimated Scope**: 3 source files, 3 classes, 2 twig templates
- **Current State**: Migration phases 1-7 complete. Tests written. PR #8 open.

## Change Inventory

### Namespace Renames Required

No SS5 core namespace renames needed in source files. All imports reference `DNADesign\Elemental\*` and `Azt3k\SS\Twig\*` — namespace changes in those packages are handled by their own SS6 migrations.

| Old Namespace | New Namespace | Files Affected |
|---|---|---|
| _(none in source)_ | | |

### Composer Dependency Changes

| Package | Current Version | Target Version | Status |
|---|---|---|---|
| php | _(not declared)_ | ^8.5 | Done |
| silverstripe/framework | ^5 | ^6.0 | Done |
| silverstripe/vendor-plugin | _(not declared)_ | ^3.0 | Done |
| dnadesign/silverstripe-elemental | ^5 | ^6.0 | Done |
| azt3k/silverstripe-twig | dev-master | dev-release/6 | **Needs update** (currently dev-feature/upgrade-to-6) |
| phpunit/phpunit _(new, dev)_ | - | ^11.0 | Done |
| silverstripe/recipe-cms _(new, dev)_ | - | ^6.0 | Done |

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
| No tests existed | Created test suite from scratch | 4 test files |

### Config Changes

| File | Change Required |
|---|---|
| _config.php | No changes needed — `ModuleLoader::getModule()` and `TwigContainer::extendConfig()` remain valid |

## Risk Assessment

| Area | Risk | Notes |
|---|---|---|
| Namespace renames | Low | No SS core namespaces used directly in source |
| API changes | Low | Thin wrapper classes — no direct SS API calls |
| PHP 8.5 compat | Low | Code is minimal and clean |
| Test creation | Low | Tests written and passing |
| Dependency chain | **Resolved** | silverstripe-twig PR #6 merged into release/6 |

## Migration Steps (Ordered)

### Phase 1: composer.json — DONE

- [x] Update `silverstripe/framework` to `^6.0`
- [x] Update `dnadesign/silverstripe-elemental` to `^6.0`
- [x] Add `"php": "^8.5"` to require
- [x] Add `silverstripe/vendor-plugin: ^3.0` to require
- [x] Add require-dev: `phpunit/phpunit: ^11.0`, `silverstripe/recipe-cms: ^6.0`
- [x] Add autoload-dev with PSR-4 for tests namespace and classmap for Page/PageController
- [x] Add allow-plugins: `composer/installers`, `silverstripe/vendor-plugin`, `silverstripe/recipe-plugin`
- [x] Update description to reference SilverStripe 6
- [ ] **Update `azt3k/silverstripe-twig` from `dev-feature/upgrade-to-6` to `dev-release/6`** (blocked until twig PR merged — now unblocked)

### Phase 2: Namespace Renames — DONE

- [x] No source namespace renames needed

### Phase 3: API Changes — DONE

- [x] No API changes needed in source files

### Phase 4: PHP 8.5 Compatibility — DONE

- [x] No fixes needed — code is already compatible

### Phase 5: Logging Integration — SKIPPED

- [x] Not applicable — this module does template rendering only, no logging

### Phase 6: Config Updates — DONE

- [x] Removed stale _config and _graphql directories (not needed for SS6 elemental v6)
- [x] Verified _config.php still works

### Phase 7: Test Suite — DONE

- [x] Created `phpunit.xml.dist` with SS framework bootstrap
- [x] Created 4 test files with GIVEN/WHEN/THEN comments
- [x] Tests use SapphireTest with `$usesDatabase` as appropriate
- [x] Uses `Page::create()` convention
- [x] PHPUnit 11 syntax

## Remaining Action

- [ ] Update `azt3k/silverstripe-twig` to `dev-release/6` in composer.json (twig PR now merged)
- [ ] Remove VCS repository for silverstripe-twig if no longer needed
- [ ] Run `composer update` to verify resolution
- [ ] Push update, verify CI passes on PR #8

## Dependencies

- **Depends on**:
  - `azt3k/silverstripe-twig` (Tier 3) — **DONE** (PR #6 merged into release/6)
  - `dnadesign/silverstripe-elemental` ^6.0 — available on Packagist
- **Blocks**:
  - None (no higher-tier repos depend on this)
