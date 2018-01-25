<?php namespace Model;

require_once('DataBaseAccess.class.php');

/**
 * Staff model class which contains all request to the database for associations staff
 * Each association can have profiles linked to it. These profiles are displayed in the association page.
 *
 * @author Axel Floquet-Trillot
 * @link https://axelfloquet.fr
 */
class Staff
{

    private $DB;

    public function __construct()
    {
        $this->DB = DataBaseAccess::getInstance();
    }

    public function AddStaff(int $IdProfile, int $IdAsso, string $Position = null)
    {
        $NewStaff = $this->DB->prepare('INSERT INTO staff(id_profile, id_asso, position) VALUES (:id_profile, :id_asso, :position)');
        $NewStaff->bindParam(':id_profile', $IdProfile, \PDO::PARAM_INT);
        $NewStaff->bindParam(':id_asso',    $IdAsso,    \PDO::PARAM_INT);
        $NewStaff->bindParam(':position',   $Position,  \PDO::PARAM_STR);
        $NewStaff->execute();
    }

    public function GetAllStaff()
    {
        $AllStaffQuery = $this->DB->prepare('SELECT associations.id_asso,name_asso,profiles.id_profile,first_name,last_name,avatar,position
                                             FROM staff
                                                RIGHT JOIN associations ON staff.id_asso = associations.id_asso
                                                LEFT JOIN profiles ON staff.id_profile = profiles.id_profile
                                             ORDER BY name_asso ASC');
        $AllStaffQuery->execute();
        $AllStaff = $AllStaffQuery->fetchAll(\PDO::FETCH_ASSOC);
        return (count($AllStaff) > 0) ? $AllStaff : null;
    }

    public function GetPossibleAssoStaff(int $IdAsso)
    {
        $AvailableQuery = $this->DB->prepare('SELECT DISTINCT profiles.id_profile,first_name,last_name
                                              FROM profiles
                                                  LEFT JOIN staff ON staff.id_profile = profiles.id_profile
                                              WHERE staff.id_profile IS NULL
                                              OR id_asso != :id_asso');
        $AvailableQuery->bindParam('id_asso', $IdAsso, \PDO::PARAM_INT);
        $AvailableQuery->execute();
        $AvailableStaff = $AvailableQuery->fetchAll(\PDO::FETCH_ASSOC);
        return (count($AvailableStaff) > 0) ? $AvailableStaff : null;
    }

    public function GetAssoStaff(int $IdAsso)
    {
        $GetStaff = $this->DB->prepare('SELECT * FROM staff,profiles WHERE staff.id_profile = profiles.id_profile AND id_asso = :id_asso');
        $GetStaff->bindParam(':id_asso', $IdAsso, \PDO::PARAM_INT);
        $GetStaff->execute();
        $Staff = $GetStaff->fetchAll(\PDO::FETCH_ASSOC);
        return (count($Staff) > 0) ? $Staff : null;
    }

    public function GetProfileStaff(int $IdProfile, int $IdAsso = null)
    {
        $Query = 'SELECT staff.*,first_name,last_name,name_asso
                  FROM staff,associations,profiles
                  WHERE staff.id_asso = associations.id_asso
                  AND staff.id_profile = profiles.id_profile
                  AND staff.id_profile = :id_profile'
                  .((!is_null($IdAsso)) ? ' AND staff.id_asso = :id_asso' : '');
        $GetStaff = $this->DB->prepare($Query);
        $GetStaff->bindParam(':id_profile', $IdProfile, \PDO::PARAM_INT);
        if (!is_null($IdAsso)) $GetStaff->bindParam(':id_asso', $IdAsso, \PDO::PARAM_INT);
        $GetStaff->execute();
        $Staff = $GetStaff->fetchAll(\PDO::FETCH_ASSOC);
        return (count($Staff) > 0) ? $Staff : null;
    }

    public function UpdatePosition(int $IdProfile, int $IdAsso, string $Position)
    {
        $NewPosition = $this->DB->prepare('UPDATE staff SET position = :position WHERE id_profile = :id_profile AND id_asso = :id_asso');
        $NewPosition->bindParam(':id_profile', $IdProfile, \PDO::PARAM_INT);
        $NewPosition->bindParam(':id_asso', $IdAsso, \PDO::PARAM_INT);
        $NewPosition->bindParam(':position', $Position, \PDO::PARAM_STR);
        $NewPosition->execute();
    }

    public function QuitStaff(int $IdAsso, int $IdProfile)
    {
        $Quit = $this->DB->prepare('DELETE FROM staff WHERE id_profile = :id_profile AND id_asso = :id_asso');
        $Quit->bindParam(':id_profile', $IdProfile, \PDO::PARAM_INT);
        $Quit->bindParam(':id_asso', $IdAsso, \PDO::PARAM_INT);
        $Quit->execute();
    }
}
