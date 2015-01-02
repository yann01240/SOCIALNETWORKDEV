<?php

namespace User\Form;


use Zend\Validator\EmailAddress;
use Zend\Form\Form,
    Zend\Form\Element,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilter;

class Login extends Form {

    public function __construct($name = null) {
        parent::__construct('login');
        $this->setAttribute('method', 'post');

        $mail_user = new Element\Text('mail_user');
        $mail_user->setLabel('Mail');
        $this->add($mail_user);

        $password_user = new Element\Password('password_user');
        $password_user->setLabel('Password');
        $this->add($password_user);

        $csrf = new Element\Csrf('csrf');
        $this->add($csrf);

        $submit = new Element\Submit('submit');
        $submit->setValue('Log In');
        $this->add($submit);

        // set InputFilter
        $inputFilter = new InputFilter();
        $factory = new InputFactory();
        $inputFilter->add($factory->createInput(array(
                    'name' => 'mail_user',
                    'required' => true,
                    'filters' => array(
                        array('name' => 'StringTrim'),
                    ),
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'encoding' => 'UTF-8',
                                'min' => 1,
                                'max' => 50,
                            ),
                        ),
                        new EmailAddress(),
                    )
        )));
        $inputFilter->add($factory->createInput(array(
                    'name' => 'password_user',
                    'required' => true,
                    'validators' => array(
                        array(
                            'name' => 'StringLength',
                            'options' => array(
                                'min' => 5
                            )
                        )
                    )
        )));
        $inputFilter->add($factory->createInput(array(
                    'name' => 'csrf',
                    'required' => true,
                    'validators' => array(
                        array(
                            'name' => 'Csrf',
                            'options' => array(
                                'timeout' => 600
                            )
                        )
                    )
        )));
        $this->setInputFilter($inputFilter);
    }

}
