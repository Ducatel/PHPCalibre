<?php
require_once("CalibreDatabaseObject.php");

/**
 * Represent a book file
 * @author D.Ducatel
 */
class BookFile extends CalibreDatabaseObject{

	/**
	 * The id of book associated to this file
	 */
	private $bookId;

	/**
	 * Format of this file (PDF, EPUB,etc...)
	 */
	private $format;

	/**
	 * The size of this file
	 */
	private $size;

	/**
	 * The filename
	 */
	private $name;

	/**
	 * Default constructor
	 */
	public function __construct() {
		parent::__construct();
		$this->bookId = -1;
		$this->size = -1;
		$this->format = "";
		$this->name = "";
	}

	/**
	 * {@inheritDoc}
	 */
	public static function  _createFromRow($databasePath, $calibreObjectRow) {
		$bookFile = new self();
		$bookFile->id = $calibreObjectRow['id'];
		$bookFile->name = $calibreObjectRow['name'];
		$bookFile->format = $calibreObjectRow['format'];
		$bookFile->size = $calibreObjectRow['uncompressed_size'];
		$bookFile->databasePath = $databasePath;
		return $bookFile;
	}

    /**
     * Gets the the filename.
     *
     * @return mixed
     */
    public function getName(){
        return $this->name;
    }

    /**
     * Gets the An array of keywords for find this book file.
     *
     * @return mixed
     */
    public function getKeywords(){
        return array(stringForComparaison($this->name));
    }

    /**
     * Gets the The id of book associated to this file.
     *
     * @return mixed
     */
    public function getBookId()
    {
        return $this->bookId;
    }

    /**
     * Gets the Format of this file (PDF, EPUB,etc...).
     *
     * @return mixed
     */
    public function getFormat()
    {
        return $this->format;
    }

    /**
     * Gets the The size of this file.
     *
     * @return [type]
     */
    public function getSize()
    {
        return $this->size;
    }
}


?>