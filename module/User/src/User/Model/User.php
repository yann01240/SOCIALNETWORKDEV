<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Model;

use Zend\InputFilter\InputFilter;
use Zend\InputFilter\InputFilterInterface;
use Zend\Validator\EmailAddress;
use Zend\Validator\Date;

class User {

    public $id_user;
    public $password_user;
    public $nom_user;
    public $prenom_user;
    public $mail_user;
    public $date_de_naissance_user;
    public $sexe_user;
    public $adresse_user;
    public $code_postal_user;
    public $ville_user;
    public $pays_user;
    protected $inputFilter;

    public function exchangeArray($data) {
        $this->id_user = (!empty($data['id_user'])) ? $data['id_user'] : null;
        $this->password_user = (!empty($data['password_user'])) ? $data['password_user'] : null;
        $this->nom_user = (!empty($data['nom_user'])) ? $data['nom_user'] : null;
        $this->prenom_user = (!empty($data['prenom_user'])) ? $data['prenom_user'] : null;
        $this->mail_user = (!empty($data['mail_user'])) ? $data['mail_user'] : null;
        $this->date_de_naissance_user = (!empty($data['date_de_naissance_user'])) ? $data['date_de_naissance_user'] : null;
        $this->sexe_user = (!empty($data['sexe_user'])) ? $data['sexe_user'] : null;
        $this->adresse_user = (!empty($data['adresse_user'])) ? $data['adresse_user'] : null;
        $this->code_postal_user = (!empty($data['code_postal_user'])) ? $data['code_postal_user'] : null;
        $this->ville_user = (!empty($data['ville_user'])) ? $data['ville_user'] : null;
        $this->pays_user = (!empty($data['pays_user'])) ? $data['pays_user'] : null;
    }

    public function setInputFilter(InputFilterInterface $inputFilter) {
        throw new \Exception("Not used");
    }

    public function getInputFilter() {
        if (!$this->inputFilter) {
            $inputFilter = new InputFilter();

            $inputFilter->add(array(
                'name' => 'id_user',
                'required' => true,
                'filters' => array(
                    array('name' => 'Int'),
                ),
            ));

            $inputFilter->add(array(
                'name' => 'nom_user',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 20,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'prenom_user',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 20,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'password_user',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 40,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'repassword_user',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 40,
                        ),
                    ),
                    array(
                        'name' => 'Identical',
                        'options' => array(
                            'token' => 'password_user',
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'mail_user',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
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
                ),
            ));
            $inputFilter->add(array(
                'name' => 'date_de_naissance_user',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 10,
                            'max' => 10,
                        ),
                    ),
                    new Date(),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'sexe_user',
                'required' => true,
            ));
            $inputFilter->add(array(
                'name' => 'adresse_user',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
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
                ),
            ));
            $inputFilter->add(array(
                'name' => 'code_postal_user',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 5,
                            'max' => 5,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'ville_user',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 15,
                        ),
                    ),
                ),
            ));
            $inputFilter->add(array(
                'name' => 'pays_user',
                'required' => true,
                'filters' => array(
                    array('name' => 'StripTags'),
                    array('name' => 'StringTrim'),
                ),
                'validators' => array(
                    array(
                        'name' => 'StringLength',
                        'options' => array(
                            'encoding' => 'UTF-8',
                            'min' => 1,
                            'max' => 15,
                        ),
                    ),
                ),
            ));
            $this->inputFilter = $inputFilter;
        }
        return $this->inputFilter;
    }

    public function getArrayCopy() {
        return get_object_vars($this);
    }

}
