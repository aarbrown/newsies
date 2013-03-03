<?php

namespace Newsies\Options;

use Zend\Stdlib\AbstractOptions;

class ModuleOptions extends AbstractOptions implements NewsletterControllerOptionsInterface
{
    /**
     * @var int
     */
    protected $maxActiveNewsletters;

    /**
     * @var int
     */
    protected $maxArchivedNewsletters;
    
    protected $imageUploadDirectory;
    
    protected $documentUploadDirectory;

    /**
     * set maxActiveNewsletters
     *
     * @param int $maxActiveNewsletters
     * @return ModuleOptions
     */
    public function setMaxActiveNewsletters($maxActiveNewsletters = 6)
    {
        $this->maxActiveNewsletters = (int) $maxActiveNewsletters;
        return $this;
    }

    /**
     * get maxActiveNewsletters
     *
     * @return int
     */
    public function getMaxActiveNewsletters()
    {
        return $this->maxActiveNewsletters;
    }
    
    /**
     * set maxArchivedNewsletters
     *
     * @param int maxArchivedNewsletters
     * @return ModuleOptions
     */
    public function setMaxArchivedNewsletters($maxArchivedNewsletters = 10)
    {
        $this->maxArchivedNewsletters = (int) $maxArchivedNewsletters;
        return $this;
    }

    /**
     * get maxActiveNewsletters
     *
     * @return int
     */
    public function getMaxArchivedNewsletters()
    {
        return $this->maxActiveNewsletters;
    }
    
    public function setImageUploadDirectory($imageUploadDirectory)
    {
    	$this->imageUploadDirectory = $imageUploadDirectory;
    	return $this;
    }
    
    public function getImageUploadDirectory()
    {
    	return $this->imageUploadDirectory;
    }
    
    public function setDocumentUploadDirectory($documentUploadDirectory)
    {
    	$this->documentUploadDirectory = $documentUploadDirectory;
    	return $this;
    }
    
    public function getDocumentUploadDirectory()
    {
    	return $this->documentUploadDirectory;
    }
}
