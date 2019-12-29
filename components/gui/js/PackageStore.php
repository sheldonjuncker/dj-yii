<?php

namespace app\components\gui\js;

/**
 * Class PackageStore
 *
 * Factory class for creating necessary packages.
 *
 * @package app\components\gui\js
 */
class PackageStore
{
	public function getBootstrapPackage(): Package
	{
		return new Package('bootstrap', [
			new Script('popper.min.js', Script::POS_HEAD),
			new Script('jquery.min.js', Script::POS_HEAD),
			new Script('bootstrap.js', Script::POS_HEAD),
			new Script('flatpickr.min.js', Script::POS_END),
			new Script('prism.js', Script::POS_END),
			new Script('draggable.bundle.legacy.js', Script::POS_END),
			new Script('swap-animation.js', Script::POS_END),
			new Script('dropzone.min.js', Script::POS_END),
			new Script('list.min.js', Script::POS_END),
			new Script('theme.js', Script::POS_END)
		]);
	}

	public function getDreamQueryPackage(): Package
	{
		return new Package('dreamQuery', [
			new Script('vue.js'),
			new Script('dream-query.js')
		]);
	}
}