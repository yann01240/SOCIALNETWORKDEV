<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use User\Model\User;
use User\Form\UserForm;
use User\Form\LoginForm;
use Zend\Authentication\Adapter\DbTable;
use Zend\Session\Container;

class UserController extends AbstractActionController {

    protected $userTable;

    public function indexAction() {

        $session = new Container('socialnetwork_user');
        if (!$session->offsetExists('id_user')) {
            return $this->redirect()->toRoute('user', array(
                        'action' => 'login'
            ));
        }
        return new ViewModel(array(
            'users' => $this->getUserTable()->fetchAll(),
        ));
    }

    public function addAction() {
        $session = new Container('socialnetwork_user');
        if ($session->offsetExists('id_user')) {
            return $this->redirect()->toRoute('post', array(
                        'action' => 'index'
            ));
        }
        $form = new UserForm();
        $form->get('submit')->setValue('Inscription');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $user = new User();
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $user->exchangeArray($form->getData());
                $this->getUserTable()->saveUser($user);

                // Redirect to list of users
                return $this->redirect()->toRoute('user', array(
                            'action' => 'login'
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
            return $this->redirect()->toRoute('user', array(
                        'action' => 'add'
            ));
        }

        // Get the User with the specified id.  An exception is thrown
        // if it cannot be found, in which case go to the index page.
        try {
            $user = $this->getUserTable()->getUser($id);

            if ($user->id_user != $id_user) {
                return $this->redirect()->toRoute('post', array(
                            'action' => 'index'
                ));
            }
        } catch (\Exception $ex) {
            return $this->redirect()->toRoute('user', array(
                        'action' => 'index'
            ));
        }

        $form = new UserForm();
        $form->bind($user);
        $form->get('submit')->setAttribute('value', 'Edit');

        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setInputFilter($user->getInputFilter());
            $form->setData($request->getPost());

            if ($form->isValid()) {
                $this->getUserTable()->saveUser($user);

                // Redirect to list of users
                return $this->redirect()->toRoute('user', array(
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
            return $this->redirect()->toRoute('user');
        }
        if ($id != $id_user) {
            return $this->redirect()->toRoute('post', array(
                        'action' => 'index'
            ));
        }

        $request = $this->getRequest();
        if ($request->isPost()) {
            $del = $request->getPost('del', 'Non');

            if ($del == 'Oui') {
                $id = (int) $request->getPost('id');

                $this->getUserTable()->deleteUser($id);
            }

            // Redirect to list of users
            return $this->redirect()->toRoute('user', array(
                        'action' => 'index'
            ));
        }

        return array(
            'id' => $id,
            'user' => $this->getUserTable()->getUser($id)
        );
    }

    public function getUserTable() {
        if (!$this->userTable) {
            $sm = $this->getServiceLocator();
            $this->userTable = $sm->get('User\Model\UserTable');
        }
        return $this->userTable;
    }

    public function loginAction() {
        $authService = $this->serviceLocator->get('auth_service');
        if ($authService->hasIdentity()) {
            return $this->redirect()->toRoute('user', array(
                        'action' => 'index'
            ));
        }

        $form = new LoginForm();
        $loginMsg = array();
        if ($this->getRequest()->isPost()) {

            $user = new User();
            $form->setInputFilter($user->getInputFilter());
            $form->setData($this->getRequest()->getPost());
            if (!$form->isValid()) {
                // not valid form
                return new ViewModel(array(
                    'title' => 'Log In',
                    'form' => $form
                ));
            }
            $dbAdapter = $this->serviceLocator->get('Zend\Db\Adapter\Adapter');
            $loginData = $form->getData();
            $authAdapter = new DbTable($dbAdapter, 'users', 'mail_user', 'password_user', 'MD5(?)');
            $authAdapter->setIdentity($loginData['mail_user'])->setCredential($loginData['password_user']);
            $authService = $this->serviceLocator->get('auth_service');
            $authService->setAdapter($authAdapter);
            $result = $authService->authenticate();
            if ($result->isValid()) {

                // set id as identifier in session
                $userId = $authAdapter->getResultRowObject('id_user')->id_user;
                $authService->getStorage()->write($userId);

                $session = new Container('socialnetwork_user');
                $session->id_user = $userId;
                return $this->redirect()->toRoute('user', array(
                            'action' => 'index'
                ));
            } else {
                $loginMsg = $result->getMessages();
            }
        }

        return new ViewModel(array(
            'title' => 'Log In',
            'form' => $form
        ));
    }

    public function logoutAction() {
        $authService = $this->serviceLocator->get('auth_service');
        if (!$authService->hasIdentity()) {
            // if not log in, redirect to login page
            return $this->redirect()->toRoute('user', array(
                        'action' => 'login'
            ));
        }

        $authService->clearIdentity();
        $session = new Container('socialnetwork_user');
        $session->getManager()->getStorage()->clear('socialnetwork_user');
        $form = new LoginForm();
        $viewModel = new ViewModel(array('loginMsg' => array('You have been logged out'),
            'form' => $form,
            'title' => 'Log out'
        ));
        $viewModel->setTemplate('user/user/login.phtml');
        return $viewModel;
    }

}
