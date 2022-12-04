<?php
namespace App\Model;

use App\Lib\Database;
use App\Model\ICrudDao;

class GuitarCategoryDao implements ICrudDao
{
    public static function all()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $sql = "SELECT * FROM gitar_kategoriak";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function save()
    {

    }

    public static function getById(int $id)
    {

    }

    public static function update()
    {

    }

    public static function delete()
    {

    }

}