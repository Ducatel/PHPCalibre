<?php
require_once("CalibreDatabaseObject.php");
require_once("utilsFunctions.php");

/**
 * Represent a Calibre Book
 * @author D.Ducatel
 */
class Book extends CalibreDatabaseObject{
		
	/**
	 * The Book's title
	 */
	private $name;
	
	/**
	 * An array of keywords for find this book
	 */
	private $keywords;

	/**
	 * Creation date of this book in calibre database 
	 */
	private $creationDate;

	/**
	 * Publication date of this book
	 */
	private $publicationDate;

	/**
	 * Last update date of this book in calibre database 
	 */
	private $lastModified;

	/**
	 * ISBN of this book
	 * International Standard Book Number
	 */
	private $isbn;

	/**
	 * LCCN of this book
	 * Library of Congress Control Number
	 */
	private $lccn;

	/**
	 * Path to the book folder
	 */
	private $path;

	/**
	 * True if this book have a cover
	 */
	private $hasCover;


	/**
	 * Default constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->name = null;
		$this->keywords = array();
		$this->creationDate = new DateTime();
		$this->publicationDate = new DateTime();
		$this->lastModified = new DateTime();
		$this->isbn = null;
		$this->lccn = null;
		$this->path = null;
		$this->hasCover = false;
	}

	/**
	 * {@inheritDoc}
	 */
	public static function _createFromRow($calibreAuthorRow) {
		$book = new self();
		$book->id = $calibreAuthorRow['id'];
		$book->name = $calibreAuthorRow['title'];

		$arrayKeyword = explode(',' , $calibreAuthorRow['sort']);
		$book->keywords = array_map("stringForComparaison" , $arrayKeyword);

		//TODO finish this method

		return $book;
	}


	// TODO add all getter and setter
}

?>