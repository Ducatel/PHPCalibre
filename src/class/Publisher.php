<?php


/**
 * Represent a Calibre Publisher
 * @author D.Ducatel
 */
class Publisher{

	/**
	 * The unique id of this publisher
	 */
	private $id;

	/**
	 * The publisher's name
	 */
	private $name;

	/**
	 * An array of keywords for find this publisher
	 */
	private $keywords;

	/**
	 * Default constructor
	 */
	public function __construct() {
		$this->id = -1;
		$this->name = null;
		$this->keywords = array();
	}

	/**
	 * Create an publisher from a database row
	 * @param $calibrePublisherRow The database entry which represent an publisher
	 * @return The object which represente the publisher in the database
	 */
	public static function _createFromRow($calibrePublisherRow) {
		$publisher = new self();
		$publisher->id = $calibrePublisherRow['id'];
		$publisher->name = $calibrePublisherRow['name'];
		$arrayKeyword = explode(',' , $calibrePublisherRow['sort']);
		$author->keywords = array_map(function($item){return strtolower(trim($item));} , $arrayKeyword);
		return $publisher;
	}


    /**
     * Gets the The unique id of this publisher.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the The publisher's name.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the An array of keywords for find this publisher.
     *
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->keywords;
    }
}


?>