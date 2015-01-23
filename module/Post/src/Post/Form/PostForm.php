<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Post\Form;

use Zend\Form\Form;

class PostForm extends Form {

    public function __construct($name = null) {
        // we want to ignore the name passed
        parent::__construct('post');

        $this->add(array(
            'name' => 'id_post',
            'type' => 'Hidden',
        ));
        $this->add(array(
            'name' => 'id_user',
            'type' => 'Hidden',
        ));
        $titre = new \Zend\Form\Element\Text("titre");
        $titre->setAttribute('class', 'form-control');
        $titre->setAttribute('placeholder', 'Titre du post');
        $this->add($titre);
        $contenu = new \Zend\Form\Element\Textarea("contenu");
        
        $contenu->setAttribute('rows', '10');
        $contenu->setAttribute('class', 'form-control');
        $contenu->setAttribute('placeholder', 'Contenu du post');
        $this->add($contenu);

        $submit = new \Zend\Form\Element\Submit('submit');
        $submit->setValue('Post');
        $submit->setAttribute('class', 'btn btn-primary col-xs-2');
        $this->add($submit);
    }

}
