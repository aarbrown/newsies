<?php 
namespace Newsies\Model;

class Newsletter
{
	public $id;
	public $title;
	public $publication_date;
	public $status;
	public $image;
	public $document;
	public $document_type;
	public $page_count;
	public $filesize;
	
	public function exchangeArray(array $data)
	{
		$this->id 					= (isset($data['id'])) ? $data['id'] : null;
		$this->title 				= (isset($data['title'])) ? $data['title'] : null;
		$this->publication_date 	= (isset($data['publication_date'])) ? $data['publication_date'] : null;
		$this->status 				= (isset($data['status'])) ? $data['status'] : null;
		$this->image 				= (isset($data['image'])) ? $data['image'] : null;
		$this->document 			= (isset($data['document'])) ? $data['document'] : null;
		$this->document_type 		= (isset($data['document_type'])) ? $data['document_type'] : null;
		$this->page_count 			= (isset($data['page_count'])) ? $data['page_count'] : null;
		$this->filesize 			= (isset($data['filesize'])) ? $data['filesize'] : null;
	}
	
	public function getPublicationDateText() 
	{
		return date('F Y', strtotime($this->publication_date));
	}
}