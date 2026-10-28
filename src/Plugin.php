<?php declare(strict_types = 1);

namespace Nextras\CodingStandard;


use DressCode\Plugin as DressCodePlugin;
use DressCode\PluginManifest;


final class Plugin implements DressCodePlugin
{
	public function getManifest(): PluginManifest
	{
		return new PluginManifest(
			presets: ['nextras/preset' => __DIR__ . '/../standard.neon'],
		);
	}
}
