<?php
return array(
	'controllers' => array(
		'invokables' => array(
			'Newsies\Controller\Newsletter' => 'Newsies\Controller\NewsletterController',
			'Newsies\Controller\Admin' => 'Newsies\Controller\AdminController',
		),
	),
	'router' => array(
		'routes' => array(
			// Override the ZendSkeletonApp's default route
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
			// newsletter controller
			'newsletter' => array(
				'type' => 'Zend\Mvc\Router\Http\Literal',
				'options' => array(
					'route' => '/',
					'defaults' => array(
						'controller' => 'Newsies\Controller\Newsletter',
						'action'	 => 'index',
					),
				),
			),
			'document' => array(
					'type' => 'Zend\Mvc\Router\Http\Segment',
					'options' => array(
							'route' => '/document/:id[/]',
							'defaults' => array(
									'controller' => 'Newsies\Controller\Newsletter',
									'action'	 => 'document',
							),
							'constraints' => array(
									'id' => '[0-9]{1,10}', //this will constrain the id to numbers from 0-9999999999 only
							),
					),
			),
			'image' => array(
					'type' => 'Zend\Mvc\Router\Http\Segment',
					'options' => array(
							'route' => '/image/:id[/]',
							'defaults' => array(
									'controller' => 'Newsies\Controller\Newsletter',
									'action'	 => 'image',
							),
							'constraints' => array(
									'id' => '[0-9]{1,10}', //this will constrain the id to numbers from 0-9999999999 only
							),
					),
			),
			'zfcadmin' => array(
					'child_routes' => array(
							'newsies' => array(
									'type' => 'Literal',
									'options' => array(
											'route' => '/admin',
											'defaults' => array(
													'controller' => 'admin',
													'action'     => 'index',
											),
									),
									'child_routes' =>array(
											'mychildroute' => array(
													'type' => 'literal',
													'options' => array(
															'route' => '/',
															'defaults' => array(
																	'controller' => 'mycontroller',
																	'action'     => 'myaction',
															),
													),
											),
									),
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