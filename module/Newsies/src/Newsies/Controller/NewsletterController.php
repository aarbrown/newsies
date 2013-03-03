<?php
namespace Newsies\Controller;

use Newsies\Model\Newsletter;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Newsies\Options\NewsletterControllerOptionsInterface;

class NewsletterController extends AbstractActionController 
{
	protected $newsletterTable;
	protected $options;
	
	public function indexAction()
	{
		return new ViewModel(array(
			'publishedNewsletters' => $this->getNewsletterTable()->fetchAllPublished(),
			'maxArchivedNewsletters' => $this->getOptions()->getMaxArchivedNewsletters(),
			'maxActiveNewsletters' => $this->getOptions()->getMaxActiveNewsletters(),
		));
	}
	
	public function documentAction()
	{
		$documentId = (int) $this->params('id');
		if (!is_int($documentId)) {
			throw new \Exception('ID was expected to be a number');
		}
		
		//this line will throw an exception if the id param does not exist in the database
		$newsletter = $this->getNewsletterTable()->getNewsletter($documentId);
		$documentUploadDirectory = $this->getOptions()->getDocumentUploadDirectory();
		
		//disable the layout in our view model
		$viewModel = new ViewModel();
		$viewModel->setTerminal(true);

		header("Content-Type: application/pdf");
		readfile($documentUploadDirectory . $newsletter->document);
	}
	
	public function imageAction()
	{
		$imageId = (int) $this->params('id');
		if (!is_int($imageId)) {
			throw new \Exception('ID was expected to be a number');
		}
		
		//this line will throw an exception if the id param does not exist in the database
		$newsletter = $this->getNewsletterTable()->getNewsletter($imageId);
		$imageUploadDirectory = $this->getOptions()->getImageUploadDirectory();
		
		//disable the layout in our view model
		$viewModel = new ViewModel();
		$viewModel->setTerminal(true);

		header("Content-Type: image/jpeg");
		readfile($imageUploadDirectory . $newsletter->image);
	}

	public function getNewsletterTable()
	{
		if (!$this->newsletterTable) {
			$sm = $this->getServiceLocator();
			$this->newsletterTable = $sm->get('Newsies\Model\NewsletterTable');
		}
		
		return $this->newsletterTable;
	}
	
	/**
	 * set options
	 *
	 * @param NewsletterControllerOptionsInterface $options
	 * @return NewsletterController
	 */
	public function setOptions(NewsletterControllerOptionsInterface $options)
	{
		$this->options = $options;
		
		return $this;
	}
	
	/**
	 * get options
	 *
	 * @return NewsletterControllerOptionsInterface
	 */
	public function getOptions()
	{ 
		if (!$this->options instanceof NewsletterControllerOptionsInterface) {
			$this->setOptions($this->getServiceLocator()->get('newsies_module_options'));
		}
		
		return $this->options;
	}
}