<?php
// Base::Chive.class.php
class Chive
{
    // General Info
    /**
     * Name of the class
     *
     * @var String $name
     */
    var $name = null;

    /**
     * Database table prefix
     *
     * @var String $db_prefix
     */
    var $db_prefix = null;

    /**
     * Database server location
     *
     * @var String $db_server
     */
    var $db_server = null;

    /**
     * Database name
     *
     * @var String $db_name
     */
    var $db_name = null;

    /**
     * Database username
     *
     * @var String $db_username
     */
    var $db_username = null;

    /**
     * Database password
     *
     * @var String $db_password
     */
    var $db_password = null;

    /**
     * MySQLi Resource link for database connections
     *
     * @var mysqli $db_link
     */
    var $db_link = null;
    var $queryCount = 0;

    /**
     * Constructor for Chive
     * @param String $name Name of the class
     */
    function __construct($name = "")
    {
        global $conf;
        $this->name = $name;
        $this->db_server = $conf['db_server'];
        $this->db_name = $conf['db_name'];
        $this->db_username = $conf['db_username'];
        $this->db_password = $conf['db_password'];
        $this->db_prefix = $conf['db_prefix'];

        Debug::printMsg(__CLASS__, __FUNCTION__, "Class created with <b>\$name</b> " . $this->name);
    }

    /**
     * Creates a MySQLi Resource link to $db_link
     */
    function connectToDB()
    {
        Debug::printMsg(__CLASS__, __FUNCTION__, "Connecting to DB...");
        $this->db_link = new mysqli($this->db_server, $this->db_username, $this->db_password, $this->db_name);

        if ($this->db_link->connect_error) {
            Debug::printMsg(__CLASS__, __FUNCTION__, "Couldn't connect to DB: " . $this->db_link->connect_error);
        } else {
            Debug::printMsg(__CLASS__, __FUNCTION__, "Connected to database");
        }
    }

    /**
     * Checks if a connection to the database server has been made
     *
     * @return bool
     */
    function connected()
    {
        return $this->db_link instanceof mysqli;
    }

    /**
     * Cleans $string for a MySQL statement
     *
     * @param String $string
     * @return String
     */
    function clean_sql($string, $quotes = 1)
    {
        if (!$this->connected()) $this->connectToDB();

        // Quote if not integer
        if (!is_numeric($string) && $quotes) {
            $string = "'" . $this->db_link->real_escape_string($string) . "'";
        }
        return $string;
    }

    /**
     * Queries Database.
     * Returns true or false depending on success
     *
     * @param String $query
     * @return mysqli_result|false
     */
    function query($query)
    {
        if (!$this->connected()) $this->connectToDB();

        $result = $this->db_link->query($query);
        if ($result) {
            Debug::printMsg(__CLASS__, __FUNCTION__, "Query successful: " . $query . "\r\n");
            $this->queryCount++;
            return $result;
        }
        Debug::printMsg(__CLASS__, __FUNCTION__, "Query unsuccessful - <b>ERROR:</b> " . $this->db_link->error . " FROM QUERY - \"" . $query . "\"\n");
        $this->queryCount++;
        return false;
    }
}

class page_gen {
    //
    // PRIVATE CLASS VARIABLES
    //
    var $_start_time;
    var $_stop_time;
    var $_gen_time;

    //
    // USER DEFINED VARIABLES
    //
    var $round_to;

    //
    // CLASS CONSTRUCTOR
    //
    function __construct() {
        if (!isset($this->round_to)) {
            $this->round_to = 4;
        }
    }

    //
    // FIGURE OUT THE TIME AT THE BEGINNING OF THE PAGE
    //
    function start() {
        $microstart = explode(' ', microtime());
        $this->_start_time = $microstart[0] + $microstart[1];
    }

    //
    // FIGURE OUT THE TIME AT THE END OF THE PAGE
    //
    function stop() {
        $microstop = explode(' ', microtime());
        $this->_stop_time = $microstop[0] + $microstop[1];
    }

    //
    // CALCULATE THE DIFFERENCE BETWEEN THE BEGINNING AND THE END AND RETURN THE VALUE
    //
    function gen() {
        $this->_gen_time = round($this->_stop_time - $this->_start_time, $this->round_to);
        return $this->_gen_time;
    }
}
?>
