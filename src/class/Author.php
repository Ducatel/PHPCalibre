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
	
	public function getId(){
		return $this->id;
	}

	public function setId($id){
		$this->id = $id;
	}

	public function getName(){
		return $this->name;
	}

	public function setName($name){
		$this->name = $name;
	}

	public function getKeywords(){
		return $this->keywords;
	}

	public function setKeywords($keywords){
		$this->keywords = $keywords;
	}

	public function getLink(){
		return $this->link;
	}

	public function setLink($link){
		$this->link = $link;
	}
}


?>