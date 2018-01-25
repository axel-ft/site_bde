<?php namespace Controller;

require_once "controllers/Common.controller.php";
require_once "models/Category.model.php";

class ManageCategories extends CommonController
{
    private $CatQueries;
    private $NameCat,
            $DescriptionCat;

    public function __construct()
    {
        if (self::IsManager())
           throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                        <i class="zmdi zmdi-close"></i>
                                    </button>
                                    <strong><i class="zmdi zmdi-close-circle"></i></strong>Vous n\'avez pas les droits suffisants pour accéder à cette page
                                 </div>');

        $this->CatQueries = new \Model\Category();
    }

    private function IsCategoryFormComplete()
    {
        if ($IsCategoryFormComplete = (self::AreFieldsPresent("name_cat", "description_cat")))
        {
            $this->NameCat = self::ValidateStringField("name_cat");
            $this->DescriptionCat = self::ValidateStringField("description_cat");
        }

        return $IsCategoryFormComplete;
    }

    public function AddCategory()
    {
        if ($this->IsCategoryFormComplete())
        {
            $this->CatQueries->NewCategory($this->NameCat, $this->DescriptionCat);
            $this->Message = '<div class="alert alert-success alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-check"></i></strong>La catégorie a correctement été ajoutée
                              </div>';
        }

        else
            $this->Message = '<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-close-circle"></i></strong>Il manque un/des champ(s) obligatoire(s)
                              </div>';
    }

    public function UpdateCategory(int $ID)
    {
        if ($this->IsCategoryFormComplete() && (!is_null($this->NameCat) && !empty($this->NameCat)))
        {
            $this->CatQueries->UpdateCategory($ID, $this->NameCat, $this->DescriptionCat);
            $this->Message = '<div class="alert alert-success alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-check"></i></strong>La catégorie a correctement été mise à jour
                              </div>';
        }

        else
            $this->Message = '<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-close-circle"></i></strong>Il manque un/des champ(s) obligatoire(s)
                              </div>';
    }

    public function DeleteCategory(int $ID)
    {
        $this->CatQueries->DeleteCategory($ID);
        $this->Message = '<div class="alert alert-success alert-light alert-dismissible text-center" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                <i class="zmdi zmdi-close"></i>
                            </button>
                            <strong><i class="zmdi zmdi-check"></i></strong>La catégorie a correctement été supprimée
                          </div>';
    }

    public function RequireView(string $CRUD, int $IdCat = null, string $Message = null)
    {
        if (is_null($Message))
            $Message = $this->Message;

        switch ($CRUD)
        {
            case "List":
                $Categories = $this->CatQueries->GetCategories();
                return require_once('views/manage/categories/ManageCategories.view.php');
                break;

            case "Add":
                return require_once('views/manage/categories/AddCategory.view.php');
                break;

            case "Edit":
                if (!is_null($IdCat)) $Category = $this->CatQueries->GetCategories($IdCat);
                if (!isset($Category) || is_null($Category))
                    throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                <i class="zmdi zmdi-close"></i>
                                            </button>
                                            <strong><i class="zmdi zmdi-close-circle"></i></strong>Mauvais paramètre : cette catégorie n\'existe pas
                                          </div>');
                return require_once('views/manage/categories/EditCategory.view.php');
                break;

            case "Delete":
                if (!is_null($IdCat)) $Category = $this->CatQueries->GetCategories($IdCat);
                if (!isset($Category) || is_null($Category))
                    throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                <i class="zmdi zmdi-close"></i>
                                            </button>
                                            <strong><i class="zmdi zmdi-close-circle"></i></strong>Mauvais paramètre : cette catégorie n\'existe pas
                                          </div>');
                return require_once('views/manage/categories/DeleteCategory.view.php');
                break;
        }
    }
}

?>
