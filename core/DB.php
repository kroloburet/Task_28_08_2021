<?php

namespace Core;

final class DB
{
    private static ?\PDO $db;

    private static ?DB $instance = null;

    private function __construct()
    {
    }

    private function __clone()
    {
    }

    private function __wakeup()
    {
    }

    /**
     * Single connect to DB
     *
     * @return DB
     * @throws \Exception
     */
    public static function connect(): DB
    {
        if (is_null(self::$instance)) {

            $conf = APP_PATH . '/Config/database.php';
            if (!file_exists($conf)) {
                die("Error! Not found database config file '$conf'.");
            }

            $conf = require $conf;

            try {
                self::$db = new \PDO(
                    'mysql:host=' . $conf['host'] . ';dbname=' . $conf['dbname'] . ';charset=' . $conf['dbcharset'],
                    $conf['user'],
                    $conf['password'],
                    [
                        \PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION,
                        \PDO::ATTR_DEFAULT_FETCH_MODE => \PDO::FETCH_ASSOC,
//                        \PDO::ATTR_EMULATE_PREPARES => false
                    ]
                );

                self::$instance = new DB();

            } catch (\PDOException $e) {
                throw new \Exception ($e->getMessage());
            }
        }
        return self::$instance;
    }


    /**
     * @param $stmt
     * @return \PDOStatement
     */
    public static function query($stmt): \PDOStatement
    {
        return self::$db->query($stmt);
    }

    /**
     * @param $stmt
     * @return \PDOStatement
     */
    public static function prepare($stmt): \PDOStatement
    {
        return self::$db->prepare($stmt);
    }

    /**
     * @param $query
     * @return int
     */
    static public function exec($query): int
    {
        return self::$db->exec($query);
    }

    /**
     * @return string
     */
    static public function lastInsertId(): string
    {
        return self::$db->lastInsertId();
    }

    /**
     * @param $query
     * @param array $args
     * @return \PDOStatement
     * @throws \Exception
     */
    public static function run($query, array $args = []): \PDOStatement
    {
        try {
            if (!$args) {
                return self::query($query);
            }
            $stmt = self::prepare($query);
            $stmt->execute($args);
            return $stmt;
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    /**
     * @param $query
     * @param array $args
     * @return mixed
     * @throws \Exception
     */
    public static function getRow($query, array $args = [])
    {
        return self::run($query, $args)->fetch();
    }

    /**
     * @param $query
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public static function getRows($query, array $args = []): array
    {
        return self::run($query, $args)->fetchAll();
    }

    /**
     * @param $query
     * @param array $args
     * @return mixed
     * @throws \Exception
     */
    public static function getValue($query, array $args = [])
    {
        $result = self::getRow($query, $args);
        if (!empty($result)) {
            $result = array_shift($result);
        }
        return $result;
    }

    /**
     * @param $query
     * @param array $args
     * @return array
     * @throws \Exception
     */
    public static function getColumn($query, array $args = []): array
    {
        return self::run($query, $args)->fetchAll(\PDO::FETCH_COLUMN);
    }

    /**
     * @throws \Exception
     */
    public static function sql($query, $args = [])
    {
        self::run($query, $args);
    }
}
