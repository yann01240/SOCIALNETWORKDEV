<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

 namespace User;

 use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
 use Zend\ModuleManager\Feature\ConfigProviderInterface;
 use User\Model\User;
 use User\Model\UserTable;
 use Zend\Db\ResultSet\ResultSet;
 use Zend\Db\TableGateway\TableGateway;
 use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session as SessionStorage,
    Zend\Http\Client as HTTPClient,
    ZendOAuth\OAuth;

 class Module implements AutoloaderProviderInterface, ConfigProviderInterface
 {
     public function getAutoloaderConfig()
     {
         return array(
             'Zend\Loader\ClassMapAutoloader' => array(
                 __DIR__ . '/autoload_classmap.php',
             ),
             'Zend\Loader\StandardAutoloader' => array(
                 'namespaces' => array(
                     __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                 ),
             ),
         );
     }

     public function getConfig()
     {
         return include __DIR__ . '/config/module.config.php';
     }
     
     public function getServiceConfig()
     {
         return array(
             'factories' => array(
                'auth_service' => function ($sm) {
                    $authService = new AuthenticationService(new SessionStorage('auth'));
//    				$authService->setStorage(new SessionStorage('auth'));
                    return $authService;
                },
                'twitter_oauth' => function ($sm) {
                    $httpConfig = array(
                        'adapter' => 'Zend\Http\Client\Adapter\Socket',
                        'sslverifypeer' => false
                    );
                    $httpClient = new HTTPClient(null, $httpConfig);
                    OAuth::setHttpClient($httpClient);
                    $config = $sm->get('Config');
                    $consumer = new \ZendOAuth\Consumer($config['twitter']);
                    return $consumer;
                },
                 'User\Model\UserTable' =>  function($sm) {
                     $tableGateway = $sm->get('UserTableGateway');
                     $table = new UserTable($tableGateway);
                     return $table;
                 },
                 'UserTableGateway' => function ($sm) {
                     $dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
                     $resultSetPrototype = new ResultSet();
                     $resultSetPrototype->setArrayObjectPrototype(new User());
                     return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
                 },
             ),
         );
     }
 }
 