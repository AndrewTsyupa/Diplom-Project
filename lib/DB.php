<?php


class DB
{

    const HOST = 'localhost';
    const USER = 'localhost';

    public static function connection()
    {
        $connection = mysqli_connect("localhost", "root", "", 'diplom');

        if ($connection->connect_error) {
            die("Connection failed: " . $connection->connect_error);
        }

        return $connection;
    }

    public static function query($sql)
    {

        $s = self::queryAll($sql);
        return isset($s[0]) ? $s[0] : [];

    }

    public static function queryAll($sql)
    {

        $conn = self::connection();

        $result = mysqli_query($conn, $sql);
        $resultCheck = mysqli_num_rows($result);

        $res = [];

        if ($resultCheck > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $res[] = $row;
            }
        }


        return $res;
    }


}