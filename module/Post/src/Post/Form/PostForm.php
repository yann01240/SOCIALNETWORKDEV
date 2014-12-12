<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Post\Form;

 use Zend\Form\Form;

 class PostForm extends Form
 {
     public function __construct($name = null)
     {
         // we want to ignore the name passed
         parent::__construct('post');

         $this->add(array(
             'name' => 'id_post',
             'type' => 'Hidden',
         ));
         $this->add(array(
             'name' => 'id_user',
             'type' => 'Text',
             'options' => array(
                 'label' => 'id user',
             ),
         ));
         $this->add(array(
             'name' => 'titre',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Titre',
             ),
         ));
         $this->add(array(
             'name' => 'contenu',
             'type' => 'Text',
             'options' => array(
                 'label' => 'Contenu',
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