<?php

class LoginForm extends Zend_form {

	public function init() {
		$form = new Zend_Form;
		$form->setAction('/resource/process')
		     ->setMethod('post');
	}

}

