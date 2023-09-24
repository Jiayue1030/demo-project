<?php

namespace App\MoonShine\Pages;

use MoonShine\Resources\CustomPage;

class WageIndex extends CustomPage
{
	public string $title = 'Wage Index';

	public string $alias = 'wage_index';

	public function __construct()
	{
		parent::__construct(
			$this->title(),
			$this->alias(),
			$this->view()
		);
	}

	public function view(): string
	{
		return 'wage_index.index';
	}

	public function datas(): array
	{
		return [];
	}
}
