<?php namespace Model;

/**
 * PDO Singleton
 *
 * @author Axel FLOQUET-TRILLOT
 * @link https://axelfloquet.fr
 */
class DataBaseAccess
{
    /**
     * The singleton instance
     *
     */
    private static $PDOInstance;

    /**
     * The full Data Source Name (DSN), for example mysql:host=localhost;dbname=testdb
     *
     */
    const SQL_DSN = "mysql:host=localhost;dbname=bdeynovparis";

    /**
     * The user name for the DSN string. This parameter is optional for some PDO drivers.
     *
     */
    const SQL_USERNAME = "root";

    /**
     * The password for the DSN string. This parameter is optional for some PDO drivers.
     *
     */
    const SQL_PASSWORD = "";

    /**
     * A key=>value array of driver-specific connection options
     *
     */
    const SQL_DRIVER_OPTIONS = null;

    private function __construct()
    {

    }

    /**
     * Instanciates a database connection with PDO and makes sure that only one instance is available (singleton)
     * Returns the unique instance
     *
     * @return DataBaseAccess
     */
    public static function getInstance()
    {
        if(!self::$PDOInstance)
        {
            try
            {
                self::$PDOInstance = new \PDO(self::SQL_DSN, self::SQL_USERNAME, self::SQL_PASSWORD, self::SQL_DRIVER_OPTIONS);
            }

            catch (PDOException $e)
            {
                die("PDO CONNECTION ERROR: " . $e->getMessage() . "<br/>");
            }
        }

        return self::$PDOInstance;
    }

    public function __clone()
    {
        throw new \Exception("Cannot clone a singleton");
    }

    public function __wakeup()
    {
        throw new \Exception("Cannot wake up a singleton");
    }
}

?>
