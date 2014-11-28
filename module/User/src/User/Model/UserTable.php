<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Model;

 use Zend\Db\TableGateway\TableGateway;

 class UserTable
 {
     protected $tableGateway;

     public function __construct(TableGateway $tableGateway)
     {
         $this->tableGateway = $tableGateway;
     }

     public function fetchAll()
     {
         $resultSet = $this->tableGateway->select();
         return $resultSet;
     }

     public function getUser($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id_user' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function saveUser(User $user)
     {
         $data = array(
             'nom_user' => $user->nom_user,
             'prenom_user'  => $user->prenom_user,
             'mail_user'  => $user->mail_user,
             'date_de_naissance_user'  => $user->date_de_naissance_user,
             'sexe_user'  => $user->sexe_user,
             'adresse_user'  => $user->adresse_user,
             'code_postal_user'  => $user->code_postal_user,
             'ville_user'  => $user->ville_user,
             'pays_user'  => $user->pays_user,
         );
         $id = (int) $user->id_user;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getUser($id)) {
                 $this->tableGateway->update($data, array('id_user' => $id));
             } else {
                 throw new \Exception('User id does not exist');
             }
         }
     }

     public function deleteUser($id)
     {
         $this->tableGateway->delete(array('id_user' => (int) $id));
     }
 }