<?php

namespace Iconneqt\Api\Rest\Resources;

/**
 * Basic Mailing List object
 * 
 * @author Martijn W. van der Lee
 */
class MailingList extends AbstractResource
{

	private $id;
	private $name;
	private $date;
	private $userid;

	public function __construct(\Iconneqt\Api\Rest\Iconneqt $iconneqt, $list)
	{
		parent::__construct($iconneqt);

		$this->id = $list->id;
		$this->name = $list->name;
		$this->date = new \DateTime($list->date);
		$this->userid = $list->user;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName()
	{
		return $this->name;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getUserId()
	{
		return $this->userid;
	}

	public function getFields()
	{
		return $this->iconneqt->getListFields($this->id);
	}

	public function getSubscribers()
	{
		return $this->iconneqt->getListSubscribers($this->id);
	}

	public function getFieldCount()
	{
		return $this->iconneqt->getListFieldCount($this->id);
	}

	public function getSubscriberCount()
	{
		return $this->iconneqt->getListSubscriberCount($this->id);
	}
	
	public function addSubscriber($email, $is_confirmed = true, $fields = []) {
		$subscriber = [
			'emailaddress'	=> $email,			
			'fields' => $fields,
		];
		
		if (!$is_confirmed) {
			$subscriber = array_merge($subscriber, [
				'confirmed' => false,
				'confirmdate' => null,
				'confirmip' => null,
			]);
		}
		
		$result = $this->iconneqt->postListSubscriber($this->id, $subscriber);
		
		return $this->iconneqt->getListSubscriber($this->id, $result->subscriberid);
	}

	public function getSubscriber($subscriber)
	{
		return $this->iconneqt->getListSubscriber($this->id, $subscriber);
	}	
	
	public function hasSubscriber($subscriber) {
		return $this->iconneqt->getListSubscriber($this->id, $subscriber);
	}
}
