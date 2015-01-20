<?php

namespace User\Form;

use Zend\Form\Form;

class LoginForm extends Form {

    public function __construct($name = null) {
        parent::__construct('login');
        

        $this->add(array(
            'name' => 'mail_user',
            'type' => 'Text',
            'options' => array(
                'label' => 'Adresse Mail : ',
            ),
        ));
        $this->add(array(
            'name' => 'password_user',
            'type' => 'Password',
            'options' => array(
                'label' => 'Mot de Passe : ',
            ),
        ));
        $this->add(array(
            'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Login',
                'id' => 'submitbutton',
            ),
        ));
    }

}
