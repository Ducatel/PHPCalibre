<?php
require_once("CalibreDatabaseObject.php");
require_once("utilsFunctions.php");
require_once("SPDO.php");
require_once('Series.php');
require_once('BookFile.php');

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
	 * Link to the cover book
	 */
	private $coverLink;

    /**
     * The comment/summary of this book
     */
    private $comment;

    /**
     * The languaghe of this book
     */
    private $language;

    /**
     * The rating for this book
     */
    private $rating;

    /**
     * The collection of the serie for this book 
     */
    private $series;

    /**
     * Array of file for this book
     */
    private $files;

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
		$this->coverLink = "";
        $this->comment = "";
        $this->language = "";
        $this->rating = 0;
        $this->series = null;
        $this->files = array();
	}

	/**
	 * {@inheritDoc}
	 */
	public static function _createFromRow($databasePath, $calibreObjectRow){
		$book = new self();
        $book->databasePath = realpath($databasePath);
		$book->id = $calibreObjectRow['id'];
		$book->name = $calibreObjectRow['title'];

		$arrayKeyword = explode(',' , $calibreObjectRow['sort']);
		$book->keywords = array_map("stringForComparaison" , $arrayKeyword);

		$book->creationDate = createDateFromSQliteTimestamp( $calibreObjectRow['timestamp'] );
		$book->publicationDate = createDateFromSQliteTimestamp( $calibreObjectRow['pubdate'] );
		$book->lastModified = createDateFromSQliteTimestamp( $calibreObjectRow['last_modified'] );

		$book->isbn = $book->loadISBN();
		$book->lccn = $calibreObjectRow['lccn'];

        $basePath = dirname($book->databasePath);
		$book->path = realpath($basePath.'/'.$calibreObjectRow['path']);

        if($calibreObjectRow['has_cover'] == 1){
            $cover = realpath($book->path.'/cover.jpg');
            $book->coverLink = ( file_exists($cover)) ? $cover : "";
        }

        $book->comment = $book->loadComment();
        $book->language = $book->loadLang();
        $book->rating = $book->loadRating();
        $book->serie = $book->loadSeries();
        $book->files = $book->loadFiles();
		return $book;
	}

    /**
     * Load the files of this book
     * @return An array of files object
     */
    public function loadFiles(){

        $files = array();

        if($this->id == -1 || empty($this->databasePath))
            return $series;


        $sqlQuery = 'SELECT D.* FROM data D , books B WHERE  B.id = D.book AND B.id='.$this->id;

        $pdo = new SPDO($this->databasePath);
        foreach  ($pdo->query($sqlQuery) as $row)
            $files[] = BookFile::_createFromRow($this->databasePath, $row); 
            
        return $files;
    }

    /**
     * Load the series of this book
     * @return The series object
     */
    public function loadSeries(){
        $series = new Series();

        if($this->id == -1 || empty($this->databasePath))
            return $series;

        
        $sqlQuery = 'SELECT S.* FROM books_series_link BSL, series S WHERE BSL.series= S.id and BSL.book='.$this->id;

        $pdo = new SPDO($this->databasePath);
        foreach  ($pdo->query($sqlQuery) as $row)
            $series->add(Serie::_createFromRow($this->databasePath, $row));
            
        return $series;
    }

    /**
     * Load the rating of this book
     * @return The book rating
     */
    public function loadRating(){

        if($this->id == -1 || empty($this->databasePath))
            return "";

        $sqlQuery = 'SELECT R.rating FROM books_ratings_link BRL, ratings R WHERE BRL.rating = R.id and BRL.book='.$this->id;

        $rating = 0;
        $pdo = new SPDO($this->databasePath);
        foreach  ($pdo->query($sqlQuery) as $row)
            $rating = $row['rating'];
            
        return $rating;

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
     * Load the ISBN for the current book
     * @return The ISBN value or an empty string if not found
     */
    public function loadISBN(){
        $sqlQuery = 'SELECT I.val FROM identifiers I , books B WHERE I.type="ISBN" AND B.id = I.book AND B.id='.$this->id;
        $pdo = new SPDO($this->databasePath);
        foreach  ($pdo->query($sqlQuery) as $row)
            return $row['val'];
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
     * Gets the link to the cover book
     *
     * @return mixed
     */
    public function getCover()
    {
        return $this->coverLink;
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

    /**
     * Gets the The rating for this book.
     *
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * Gets the The collection of the serie for this book.
     *
     * @return mixed
     */
    public function getSeries()
    {
        return $this->series;
    }

    /**
     * Gets the Link to the cover book.
     *
     * @return mixed
     */
    public function getCoverLink()
    {
        return $this->coverLink;
    }

    /**
     * Gets the Array of file for this book.
     *
     * @return mixed
     */
    public function getFiles()
    {
        return $this->files;
    }
}

?>