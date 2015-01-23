<?php

namespace User\Form;

use Zend\Form\Form;

class LoginForm extends Form {

    public function __construct($name = null) {
        parent::__construct('login');
        

        $mail_user = new \Zend\Form\Element\Text('mail_user');
        $mail_user->setAttribute('class', 'form-control');
        $mail_user->setAttribute('placeholder', 'Entre ton mail');
        $this->add($mail_user);
        
        $password_user = new \Zend\Form\Element\Password('password_user');
        $password_user->setAttribute('class', 'form-control');
        $password_user->setAttribute('placeholder', 'Entre ton password');
        $this->add($password_user);
        
        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setValue('Login');
        $submit->setAttribute('class', 'btn btn-primary');
        $this->add($submit);
    }

}
