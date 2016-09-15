<?php

namespace Iconneqt\Api\Rest;

/**
 * High-level API abstraction
 * @copyright (c) 2016, Advanced CRMMail Technology B.V., Netherlands
 * @author Martijn W. van der Lee
 */
class Iconneqt
{

	private $client;

	public function __construct($url, $username, $token)
	{
		$this->client = new Client\Client($url, $username, $token);
	}

	/**
	 * Get all Lists that can be accessed using the credentials used.
	 * @param integer $offset
	 * @param integer $limit
	 * @return \Iconneqt\Api\Rest\MailingList[]
	 */
	public function getLists($offset = 0, $limit = 100)
	{
		$lists = [];
		foreach ($this->client->get("lists?offset={$offset}&limit={$limit}") as $list) {
			$lists[] = new Resources\MailingList($this, $list);
		}
		return $lists;
	}

	/**
	 * Get the number of lists that can be accessed using the credentials used.
	 * @return integer
	 */
	public function getListCount()
	{
		return $this->client->get("lists/count");
	}

	/**
	 * Get a specific list.
	 * @param integer $list
	 * @return \Iconneqt\Api\Rest\MailingList
	 */
	public function getList($list)
	{
		return new Resources\MailingList($this, $this->client->get("lists/{$list}"));
	}

	/**
	 * Get all fields that are associated with a list.
	 * @param integer $list
	 * @param integer $offset
	 * @param integer $limit
	 * @return \Iconneqt\Api\Rest\Resources\ListField[]
	 */
	public function getListFields($list, $offset = 0, $limit = 100)
	{
		$fields = [];
		foreach ($this->client->get("lists/{$list}/fields?offset={$offset}&limit={$limit}") as $field) {
			$fields[] = new Resources\ListField($this, $field);
		}
		return $fields;
	}

	/**
	 * Get the number of fields associated with a list
	 * @param integer $list
	 * @return integer
	 */
	public function getListFieldCount($list)
	{
		return $this->client->get("lists/{$list}/fields/count");
	}

	/*
	 * Get all fields that are associated with a list.
	 * @param integer $list
	 * @param integer $offset
	 * @param integer $limit
	 * @return \Iconneqt\Api\Rest\Resources\Subscriber[]
	 */
	public function getListSubscribers($list, $offset = 0, $limit = 100)
	{
		$subscribers = [];
		foreach ($this->client->get("lists/{$list}/subscribers?offset={$offset}&limit={$limit}&sort=date") as $subscriber) {
			$subscribers[] = new Resources\Subscriber($this, $subscriber);
		}
		return $subscribers;
	}

	/*
	 * Get all fields that are associated with a list.
	 * @param integer $list
	 * @param integer|string $subscriber
	 * @return \Iconneqt\Api\Rest\Resources\Subscriber
	 */
	public function getListSubscriber($list, $subscriber)
	{
		return new Resources\Subscriber($this, $this->client->get("lists/{$list}/subscribers/{$subscriber}"));
	}

	/*
	 * Get the number of subscribers on a list
	 * @param integer $list
	 * @return integer
	 */
	public function getListSubscriberCount($list)
	{
		return $this->client->get("lists/{$list}/subscribers/count");
	}

	/*
	 * Get all fields that are set for a subscriber.
	 * @param integer $subscriber
	 * @param integer $offset
	 * @param integer $limit
	 * @return \Iconneqt\Api\Rest\Resources\SubscriberField[]
	 */
	public function getSubscriberFields($subscriber, $offset = 0, $limit = 100)
	{
		$fields = [];
		foreach ($this->client->get("subscribers/{$subscriber}/fields?offset={$offset}&limit={$limit}") as $subscriber) {
			$fields[] = new Resources\SubscriberField($this, $subscriber);
		}
		return $fields;
	}
	
	/**
	 * Add a new subscriber to a list
	 * @param integer $list
	 * @param array $data
	 * @return boolean
	 */
	public function postListSubscriber($list, $data) {
		return $this->client->post("lists/{$list}/subscribers", $data);
	}
}
