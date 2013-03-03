<?php
namespace Newsies;

use Zend\EventManager\EventInterface;
use BjyAuthorize\View\RedirectionStrategy;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\ResultSet\ResultSet;
use Newsies\Model\Newsletter;
use Newsies\Model\NewsletterTable;


class Module
{
	
	public function onBootstrap(EventInterface $e)
	{
		$application = $e->getTarget();
		$eventManager = $application->getEventManager();
		
		//$strategy = new RedirectionStrategy();
		
		//$eventManager->attach($strategy);
	}
	
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                	'UIndy'		  => __DIR__ . '/../../vendor/UIndy',
                ),
            ),
        );
    }
    
    public function getServiceConfig()
    {
    	return array(
    		'factories' => array(
    			'Newsies\Model\NewsletterTable' => function($sm) {
    				$tableGateway = $sm->get('NewsletterTableGateway');
    				$table = new NewsletterTable($tableGateway);
    				
    				return $table;
    			},
    			'NewsletterTableGateway' => function($sm) {
    				$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    				$resultSetPrototype = new ResultSet();
    				$resultSetPrototype->setArrayObjectPrototype(new Newsletter());
    				
    				return new TableGateway('newsletters', $dbAdapter, null, $resultSetPrototype);
    			},
    			'newsies_module_options' => function ($sm) {
    				$config = $sm->get('Config');
    				return new \Newsies\Options\ModuleOptions(isset($config['newsies']) ? $config['newsies'] : array());
    			},
    			
    		),
    	);
    }
}
