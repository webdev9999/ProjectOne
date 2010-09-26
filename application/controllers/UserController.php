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
    
    public function getRegistrationForm()
    {
    	$form = new Zend_Form();
    	$form->setMethod('get');
		$username = $form->createElement('text', 'username');
		$username->setLabel('Username');
		$password = $form->createElement('password', 'password');
		$password->setLabel('Password');
		$submit = $form->createElement('submit', 'Register');
		$form->addElements(array($username, $password, $submit));
    	return $form;
    }
    
    public function registerAction()
    {
    	//$this->view->form = $this->getRegistrationForm();
    	$this->view->form = new Form_LoginForm();
    }
    
    public function loginAction()
    {
		$form = $this->getLoginForm();
		if ($this->getRequest()->isPost()) {
			if ($form->isValid($_POST)) {
				$data = $form->getValues();
				$this->view->form_values = $data;
				//$this->view->form_values = $_POST;
				$form->populate($_POST);
				//$this->view->form_values = 'Form submitted - no errors';
			} else {
				$this->view->form_values = 'Form error';
			}	
				
		} else {
			$this->view->form_values = 'Form not submitted';
		}
		$this->view->form = $form;
    }
    
    public function getLoginForm()
    {
		$form = new Zend_Form();

		$form->setAction('/user/login');
		$form->setMethod('post');

		$username = $form->createElement('text', 'username');
		//$username->addValidator('alnum')
//		$username->setLabel('Username')
//		->addValidator('regex', false, array('/^[a-z]+/'))
//		->addValidator('stringLength', false, array(6, 20))
//		->setRequired(true)
//		->addFilter('StringToLower');

		$password = $form->createElement('password', 'password');
//		$password->addValidator('StringLength', false, array(6))
//		->setRequired(true)
//		$password->setLabel('Password');
		
		$form->addElement($username)
		->addElement($password)

/*
		->addElement('captcha', 'captcha', array(
            'label'      => 'Please enter the 5 letters displayed below:',
            'required'   => true,
            'captcha'    => array(
                'captcha' => 'Figlet',
                'wordLen' => 5,
                'timeout' => 300
            )
        ))
*/ 

//		->addElement('hash', 'csrf', array('ignore' => true))
        
		->addElement('submit', 'login', array('label' => 'Login'));  

		return $form; 
    }
}
