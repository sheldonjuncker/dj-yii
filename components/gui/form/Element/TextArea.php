<?php


namespace App\Gui\Form\Element;


use App\Storm\Model\Model;

class TextArea extends ModelInput
{
	public function render(bool $return = false): string
	{
		$input = new Tag('textarea', $this->getValue(), array_merge([
			'name' => $this->getName(),
			'class' => 'form-control',
		], $this->htmlAttributes));

		return $input->render($return);
	}
}