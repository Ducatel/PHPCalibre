<?php

/**
 * Represent a Calibre author
 * @author D.Ducatel
 */
class Author{
	
	/**
	 * The unique id of this author
	 */
	private $id;
	
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
		$this->id = -1;
		$this->name = null;
		$this->keywords = array();
		$this->link = null;
	}

	/**
	 * Create an author from a database row
	 * @param $calibreAuthorRow The database entry which represent an author
	 * @return The object which represente the author in the database
	 */
	public static function _createFromRow($calibreAuthorRow) {
		$author = new self();
		$author->id = $calibreAuthorRow['id'];
		$author->name = $calibreAuthorRow['name'];

		$arrayKeyword = explode(',' , $calibreAuthorRow['sort']);
		$author->keywords = array_map(function($item){return strtolower(trim($item));} , $arrayKeyword);
		$author->link = $calibreAuthorRow['link'];
		return $author;
	}
	
	/**
	 * Get the identifier of this author
	 * @return The identifier of this author 
	 */
	public function getId(){
		return $this->id;
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