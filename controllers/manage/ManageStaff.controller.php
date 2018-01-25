<?php namespace Controller;

require_once "controllers/Common.controller.php";
require_once "models/Association.class.php";
require_once "models/Staff.model.php";
require_once "models/User.class.php";

class ManageStaff extends CommonController
{
    private $AssociationsQueries,
            $StaffQueries;
    private $IdProfile,
            $Position;

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

    private function IsStaffFormComplete()
    {
        if ($IsStaffFormComplete = (self::AreFieldsPresent("profile", "position")))
        {
            $this->IdProfile = self::ValidateIntField("profile");
            $this->Position = self::ValidateStringField("position");
var_dump($this->IdProfile);
        }

        return $IsStaffFormComplete;
    }

    private function IsUpdateStaffFormComplete()
    {
        if ($IsStaffFormComplete = (self::IsFieldPresent("position")))
        {
            $this->Position = self::ValidateStringField("position");
        }

        return $IsStaffFormComplete;
    }

    public function AddStaff(int $IdAsso)
    {
        if ($this->IsStaffFormComplete())
        {
            $this->StaffQueries->AddStaff($this->IdProfile, $IdAsso, $this->Position);
            $this->Message = '<div class="alert alert-success alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-check"></i></strong>Le membre a correctement été ajouté</a>
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

    private function IsStaffDataCorrectlyRetrieved()
    {
        return (!is_null($this->Position) && !empty($this->Position));
    }

    public function UpdateStaff(int $IdAsso, int $IdProfile)
    {
        if ($this->IsUpdateStaffFormComplete() && $this->IsStaffDataCorrectlyRetrieved())

        {
            $this->StaffQueries->UpdatePosition($IdProfile, $IdAsso, $this->Position);
            $this->Message = '<div class="alert alert-success alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-check"></i></strong>Le poste a correctement été mis à jour
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

    public function DeleteMember(int $IdAsso, int $IdProfile)
    {
        $this->StaffQueries->QuitStaff($IdAsso, $IdProfile);
        $this->Message = '<div class="alert alert-success alert-light alert-dismissible text-center" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                <i class="zmdi zmdi-close"></i>
                            </button>
                            <strong><i class="zmdi zmdi-check"></i></strong>Le membre a correctement été retiré
                          </div>';
    }

    private function SortStaff(array $QueriedStaff)
    {
        $SortedStaff = array();

        foreach ($QueriedStaff as $Row => $Staff)
        {
            foreach ($Staff as $Name => $Value)
            {
                if ($Name === 'name_asso')
                    $SortedStaff[$Staff['id_asso']][$Name] = $Value;

                else if ($Name !== 'id_asso' && !is_null($Value))
                    $SortedStaff[$Staff['id_asso']][$Row][$Name] = $Value;
            }
        }

        return $SortedStaff;
    }

    public function RequireView(string $CRUD, int $IdAsso = null, int $IdProfile = null, string $Message = null)
    {
        if (is_null($Message))
            $Message = $this->Message;

        $UserManagement = new \Model\UserManagement();
        if (!is_null($IdProfile) && !empty($IdProfile))
            $Profile = $UserManagement->GetProfile($IdProfile);
        else
            $Profiles = $UserManagement->GetProfile(null);

        if (!is_null($IdAsso) && !empty($IdAsso))
            $Asso = $this->AssociationsQueries->GetAssociation($IdAsso);

        switch ($CRUD)
        {
            case "List":
                if (!is_null($IdAsso) && (!isset($Asso) || is_null($Asso)))
                    throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                <i class="zmdi zmdi-close"></i>
                                            </button>
                                            <strong><i class="zmdi zmdi-close-circle"></i></strong>Mauvais paramètre : cette association n\'existe pas
                                          </div>');
                $AllStaff = $this->StaffQueries->GetAllStaff();
                if (!is_null($AllStaff)) $AllStaff = $this->SortStaff($AllStaff);
                return require_once('views/manage/staff/ManageStaff.view.php');
                break;

            case "Add":
                if (!isset($Asso) || is_null($Asso))
                    throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                <i class="zmdi zmdi-close"></i>
                                            </button>
                                            <strong><i class="zmdi zmdi-close-circle"></i></strong>Mauvais paramètre : cette association n\'existe pas
                                          </div>');
                $PossibleStaff = $this->StaffQueries->GetPossibleAssoStaff($IdAsso);
                return require_once('views/manage/staff/AddStaff.view.php');
                break;

            case "Edit":
                if (!isset($Asso) || is_null($Asso))
                    throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                <i class="zmdi zmdi-close"></i>
                                            </button>
                                            <strong><i class="zmdi zmdi-close-circle"></i></strong>Mauvais paramètre : cette association n\'existe pas
                                          </div>');
                $Staff = $this->StaffQueries->GetProfileStaff($IdProfile, $IdAsso);
                if (is_null($Staff))
                    throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                <i class="zmdi zmdi-close"></i>
                                            </button>
                                            <strong><i class="zmdi zmdi-close-circle"></i></strong>Mauvais paramètre : ce profil n\'existe pas
                                          </div>');
                return require_once('views/manage/staff/EditStaff.view.php');
                break;

            case "Delete":
                if (!isset($Asso) || is_null($Asso))
                    throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                <i class="zmdi zmdi-close"></i>
                                            </button>
                                            <strong><i class="zmdi zmdi-close-circle"></i></strong>Mauvais paramètre : cette association n\'existe pas
                                          </div>');
                $Staff = $this->StaffQueries->GetProfileStaff($IdProfile, $IdAsso);
                if (is_null($Staff))
                    throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                <i class="zmdi zmdi-close"></i>
                                            </button>
                                            <strong><i class="zmdi zmdi-close-circle"></i></strong>Mauvais paramètre : ce profil n\'existe pas
                                          </div>');
                return require_once('views/manage/staff/DeleteStaff.view.php');
                break;
        }
    }
}

?>
