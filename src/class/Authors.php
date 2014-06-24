<?php
require_once('Author.php');
require_once('SPDO.php');


/**
 * This class manage all authors from calibre database
 * @author D.Ducatel
 */
class Authors implements Iterator{

	/**
	 * The list of all authors
	 */
	private $listOfAuthors;

	/**
	 * The current index of iterator
	 */
	private $iteratorCurrentPos = 0;

	/**
	 * Default constructor
	 */
	public function __construct() {
		$this->listOfAuthors = array();
		$this->iteratorCurrentPos = 0;
	}

	/**
	 * Load all authors in Calibre sqlite database
	 * @param $calibreDatabasePath Path to the calibre database
	 */
	public function loadFromDatabase($calibreDatabasePath){

		$sqlQuery = 'SELECT * FROM authors';

		$pdo = new SPDO($calibreDatabasePath);
		foreach  ($pdo->query($sqlQuery) as $row) {
			$this->listOfAuthors[] = Author::_createFromRow($row);
		}

	}

	/**
	 * Find author(s) from keyworks
	 * @param  $arrayOfKeywords An array of keyword
	 * @return An array of matched author
	 */
	public function find($arrayOfKeywords){

		$arrayOfKeywords = array_map(function($item){return strtolower(trim($item));} , $arrayOfKeywords);
		$arrayOfMatchedAuthor = array();

		foreach  ($this as $author) {
			foreach ($arrayOfKeywords as $keyword) {
				if (in_array($keyword, $author->getKeywords())){
					$arrayOfMatchedAuthor[] = $author;
					break;
				}

			}
		}

		return $arrayOfMatchedAuthor;
	}


	/*****************************************************************/
	/**                    ITERATOR IMPLEMENTATION                  **/
	/*****************************************************************/

	/**
	 * {@inheritDoc}
	 */
	public function rewind() {
		$this->iteratorCurrentPos = 0;
	}

	/**
	 * {@inheritDoc}
	 */
	public function next() {
		$this->iteratorCurrentPos++;
	}

	/**
	 * {@inheritDoc}
	 */
	public function key() {
		return $this->iteratorCurrentPos;
	}

	/**
	 * {@inheritDoc}
	 */
	public function current() {
		return $this->listOfAuthors[$this->iteratorCurrentPos];
	}

	/**
	 * {@inheritDoc}
	 */
	public function valid() {
		return $this->iteratorCurrentPos < count($this->listOfAuthors);
	}

}
?>