<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Post\Model;

 use Zend\Db\TableGateway\TableGateway;

 class PostTable
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

     public function getPost($id)
     {
         $id  = (int) $id;
         $rowset = $this->tableGateway->select(array('id_post' => $id));
         $row = $rowset->current();
         if (!$row) {
             throw new \Exception("Could not find row $id");
         }
         return $row;
     }

     public function savePost(Post $post)
     {
         $data = array(
             'id_user' => $post->id_user,
             'titre'  => $post->titre,
             'contenu'  => $post->contenu,
         );

         $id = (int) $post->id_post;
         if ($id == 0) {
             $this->tableGateway->insert($data);
         } else {
             if ($this->getPost($id)) {
                 $this->tableGateway->update($data, array('id_post' => $id));
             } else {
                 throw new \Exception('Post id does not exist');
             }
         }
     }

     public function deletePost($id)
     {
         $this->tableGateway->delete(array('id_post' => (int) $id));
     }
 }