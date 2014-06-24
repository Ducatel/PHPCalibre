<?php


/**
 * Represent a Calibre Serie
 * @author D.Ducatel
 */
class Serie{

	/**
	 * The unique id of this serie
	 */
	private $id;

	/**
	 * The serie's name
	 */
	private $name;

	/**
	 * An array of keywords for find this serie
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
	 * Create an serie from a database row
	 * @param $calibreSerieRow The database entry which represent an serie
	 * @return The object which represente the serie in the database
	 */
	public static function _createFromRow($calibreSerieRow) {
		$serie = new self();
		$serie->id = $calibreSerieRow['id'];
		$serie->name = $calibreSerieRow['name'];
		$arrayKeyword = explode(',' , $calibreSerieRow['sort']);
		$author->keywords = array_map(function($item){return strtolower(trim($item));} , $arrayKeyword);
		return $serie;
	}

    /**
     * Gets the The unique id of this serie.
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Gets the The serie's name.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the An array of keywords for find this serie.
     *
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->keywords;
    }
}


?>