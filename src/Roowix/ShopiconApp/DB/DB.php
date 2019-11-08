<?php


namespace Roowix\ShopiconApp\DB;

use Roowix\ShopiconApp\Model\EntityStorageInterface;

class DB implements EntityStorageInterface
{
    private $dbconn;
    /** @var string */
    private $tableName;

    public function __construct()
    {
        $this->dbconn = pg_connect("host=localhost port=5432 dbname=postgres user=postgres password=iebdkst")
        or die('Не удалось соединиться: ' . pg_last_error());
        $this->tableName = 'images';
    }

    public function takeAll()
    {
        $query  = pg_query($this->dbconn, "SELECT * FROM images");
        $images = array();
        while ($row = pg_fetch_row($query)) {
            // !частная реализация для students
            $students[] = array("image" => $row[0], "id" => $row[2]);
        }
        return $images;
    }

    public function insert(array $fields)
    {
        $newImage = array("image" => $fields["image"]);
        $result = pg_insert($this->dbconn, $this->tableName, $newImage);

        if ($result == false) {
            return false;
        }
        return $newImage;
    }

    public function delete(array $filter)
    {
        $delStr = pg_select($this->dbconn, $this->tableName, $filter);
        $result = pg_delete($this->dbconn, $this->tableName, $delStr[0]);
        if ($result == false) {
            return false;
        }
        return $delStr;
    }

    public function update(array $fields, array $filter)
    {
        $result = pg_update($this->dbconn, $this->tableName, $fields, $filter);
        if ($result == false) {
            return false;
        }
        return $fields;
    }

    public function __destruct()
    {
        pg_close($this->dbconn);
    }
}