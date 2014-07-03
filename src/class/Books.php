<?php
require_once('Collections.php');
require_once('Book.php');
require_once('SPDO.php');


/**
 * This class manage all books from calibre database
 * @author D.Ducatel
 */
class Books extends Collections{

	/**
	 * {@inheritDoc}
	 */
	public function loadFromDatabase($calibreDatabasePath){

		$sqlQuery = 'SELECT * FROM books ORDER BY title';

		$pdo = new SPDO($calibreDatabasePath);
		foreach  ($pdo->query($sqlQuery) as $row)
			$this->listOfObjects[] = Book::_createFromRow($calibreDatabasePath, $row);	

	}

	/**
	 * Find books by language
	 * @param  $lang The lang you want to search
	 * @return An array with boos in $lang
	 */
	public function findByLanguage($lang){
		$arrayOfBook = array();
		$lang = stringForComparaison($lang);
		foreach ($this as $book) 
			if(stringForComparaison($book->getLanguage()) == $lang)
				$arrayOfBook[] = $book;
		
		return $arrayOfBook;
	}

}
?>
