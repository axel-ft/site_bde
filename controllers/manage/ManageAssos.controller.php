<?php namespace Controller;

require_once "controllers/Common.controller.php";
require_once "models/Association.class.php";
require_once "models/Staff.model.php";
require_once "models/User.class.php";

class ManageAssos extends CommonController
{
    private $AssociationsQueries,
            $StaffQueries;
    private $NameAsso,
            $Acronym,
            $AssoDescription,
            $Logo,
            $Email,
            $Phone,
            $FacebookLink,
            $TwitterLink;

    public function __construct()
    {
        if (self::IsManager())
           throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                        <i class="zmdi zmdi-close"></i>
                                    </button>
                                    <strong><i class="zmdi zmdi-close-circle"></i></strong>Vous n\'avez pas les droits suffisants pour accéder à cette page
                                 </div>');

        $this->AssociationsQueries = new \Model\Association();
        $this->StaffQueries = new \Model\Staff();
    }

    private function IsAssoFormComplete()
    {
        if ($IsAssoFormComplete = (self::AreFieldsPresent("name_asso", "description_asso") && self::IsFilePresent("logo")))
        {
            $this->NameAsso = self::ValidateStringField("name_asso");
            $this->Acronym = self::ValidateStringField("acronym");
            $this->AssoDescription = self::ValidateStringField("description_asso");
            $this->Logo = self::ValidateUploadedImage("logo", "logos");
            $this->Email = self::ValidateStringField("email");
            $this->Phone = self::ValidateStringField("phone");
            $this->FacebookLink = self::ValidateStringField("facebook_link");
            $this->TwitterLink = self::ValidateStringField("twitter_link");
        }

        return $IsAssoFormComplete;
    }

    public function AddAsso()
    {
        if ($this->IsAssoFormComplete())
        {
            $InsertedId = $this->AssociationsQueries->NewAssociation($this->NameAsso,
                                                                     $this->Acronym,
                                                                     $this->AssoDescription,
                                                                     $this->Logo,
                                                                     $this->Email,
                                                                     $this->Phone,
                                                                     $this->FacebookLink,
                                                                     $this->TwitterLink);
            $this->Message = '<div class="alert alert-success alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-check"></i></strong>L\'association a correctement été ajoutée. <a href="/manage/staff/' . htmlentities($InsertedId) . '" class="btn btn-sm btn-raised btn-success">Ajouter des membres</a>
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

    private function IsAssoDataCorrectlyRetrieved()
    {
        return ((!is_null($this->NameAsso) && !empty($this->NameAsso))
                && (!is_null($this->AssoDescription) && !empty($this->AssoDescription))
                && (!is_null($this->Logo) && !empty($this->Logo)));
    }

    public function UpdateAsso(int $ID)
    {
        if ($this->IsAssoFormComplete() && $this->IsAssoDataCorrectlyRetrieved())

        {
            $this->AssociationsQueries->UpdateAssociation($ID,
                                                          $this->NameAsso,
                                                          $this->Acronym,
                                                          $this->AssoDescription,
                                                          $this->Logo,
                                                          $this->Email,
                                                          $this->Phone,
                                                          $this->FacebookLink,
                                                          $this->TwitterLink);
            $this->Message = '<div class="alert alert-success alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-check"></i></strong>L\'association a correctement été mise à jour
                              </div>';
        }

        else
        {
            $this->Message = '<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-close-circle"></i></strong>Il manque un/des champ(s) obligatoire(s)
                              </div>';
        }
    }

    public function DeleteAsso(int $ID)
    {
        $this->AssociationsQueries->DeleteAssociation($ID);
        $this->Message = '<div class="alert alert-success alert-light alert-dismissible text-center" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                <i class="zmdi zmdi-close"></i>
                            </button>
                            <strong><i class="zmdi zmdi-check"></i></strong>L\'association a correctement été supprimée
                          </div>';
    }

    public function RequireView(string $CRUD, string $Message = null, $IdAsso = null)
    {
        if (is_null($Message))
            $Message = $this->Message;

        $UserManagement = new \Model\UserManagement();
        $Profiles = $UserManagement->GetProfile(null);

        if (!is_null($IdAsso) && !empty($IdAsso))
            $Asso = $this->AssociationsQueries->GetAssociation($IdAsso);

        switch ($CRUD)
        {
            case "List":
                $Associations = $this->AssociationsQueries->GetAssociation();
                return require_once('views/manage/assos/ManageAssos.view.php');
                break;

            case "Add":
                return require_once('views/manage/assos/AddAsso.view.php');
                break;

            case "Edit":
                if (!isset($Asso) || is_null($Asso))
                    throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                <i class="zmdi zmdi-close"></i>
                                            </button>
                                            <strong><i class="zmdi zmdi-close-circle"></i></strong>Mauvais paramètre : cette association n\'existe pas
                                          </div>');
                return require_once('views/manage/assos/EditAsso.view.php');
                break;

            case "Delete":
                if (!isset($Asso) || is_null($Asso))
                    throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                <i class="zmdi zmdi-close"></i>
                                            </button>
                                            <strong><i class="zmdi zmdi-close-circle"></i></strong>Mauvais paramètre : cette association n\'existe pas
                                          </div>');
                return require_once('views/manage/assos/DeleteAsso.view.php');
                break;
        }
    }
}

?>
