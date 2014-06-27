<?php
require_once("CalibreDatabaseObject.php");
require_once("utilsFunctions.php");
require_once("SPDO.php");

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
     * The comment/summary of this book
     */
    private $comment;

    /**
     * The languaghe of this book
     */
    private $language;

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
        $this->comment = "";
        $this->language = "";
	}

	/**
	 * {@inheritDoc}
	 */
	public static function _createFromRow($databasePath, $calibreObjectRow){
		$book = new self();
        $book->databasePath = $databasePath;
		$book->id = $calibreObjectRow['id'];
		$book->name = $calibreObjectRow['title'];

		$arrayKeyword = explode(',' , $calibreObjectRow['sort']);
		$book->keywords = array_map("stringForComparaison" , $arrayKeyword);

		$book->creationDate = createDateFromSQliteTimestamp( $calibreObjectRow['timestamp'] );
		$book->publicationDate = createDateFromSQliteTimestamp( $calibreObjectRow['pubdate'] );
		$book->lastModified = createDateFromSQliteTimestamp( $calibreObjectRow['last_modified'] );
		$book->isbn = $calibreObjectRow['isbn'];
		$book->lccn = $calibreObjectRow['lccn'];
		$book->path = $calibreObjectRow['path'];
		$book->hasCover = ($calibreObjectRow['has_cover'] == 1);
        $book->comment = $book->loadComment();
        $book->language = $book->loadLang();

		return $book;
	}

    /**
     * Load the comment of this book
     * @return The comment or an empty string if not found
     */
    public function loadComment(){

        if($this->id == -1 || empty($this->databasePath))
            return "";

        $sqlQuery = 'SELECT text FROM comments WHERE book='.$this->id;

        $comment = "";
        $pdo = new SPDO($this->databasePath);
        foreach  ($pdo->query($sqlQuery) as $row)
            $comment .= $row['text'];
            
        return $comment;
    }

    /**
     * Load the language of this book
     * @return The language or an empty string if not found
     */
    public function loadLang(){

        if($this->id == -1 || empty($this->databasePath))
            return "";

        $sqlQuery = 'SELECT L.lang_code as lang FROM books_languages_link BLL, languages L WHERE BLL.lang_code = L.id AND BLL.book = '.$this->id;

        $pdo = new SPDO($this->databasePath);
        foreach  ($pdo->query($sqlQuery) as $row)
          return $row['lang'];
            
        return "";
    }

    /**
     * Gets the The Book's title.
     *
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Gets the An array of keywords for find this book.
     *
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * Gets the Creation date of this book in calibre database.
     *
     * @return mixed
     */
    public function getCreationDate()
    {
        return $this->creationDate;
    }

    /**
     * Gets the Publication date of this book.
     *
     * @return mixed
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }

    /**
     * Gets the Last update date of this book in calibre database.
     *
     * @return mixed
     */
    public function getLastModified()
    {
        return $this->lastModified;
    }

    /**
     * Gets the ISBN of this book
     * International Standard Book Number.
     *
     * @return mixed
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * Gets the LCCN of this book
     * Library of Congress Control Number.
     *
     * @return mixed
     */
    public function getLccn()
    {
        return $this->lccn;
    }

    /**
     * Gets the Path to the book folder.
     *
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Gets the True if this book have a cover.
     *
     * @return mixed
     */
    public function hasCover()
    {
        return $this->hasCover;
    }

    /**
     * Gets the The comment/summary of this book.
     *
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Gets the The languaghe of this book.
     *
     * @return mixed
     */
    public function getLanguage()
    {
        return $this->language;
    }
}

?>