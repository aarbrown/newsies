<?php 
namespace Newsies\Model;

use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;

class NewsletterTable
{
	protected $tableGateway;
	
	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	
	public function fetchAll()
	{
		//fetch all regardless of status, ordered by publication_date
		$resultSet = $this->tableGateway->select(function(Select $select) {
			$select->order('publication_date DESC');
		});
	
		return $resultSet;
	}
	
	public function fetchAllPublished()
	{
		//only fetch published newsletters, ordered by publication_date
		$resultSet = $this->tableGateway->select(function(Select $select) {
			$select->where(array('status' => 'published'));
			$select->order('publication_date DESC');
		});
		
		return $resultSet;
	}
	
	public function getNewsletter($id)
	{
		$id = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		
		return $row;
	}
	
	public function saveNewsletter(Newsletter $newsletter)
	{
		$data = array(
			'title'			 	=> $newsletter->title,
			'publication_date'	=> $newsletter->publication_date,
			'status' 		 	=> $newsletter->status,
			'image'			 	=> $newsletter->image,
			'document'		 	=> $newsletter->document,
			'document_type'	 	=> $newsletter->document_type,
			'page_count'	 	=> $newsletter->page_count,	
			'filesize'		 	=> $newsletter->filesize,	
		);
		
		$id = (int) $newsletter->id;
		if ($id == 0) {
			$this->tableGateway->insert($data);
		} else {
			if ($this->getNewsletter($id)) {
				$this->tableGateway->update($data, array('id' => $id));
			} else {
				throw new \Exception('Newsletter id does not exist!');
			}
		}
	}
	
	public function deleteNewsletter($id)
	{
		$this->tableGateway->delete(array('id' => $id));
	}
}