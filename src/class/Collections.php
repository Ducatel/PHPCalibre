<?php

/**
 * This is a superclass of all Calibre object connexion
 * @author D.Ducatel
 */
abstract class Collections implements Iterator{


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
	 * Find object from keyworks
	 * @param  $arrayOfKeywords An array of keyword
	 * @return An array of matched object
	 */
	public function find($arrayOfKeywords){

		$arrayOfKeywords = array_map(array('Collections', 'stringForComparaison') , $arrayOfKeywords);
		$arrayOfMatchedObject = array();

		foreach  ($this as $object) {
			$name = self::stringForComparaison($object->getName());
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
	 * This method is use for transform a string in a comparable string
	 * @param  $str The string you want to convert
	 * @return The converted string
	 */
	public static function stringForComparaison($str){
		return strtolower(trim($str));
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

}

?>
