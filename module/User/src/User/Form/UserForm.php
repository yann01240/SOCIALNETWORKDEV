<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Form;

use Zend\Form\Form,
    Zend\Form\Element\Hidden,
    Zend\Form\Element\Text,
    Zend\Form\Element\Password;

class UserForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('user');

        $id_user = new Hidden('id_user');
        $this->add($id_user);

        $nom_user = new Text('nom_user');
        $nom_user->setAttribute('class', 'form-control');
        $nom_user->setAttribute('placeholder', 'Entre ton nom');
        $this->add($nom_user);

        $prenom_user = new Text('prenom_user');
        $prenom_user->setAttribute('class', 'form-control');
        $prenom_user->setAttribute('placeholder', 'Entre ton prenom');
        $this->add($prenom_user);

        $mail_user = new Text('mail_user');
        $mail_user->setAttribute('class', 'form-control');
        $mail_user->setAttribute('placeholder', 'Entre ton mail');
        $this->add($mail_user);

        $password_user = new Password('password_user');
        $password_user->setAttribute('class', 'form-control');
        $password_user->setAttribute('placeholder', 'Entre ton password');
        $this->add($password_user);

        $repassword_user = new Password('repassword_user');
        $repassword_user->setAttribute('class', 'form-control');
        $repassword_user->setAttribute('placeholder', 'Entre encore ton password ');
        $this->add($repassword_user);

        $date_de_naissance_user = new \Zend\Form\Element\Date('date_de_naissance_user');
        $date_de_naissance_user->setAttribute('class', 'form-control');
        $date_de_naissance_user->setAttribute('placeholder', 'Format AAAA-MM-JJ');
        $this->add($date_de_naissance_user);

        $adresse_user = new Text('adresse_user');
        $adresse_user->setAttribute('class', 'form-control');
        $adresse_user->setAttribute('placeholder', 'Entre ton adresse');
        $this->add($adresse_user);

        $code_postal_user = new Text('code_postal_user');
        $code_postal_user->setAttribute('class', 'form-control');
        $code_postal_user->setAttribute('placeholder', 'Entre ton Code Postal');
        $this->add($code_postal_user);

        $pays_user = new Text('pays_user');
        $pays_user->setAttribute('class', 'form-control');
        $pays_user->setAttribute('placeholder', 'Entre ton Pays');
        $this->add($pays_user);

        $ville_user = new Text('ville_user');
        $ville_user->setAttribute('class', 'form-control');
        $ville_user->setAttribute('placeholder', 'Entre ta ville');
        $this->add($ville_user);

        $sexe_user = new \Zend\Form\Element\Select('sexe_user');
        
        $ville_user->setAttribute('class', 'selectpicker');
        $sexe_user->setValueOptions(array(
                'Homme' => 'Homme',
                'Femme' => 'Femme',
            ));
        $sexe_user->setEmptyOption('- - -');
        $this->add($sexe_user);
        
        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setAttribute('value', 'Go');
        $submit->setAttribute('class', 'btn btn_primary');
        $this->add($submit);
    }

}
