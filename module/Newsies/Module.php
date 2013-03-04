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
		// sets up redirection to zfcuser if an unauthorized user tries to access admin route
		$application = $e->getTarget();
		$eventManager = $application->getEventManager();
		
		$strategy = new RedirectionStrategy();
		
		$eventManager->attach($strategy);
		
		// selects the correct layout for each controller
		// see http://www.ivangospodinow.com/?p=71
		$e->getApplication()->getEventManager()->getSharedManager()
		->attach('Zend\Mvc\Controller\AbstractActionController', 'dispatch', function($e) {
			$controller = $e->getTarget();
			$controllerClass = get_class($controller);
			$ar = explode('\\',$controllerClass);
			$controllerStr = str_replace('Controller','',$ar[count($ar) -1]);
			$config = $e->getApplication()->getServiceManager()->get('config');
			
			if (isset($config['controller_layouts'][$controllerStr])) {
				$controller->layout($config['controller_layouts'][$controllerStr]);
			}
		}, 100);
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
