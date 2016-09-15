<?php

namespace Iconneqt\Api\Rest\Resources;

/**
 * Basic Subscriber object
 * 
 * @author Martijn W. van der Lee
 */
class Subscriber extends AbstractResource
{

	private $id;
	private $email;
	private $date;
	private $code;
	private $confirmed;
	private $unsubscribed;
	private $bounced;
	private $listid;

	public function __construct(\Iconneqt\Api\Rest\Iconneqt $iconneqt, $subscriber)
	{
		parent::__construct($iconneqt);

		$this->id = $subscriber->id;
		$this->email = $subscriber->email;
		$this->date = new \DateTime($subscriber->date);
		$this->code = $subscriber->code;
		$this->confirmed = $subscriber->confirmed;
		$this->unsubscribed = $subscriber->unsubscribed;
		$this->bounced = $subscriber->bounced;
		$this->listid = $subscriber->list;
	}

	public function getId()
	{
		return $this->id;
	}

	public function getEmail()
	{
		return $this->email;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getConfirmationCode()
	{
		return $this->code;
	}

	public function isConfirmed()
	{
		return $this->confirmed;
	}

	public function isUnsubscribed()
	{
		return $this->unsubscribed;
	}

	public function isBounced()
	{
		return $this->bounced;
	}

	public function isActive()
	{
		return $this->confirmed && !$this->unsubscribed && !$this->bounced;
	}

	public function getListId()
	{
		return $this->listid;
	}

	public function getList()
	{
		return $this->iconneqt->getList($listid);
	}
	
	public function getFields()
	{
		return $this->iconneqt->getSubscriberFields($this->id);
	}
	

}
