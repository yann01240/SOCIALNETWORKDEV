<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Post\Controller;

 use Zend\Mvc\Controller\AbstractActionController;
 use Zend\View\Model\ViewModel;
 use Post\Model\Post;
 use Post\Form\PostForm;

 class PostController extends AbstractActionController
 {
     protected $postTable;
     
     public function indexAction()
     {
         return new ViewModel(array(
             'posts' => $this->getPostTable()->fetchAll(),
         ));
     }

     public function addAction()
     {
         $form = new PostForm();
         $form->get('submit')->setValue('Add');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $post = new Post();
             $form->setInputFilter($post->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $post->exchangeArray($form->getData());
                 $this->getPostTable()->savePost($post);

                 // Redirect to list of posts
                 return $this->redirect()->toRoute('post');
             }
         }
         return array('form' => $form);
     }

     public function editAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('post', array(
                 'action' => 'add'
             ));
         }

         // Get the Post with the specified id.  An exception is thrown
         // if it cannot be found, in which case go to the index page.
         try {
             $post = $this->getPostTable()->getPost($id);
         }
         catch (\Exception $ex) {
             return $this->redirect()->toRoute('post', array(
                 'action' => 'index'
             ));
         }

         $form  = new PostForm();
         $form->bind($post);
         $form->get('submit')->setAttribute('value', 'Edit');

         $request = $this->getRequest();
         if ($request->isPost()) {
             $form->setInputFilter($post->getInputFilter());
             $form->setData($request->getPost());

             if ($form->isValid()) {
                 $this->getPostTable()->savePost($post);

                 // Redirect to list of posts
                 return $this->redirect()->toRoute('post');
             }
         }

         return array(
             'id' => $id,
             'form' => $form,
         );
     }

     public function deleteAction()
     {
         $id = (int) $this->params()->fromRoute('id', 0);
         if (!$id) {
             return $this->redirect()->toRoute('post');
         }

         $request = $this->getRequest();
         if ($request->isPost()) {
             $del = $request->getPost('del', 'No');

             if ($del == 'Yes') {
                 $id = (int) $request->getPost('id');
                 $this->getPostTable()->deletePost($id);
             }

             // Redirect to list of posts
             return $this->redirect()->toRoute('post');
         }

         return array(
             'id'    => $id,
             'post' => $this->getPostTable()->getPost($id)
         );
     }
     
     public function getPostTable()
     {
         if (!$this->postTable) {
             $sm = $this->getServiceLocator();
             $this->postTable = $sm->get('Post\Model\PostTable');
         }
         return $this->postTable;
     }
 }