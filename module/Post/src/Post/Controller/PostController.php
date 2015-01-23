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
use Zend\Session\Container;

class PostController extends AbstractActionController {

    protected $postTable;
    protected $userTable;

    public function indexAction() {
        $session = new Container('socialnetwork_user');
        if (!$session->offsetExists('id_user')) {
            return $this->redirect()->toRoute('user', array(
                        'action' => 'login'
            ));
        }
        return new ViewModel(array(
            'posts' => $this->getPostTable()->fetchAll(),
            'users' => $this->getUserTable()->fetchAll(),
        ));
    }

    public function addAction() {
        $session = new Container('socialnetwork_user');
        if (!$session->offsetExists('id_user')) {
            return $this->redirect()->toRoute('user', array(
                        'action' => 'login'
            ));
        }
        $form = new PostForm();
        $form->get('submit')->setValue('Poster');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = new Post();
            $form->setInputFilter($post->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $post->exchangeArray($form->getData());
                $this->getPostTable()->savePost($post);

                // Redirect to list of posts
                return $this->redirect()->toRoute('post', array(
                        'action' => 'index'
            ));
            }
        }
        return array('form' => $form);
    }

    public function editAction() {
        $session = new Container('socialnetwork_user');
        if ($session->offsetExists('id_user')) {
            $id_user = $session->offsetGet('id_user');
        } else {
            return $this->redirect()->toRoute('user', array(
                        'action' => 'login'
            ));
        }
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
            if ($post->id_user != $id_user) {
                return $this->redirect()->toRoute('post', array(
                            'action' => 'index'
                ));
            }
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('post', array(
                        'action' => 'index'
            ));
        }

        $form = new PostForm();
        $form->bind($post);
        $form->get('submit')->setValue('Modifier');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($post->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getPostTable()->savePost($post);

                // Redirect to list of posts
                return $this->redirect()->toRoute('post', array(
                        'action' => 'index'
            ));
            }
        }

        return array(
            'id' => $id,
            'form' => $form,
        );
    }

    public function deleteAction() {
        $session = new Container('socialnetwork_user');
        if ($session->offsetExists('id_user')) {
            $id_user = $session->offsetGet('id_user');
        } else {
            return $this->redirect()->toRoute('user', array(
                        'action' => 'login'
            ));
        }
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('post');
        }
        if ($this->getPostTable()->getPost($id)->id_user != $id_user) {
                return $this->redirect()->toRoute('post', array(
                            'action' => 'index'
                ));
            }
        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                $id = (int) $request->getPost('id');
                $this->getPostTable()->deletePost($id);
            }

            // Redirect to list of posts
            return $this->redirect()->toRoute('post', array(
                        'action' => 'index'
            ));
        }

        return array(
            'id' => $id,
            'post' => $this->getPostTable()->getPost($id)
        );
    }

    public function getPostTable() {
        if (!$this->postTable) {
            $sm = $this->getServiceLocator();
            $this->postTable = $sm->get('Post\Model\PostTable');
        }
        return $this->postTable;
    }
    
    public function getUserTable()
     {
         if (!$this->userTable) {
             $sm = $this->getServiceLocator();
             $this->userTable = $sm->get('User\Model\UserTable');
         }
         return $this->userTable;
     }

}
