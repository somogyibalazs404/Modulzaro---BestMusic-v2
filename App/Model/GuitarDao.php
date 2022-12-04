<?php
namespace App\Model;

use App\Lib\Database;
use App\Model\ICrudDao;


class GuitarDao implements ICrudDao
{
    public static function all()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $sql = "SELECT g.id, g.gyarto, g.tipus, g.hurok_szama, g.ar, g.raktar_mennyiseg, g.allapot, gk.nev FROM gitarok as g INNER JOIN gitar_kategoriak as gk ON g.kategoria_id = gk.id ORDER BY g.id";
        $statement = $conn->prepare($sql);
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute();
        return $statement->fetchAll();
    }

    public static function save()
    {
        $manufacturer = $_POST['manufacturer'];
        $type = $_POST['type'];
        $categoryId = $_POST['guitarCategory'];
        $numberOfStrings = $_POST['numberOfStrings'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $status = isset($_POST['status']) ? 1 : 0;

        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $sql = "INSERT INTO gitarok(`gyarto`, `tipus`, `kategoria_id`, `hurok_szama`, `ar`, `raktar_mennyiseg`, `allapot`) VALUES (:manufacturer, :type, :categoryId, :numberOfStrings, :price, :qty, :status);";
        $statement = $conn->prepare($sql);
        $statement->execute([
            'manufacturer' => $manufacturer,
            'type' => $type,
            'categoryId' => $categoryId,
            'numberOfStrings' => $numberOfStrings,
            'price' => $price,
            'qty' => $qty,
            'status' => $status,
        ]);

    }

    public static function getById(int $id)
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();
        $statement = $conn->prepare("SELECT g.id, g.gyarto, g.tipus, g.hurok_szama, g.ar, g.raktar_mennyiseg, g.allapot, g.kategoria_id, gk.nev FROM gitarok as g INNER JOIN gitar_kategoriak as gk ON g.kategoria_id = gk.id WHERE g.id=:id;");
        $statement->setFetchMode(\PDO::FETCH_OBJ);
        $statement->execute([
            'id' => $id,
        ]);
        return $statement->fetch();
    }


    public static function update()
    {

        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $id = $_POST['id'];
        $manufacturer = $_POST['manufacturer'];
        $type = $_POST['type'];
        $categoryId = $_POST['guitarCategory'];
        $numberOfStrings = $_POST['numberOfStrings'];
        $price = $_POST['price'];
        $qty = $_POST['qty'];
        $status = isset($_POST['status']) ? 1 : 0;

        $sql = "UPDATE gitarok SET `gyarto`=:manufacturer, `tipus`=:type, `kategoria_id`=:categoryId, `hurok_szama`=:numberOfStrings, `ar`=:price, `raktar_mennyiseg`=:qty, `allapot`=:status WHERE `id`=:id;";
        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                'manufacturer' => $manufacturer,
                'type' => $type,
                'categoryId' => $categoryId,
                'numberOfStrings' => $numberOfStrings,
                'price' => $price,
                'qty' => $qty,
                'status' => $status,
                'id' => $id,
            ]);
        } catch (\PDOException $ex) {
            var_dump($ex);
        }

    }

    public static function delete()
    {
        $dbObj = new Database();
        $conn = $dbObj->getConnection();

        $id = $_POST['id'];

        $sql = "DELETE FROM gitarok WHERE id = :id";
        try {
            $statement = $conn->prepare($sql);
            $statement->execute([
                'id' => $id,
            ]);
        } catch (\PDOException $ex) {
            var_dump($ex);
        }
    }




}
?>