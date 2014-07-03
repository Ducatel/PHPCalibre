<?php
require_once("utilsFunctions.php");


/**
 * This is a superclass of all Calibre object connexion
 * @author D.Ducatel
 */
abstract class Collections implements Iterator, Countable {


	/**
	 * The list of all object
	 */
	protected $listOfObjects;

	/**
	 * The current index of iterator
	 */
	private $iteratorCurrentPos = 0;

	/**
	 * Default constructor
	 */
	public function __construct() {
		$this->listOfObjects = array();
		$this->iteratorCurrentPos = 0;
	}

	/**
	 * Add an object in this collection
	 * @param $obj The object you want to add in this collection
	 */
	public function add($obj){
		$this->listOfObjects[] = $obj;
	}
	
	/**
	 * Find object from keyworks
	 * @param  $arrayOfKeywords An array of keyword
	 * @return An array of matched object
	 */
	public function find($arrayOfKeywords){

		$arrayOfKeywords = array_map("stringForComparaison" , $arrayOfKeywords);
		$arrayOfMatchedObject = array();

		foreach  ($this as $object) {
			$name = stringForComparaison($object->getName());
			foreach ($arrayOfKeywords as $keyword) {
				if (in_array($keyword, $object->getKeywords()) || $name == $keyword){
					$arrayOfMatchedObject[] = $object;
					break;
				}
				
			}
		}

		return $arrayOfMatchedObject;
	}


	/**
	 * Load all object in Calibre sqlite database
	 * @param $calibreDatabasePath Path to the calibre database
	 */
	abstract public function loadFromDatabase($calibreDatabasePath);

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
		return $this->listOfObjects[$this->iteratorCurrentPos];
	}

	/**
	 * {@inheritDoc}
	 */
	public function valid() {
		return $this->iteratorCurrentPos < count($this->listOfObjects);
	}

	/*****************************************************************/
	/**                   COUNTABLE IMPLEMENTATION                  **/
	/*****************************************************************/

	public function count() {
        return count($this->listOfObjects);
    }

}

?>
