<?php 
namespace Newsies\Options;

interface NewsletterControllerOptionsInterface
{

	 /**
     * set maxActiveNewsletters
     *
     * @param int $maxActiveNewsletters
     * @return ModuleOptions
     */
	public function setMaxActiveNewsletters($maxActiveNewsletters);
	
	/**
	 * get maxActiveNewsletters
	 *
	 * @return int
	 */
	public function getMaxActiveNewsletters();
	
	/**
	 * set maxArchivedNewsletters
	 *
	 * @param int maxArchivedNewsletters
	 * @return ModuleOptions
	 */
	public function setMaxArchivedNewsletters($maxArchivedNewsletters);
	
	/**
	 * get maxActiveNewsletters
	 *
	 * @return int
	 */
	public function getMaxArchivedNewsletters();
	
	public function setImageUploadDirectory($imageUploadDirectory);
	
	public function getImageUploadDirectory();
	
	public function setDocumentUploadDirectory($documentUploadDirectory);
	
	public function getDocumentUploadDirectory();
    
    
	
}