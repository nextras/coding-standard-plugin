# Nextras Coding Standard

Shared [DressCode](https://dresscode.run) configuration for Nextras libraries.

## Installation

After the package is published to Packagist:

```sh
composer require --dev nextras/coding-standard-plugin
```

Add this to the project's `dresscode.neon`:

```neon
use:
	- nextras/coding-standard-plugin
	- nextras/preset

paths:
	- src
	- tests

fileExtensions:
	- php
	- phpt
```

Run `vendor/bin/dresscode check` or `vendor/bin/dresscode fix`.

DressCode 1.3 treats the two entries separately: `nextras/coding-standard-plugin` enables the package's plugin, and `nextras/preset` selects its preset. A package and a preset cannot share a name. This is a DressCode plugin distributed as a regular Composer library; it needs no Composer `allow-plugins` entry. Use the DressCode executable installed in the project so Composer can autoload the plugin.

The tool requires PHP 8.4 or newer (within the versions supported by DressCode). The PHP version of the code being checked is taken from that project's `composer.json`.

## Local development

Before publication, add a Composer path repository in a consuming project:

```json
{
	"repositories": [
		{
			"type": "path",
			"url": "../coding-standard",
			"options": {
				"symlink": true,
				"versions": {
					"nextras/coding-standard-plugin": "dev-main"
				}
			}
		}
	]
}
```

Then run `composer require --dev nextras/coding-standard-plugin:dev-main` and use the configuration above. Composer symlinks the local package, so preset changes take effect immediately. Once a release is published, remove the path repository and switch to a tagged version constraint.

To check this repository itself, run `composer install` followed by `composer check`. Its root package plugin is enabled automatically.

## Project settings and compatibility

The preset keeps explicit `public` on interface methods, parentheses on constructor calls, two blank lines after a namespace, and separate `use function` imports. Project settings override the preset's decisions.

Keep paths, exclusions, file extensions, PHPStan type analysis, namespace declarations, baselines, and compatibility exceptions in each consuming project. For example:

```neon
baseline: dresscode-baseline.neon
typeAnalysis: phpstan
```

Existing library API names and behavior changes belong in that project's baseline. The shared preset keeps Nette's naming checks active for new code and does not enable risky fixes. Review the proposed changes before generating a baseline; preserve intentional runtime behavior with project-specific `reportOnly` overrides where needed.
