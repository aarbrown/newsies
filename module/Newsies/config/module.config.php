<?php
return array(
	'controllers' => array(
		'invokables' => array(
			'Newsies\Controller\Newsletter' => 'Newsies\Controller\NewsletterController',
		),
	),
	'router' => array(
		'routes' => array(
			// Override the ZendSkeletonApp's default routes
			'home' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route'    => '/',
					'defaults' => array(
						'controller' => 'Newsies\Controller\Newsletter',
						'action'     => 'index',
					),
				),
			),
			// Override the ZendSkeletonApp's default routes
			'application' => array(
				'type'    => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route'    => '/',
					'defaults' => array(
						'controller' => 'Newsies\Controller\Newsletter',
						'action'     => 'index',
					),
				),
			),
			// Display newsletter listing
			'newsies' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route' => '/',
					'defaults' => array(
						'controller' => 'Newsies\Controller\Newsletter',
						'action'	 => 'index',
					),
				),
			),
		),
	),
	'view_manager' => array(
		'template_path_stack' => array(
			'newsies' => __DIR__ . '/../view',
		),
	),
);