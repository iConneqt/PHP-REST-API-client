<?php

namespace Iconneqt\Api\Rest;

/**
 * High-level API abstraction
 * 
 * @copyright (c) 2016, Advanced CRMMail Technology B.V., Netherlands
 * @license MIT
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
	 * Get all fields that can be accessed using the credentials used.
	 * @param integer $offset
	 * @param integer $limit
	 * @return \Iconneqt\Api\Rest\Resources\Field[]
	 */
	public function getFields($offset = 0, $limit = 100)
	{
		$fields = [];
		foreach ($this->client->get("fields?offset={$offset}&limit={$limit}") as $field) {
			$fields[] = new Resources\Field($this, $field);
		}
		return $fields;
	}	

	/**
	 * Get the number of fields that can be accessed using the credentials used.
	 * @return integer
	 */
	public function getFieldCount()
	{
		return $this->client->get("fields/count");
	}	
	
	/**
	 * Get a specific field.
	 * @param integer $field
	 * @return \Iconneqt\Api\Rest\Resources\Field|null
	 */
	public function getField($field)
	{
		$result = $this->client->get("fields/{$field}");
		return $result ? new Resources\Field($this, $result) : null;
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
	 * @return \Iconneqt\Api\Rest\MailingList|null
	 */
	public function getList($list)
	{
		$result = $this->client->get("lists/{$list}");
		return $result ? new Resources\MailingList($this, $result) : null;
	}

	/**
	 * Delete a specific list.
	 * @param integer $list
	 * @return boolean
	 */
	public function deleteList($list)
	{
		return !!$this->client->delete("lists/{$list}");
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
	 * Get a specific field for a list.
	 * @param integer $list
	 * @param integer $field
	 * @return \Iconneqt\Api\Rest\Resources\ListField|null
	 */
	public function getListField($list, $field)
	{
		$result = $this->client->get("lists/{$list}/fields/{$field}");
		return $result ? new Resources\ListField($this, $result) : null;
	}	

	/**
	 * Add a key/value pair to a checkbox customfield
	 * @param integer $list
	 * @param integer $field
	 * @param string $key
	 * @param string $value
	 * @return \Iconneqt\Api\Rest\Resources\ListField|null
	 */
	public function patchListField($list, $field, $key, $value)
	{
		return $this->client->patch("lists/{$list}/fields/{$field}", ['fieldkey' => $key, 'fieldvalue' => $value]);
	}

	/**
	 * Delete a specific field from a list.
	 * This will not delete the field, but will break the association between
	 * the field and the list
	 * @param integer $list
	 * @param integer $field
	 * @return boolean
	 */
	public function deleteListField($list, $field)
	{
		return !!$this->client->delete("lists/{$list}/fields/{$field}");
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
	 * @return \Iconneqt\Api\Rest\Resources\Subscriber|null
	 */
	public function getListSubscriber($list, $subscriber)
	{
		$result = $this->client->get("lists/{$list}/subscribers/{$subscriber}");
		return $result ? new Resources\Subscriber($this, $result) : null;
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
	public function postListSubscriber($list, $data)
	{
		return $this->client->post("lists/{$list}/subscribers", $data);
	}

	/**
	 * Create or update a subscriber to a list
	 * @param integer $list
	 * @param array $data
	 * @return boolean
	 */
	public function putListSubscriber($list, $data)
	{
		return $this->client->put("lists/{$list}/subscribers", $data);
	}
	
	/**
	 * Get the statistics from a newsletter
	 * @param integer $newsletterid
	 * @param array $data
	 * @return boolean
	 */
	public function getNewsletterStats($newsletterid, $from = null, $till = null)
	{
		return $this->client->get("newsletters/stats/{$newsletterid}?starttime={$from}&endttime={$till}");
	}
	
	/**
	 * Create a delivery
	 * @param array $data
	 * @return integer delivery id
	 */
	public function putDelivery($data)
	{
		return (int)$this->client->put("deliveries", $data);
	}
	
	/**
	 * Add a recipient to a delivery, automatically adding the recipient as an unconfirmed subscriber. 
	 * @param array $data
	 * @return integer delivery sent id
	 */
	public function postDelivery($delivery, $data)
	{
		return (int)$this->client->post("deliveries/{$delivery}/recipients", $data);
	}

}
