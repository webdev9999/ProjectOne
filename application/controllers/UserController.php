<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $this->view->demo = 'test';
    }
    
    public function loginAction()
    {
		$form = $this->getLoginForm();
		if ($this->getRequest()->isPost()) {
			$this->view->form_values = $form->getValues();
			//$this->view->form_values = $_POST;
			//$form->populate($_POST);
		} else {
			$this->view->form_values = 'Form not submitted';
		}
		$this->view->form = $form;
    }
    
    public function getLoginForm()
    {
		$form = new Zend_Form();

		$form->setAction('/user/login')
		->setMethod('post');

		$username = $form->createElement('text', 'username');
		$username->addValidator('alnum')
		->setLabel('Username')
//		->addValidator('regex', false, array('/^[a-z]+/'))
//		->addValidator('stringLength', false, array(6, 20))
//		->setRequired(true)
		->addFilter('StringToLower');

		$password = $form->createElement('password', 'password');
//		$password->addValidator('StringLength', false, array(6))
//		->setRequired(true)
		$password->setLabel('Password');
		
		$form->addElement($username)
		->addElement($password)

		->addElement('captcha', 'captcha', array(
            'label'      => 'Please enter the 5 letters displayed below:',
            'required'   => true,
            'captcha'    => array(
                'captcha' => 'Figlet',
                'wordLen' => 5,
                'timeout' => 300
            )
        ))

		->addElement('hash', 'csrf', array('ignore' => true))
        
		->addElement('submit', 'login', array('label' => 'Login'));  

		return $form; 
    }
}
