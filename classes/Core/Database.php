<?php
/**
 * singleton of a PDO with integrated config
 *
 * Created by PhpStorm.
 * User: jonathan
 * Date: 23/07/17
 * Time: 14:40
 */

namespace Core;


class Database extends \PDO
{
    /**
     * @var Database
     * @access private
     * @static
     */
    private static $_instance;

    /**
     *s
     * @param void
     * @return Database
     */
    public static function getInstance() {

        if(is_null(self::$_instance))
        {
            $driverParams = [\PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC];

            if(ENV_DEV_MODE)
            {
                $driverParams[\PDO::ATTR_ERRMODE] = \PDO::ERRMODE_EXCEPTION;
            }
            self::$_instance = new Database(DB_TYPE.':host='.DB_HOST.';dbname='.DB_NAME.';charset='.DB_CHARSET, DB_USER, DB_PASSWORD, $driverParams);
        }

        return self::$_instance;
    }
}