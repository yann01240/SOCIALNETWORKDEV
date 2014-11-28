<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Form;

 use Zend\Form\Form;

 class UserForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('user');

         $this->add(array(
             'name' => 'id_user',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'prenom_user',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Prenom',
             ),
         ));
         $this->add(array(
             'name' => 'nom_user',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Nom',
             ),
         ));
         $this->add(array(
             'name' => 'mail_user',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Adresse Mail',
             ),
         ));
         $this->add(array(
             'name' => 'date_de_naissance_user',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Date de Naissance',
             ),
         ));
         $this->add(array(
             'name' => 'sexe_user',
             'type' => 'Select',
             'options' => array(
                 'label' => 'Sexe',
                 'value_options' => array(
                     'Homme'=>'Homme',
                     'Femme'=>'Femme',
                     ),
                 'empty_option' => '- - -',
             ),
         ));
         $this->add(array(
             'name' => 'adresse_user',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Adresse',
             ),
         ));
         $this->add(array(
             'name' => 'code_postal_user',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Code Postal',
             ),
         ));
         $this->add(array(
             'name' => 'ville_user',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Ville',
             ),
         ));
         $this->add(array(
             'name' => 'pays_user',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Pays',
             ),
         ));
         $this->add(array(
             'name' => 'submit',
             'type' => 'Submit',
             'attributes' => array(
                 'value' => 'Go',
                 'id' => 'submitbutton',
             ),
         ));
     }
 }