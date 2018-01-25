<?php namespace Model;

require_once('DataBaseAccess.class.php');

/**
 * Category model class which contains all request to the database for posts categories
 *
 * @author Axel Floquet-Trillot
 * @link https://axelfloquet.fr
 */
class Category
{

    private $DB;

    public function __construct()
    {
        $this->DB = DataBaseAccess::getInstance();
    }

    public function NewCategory(string $NameCat, string $DescriptionCat)
    {
        $NewCat = $this->DB->prepare('INSERT INTO categories(name_cat,description_cat) VALUES (:name_cat, :description_cat)');
        $NewCat->bindParam(':name_cat', $NameCat, \PDO::PARAM_STR);
        $NewCat->bindParam(':description_cat', $DescriptionCat, \PDO::PARAM_STR);
        $NewCat->execute();
    }

    public function GetCategories(int $IdCat = null)
    {
        $Query = 'SELECT * FROM categories' . ((!is_null($IdCat)) ? ' WHERE id_category = :id_cat' : '');
        $GetCat = $this->DB->prepare($Query);
        if (!is_null($IdCat)) $GetCat->bindParam(':id_cat', $IdCat, \PDO::PARAM_INT);
        $GetCat->execute();
        $Categories = $GetCat->fetchAll(\PDO::FETCH_ASSOC);
        return (count($Categories) > 0) ? $Categories : null;
    }

    public function UpdateCategory(int $IdCat, string $NameCat, string $DescriptionCat)
    {
        $UpdateCat = $this->DB->prepare('UPDATE categories SET name_cat = :name_cat, description_cat = :description_cat WHERE id_category = :id_cat');
        $UpdateCat->bindParam(':name_cat', $NameCat, \PDO::PARAM_STR);
        $UpdateCat->bindParam(':description_cat', $DescriptionCat, \PDO::PARAM_STR);
        $UpdateCat->bindParam(':id_cat', $IdCat, \PDO::PARAM_INT);
        $UpdateCat->execute();
    }

    public function DeleteCategory(int $IdCat)
    {
        $DelCat = $this->DB->prepare('DELETE FROM categories WHERE id_category = :id_cat');
        $DelCat->bindParam(':id_cat', $IdCat, \PDO::PARAM_INT);
        $DelCat->execute();
    }
}
