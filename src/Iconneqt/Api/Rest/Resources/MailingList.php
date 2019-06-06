<?php

namespace Iconneqt\Api\Rest\Resources;

/**
 * Basic Mailing List object
 * 
 * @copyright (c) 2016, Advanced CRMMail Technology B.V., Netherlands
 * @license MIT
 * @author Martijn W. van der Lee 
 */
class MailingList extends AbstractResource implements \JsonSerializable
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

	public function jsonSerialize()
	{
		return [
			'id' => $this->id,
			'name' => $this->name,
			'date' => $this->date->format(\DateTime::ISO8601),
			'userid' => $this->userid,
		];
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

	public function getFields($offset = 0, $limit = 100)
	{
		return $this->iconneqt->getListFields($this->id, $offset, $limit);
	}

	public function getSubscribers($offset = 0, $limit = 100)
	{
		return $this->iconneqt->getListSubscribers($this->id, $offset, $limit);
	}

	public function getFieldCount()
	{
		return $this->iconneqt->getListFieldCount($this->id);
	}

	public function getSubscriberCount()
	{
		return $this->iconneqt->getListSubscriberCount($this->id);
	}

	/**
	 * Create a subscriber
	 * @param string $email
	 * @param bool $is_confirmed
	 * @param array $fields
	 * @return integer subscriberid
	 */
	public function addSubscriber($email, $is_confirmed = true, $fields = [])
	{
		$subscriber = [
			'emailaddress' => $email,
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

	/**
	 * Create or update a subscriber
	 * @param string $email
	 * @param bool $is_confirmed
	 * @param array $fields
	 * @return integer subscriberid
	 */
	public function setSubscriber($email, $is_confirmed = true, $fields = [])
	{
		$subscriber = [
			'emailaddress' => $email,
			'fields' => $fields,
		];

		if (!$is_confirmed) {
			$subscriber = array_merge($subscriber, [
				'confirmed' => false,
				'confirmdate' => null,
				'confirmip' => null,
			]);
		}

		$result = $this->iconneqt->putListSubscriber($this->id, $subscriber);

		return $this->iconneqt->getListSubscriber($this->id, $result->subscriberid);
	}

	public function getSubscriber($subscriber)
	{
		return $this->iconneqt->getListSubscriber($this->id, $subscriber);
	}

	public function hasSubscriber($subscriber)
	{
		return $this->iconneqt->getListSubscriber($this->id, $subscriber);
	}

}
