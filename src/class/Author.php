<?php
require_once("CalibreDatabaseObject.php");

/**
 * Represent a Calibre author
 * @author D.Ducatel
 */
class Author extends CalibreDatabaseObject{
		
	/**
	 * The author's name
	 */
	private $name;
	
	/**
	 * An array of keywords for find this author
	 */
	private $keywords;

	/**
	 * A link for this author
	 */
	private $link;

	/**
	 * Default constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->name = null;
		$this->keywords = array();
		$this->link = null;
	}

	/**
	 * {@inheritDoc}
	 */
	public static function _createFromRow($databasePath, $calibreObjectRow) {
		$author = new self();
		$author->databasePath = $databasePath;
		$author->id = $calibreObjectRow['id'];
		$author->name = $calibreObjectRow['name'];
		$arrayKeyword = explode(',' , $calibreObjectRow['sort']);
		$author->keywords = array_map("stringForComparaison" , $arrayKeyword);
		$author->link = $calibreObjectRow['link'];
		return $author;
	}
	
	/**
	 * Get the name of this author
	 * @return The name of this author
	 */
	public function getName(){
		return $this->name;
	}

	/**
	 * An array of keyword for finding this author
	 * @return An array of keywords
	 */
	public function getKeywords(){
		return $this->keywords;
	}

	/**
	 * Get a link for this auhtor
	 * @return A link
	 */
	public function getLink(){
		return $this->link;
	}

}


?>