<?php namespace Model;

require_once('DataBaseAccess.class.php');

/**
 * User model class which contains all request to the database for user management
 * A user account is linked to a contact. Contacts may only refer to a person profile (without account).
 *
 * @author Axel Floquet-Trillot
 * @link https://axelfloquet.fr
 */
class UserManagement {

    private $DB;

    public function __construct()
    {
        $this->DB = DataBaseAccess::getInstance();
    }

    /**
     * Creates a new contact (which  can correspond to an account)
     *
     */
    public function NewProfile(string $FirstName, string $LastName, string $Email, string $Avatar = null, int $IdAsso = null, string $Position = null, string $FacebookLink = null, string $TwitterLink = null, string $Phone = null)
    {
        $Profile = $this->DB->prepare('INSERT INTO profiles(first_name, last_name, email, avatar, id_asso, position, facebook_link, twitter_link, phone)
                                 VALUES (:first_name, :last_name, :email, :avatar, :id_asso, :position, :facebook_link, :twitter_link, :phone)');
        $Profile->bindParam(':first_name',      $FirstName,       \PDO::PARAM_STR);
        $Profile->bindParam(':last_name',       $LastName,        \PDO::PARAM_STR);
        $Profile->bindParam(':email',           $Email,           \PDO::PARAM_STR);
        $Profile->bindParam(':avatar',          $Avatar,          \PDO::PARAM_STR);
        $Profile->bindParam(':id_asso',         $IdAsso,          \PDO::PARAM_INT);
        $Profile->bindParam(':position',        $Position,        \PDO::PARAM_STR);
        $Profile->bindParam(':facebook_link',   $FacebookLink,    \PDO::PARAM_STR);
        $Profile->bindParam(':twitter_link',    $TwitterLink,     \PDO::PARAM_STR);
        $Profile->bindParam(':phone',           $Phone,           \PDO::PARAM_STR);
        $Profile->execute();
    }

    /**
     * Returns the id of a contact looking by email address
     *
     * @return int
     */
    private function GetIdOfContact(string $Email)
    {
        $GetProfileId = $this->DB->prepare('SELECT id_profile FROM profiles WHERE email = :email');
        $GetProfileId->bindParam(':email', $Email, \PDO::PARAM_STR);
        $GetProfileId->execute();
        $IDs = $GetProfileId->fetchAll();
        return (count($IDs) > 0) ? $IDs[0]['id_profile'] : null;
    }

    /**
     * Creates a new user account in the database
     *
     */
    public function NewUserAccount(string $Username, string $Password, string $Email)
    {
        $Password = crypt($Password, '$2a$07$302838711915bef2db65cc$');
        $ContactId = $this->GetIdOfContact($Email);
        $SignUp = $this->DB->prepare('INSERT INTO users(username, password, validation_hash, signup_date, last_ip, last_connection, id_profile)
                                VALUES (:username, :password, :validation_hash, NOW(), :last_ip, NOW(), :id_profile)');
        $SignUp->bindParam(':username',        $Username,                     \PDO::PARAM_STR);
        $SignUp->bindParam(':password',        $Password,                     \PDO::PARAM_STR);
        $SignUp->bindParam(':validation_hash', $Password,                     \PDO::PARAM_STR);
        $SignUp->bindParam(':last_ip',         $_SERVER['REMOTE_ADDR'],       \PDO::PARAM_STR);
        $SignUp->bindParam(':id_profile',      $ContactId,                    \PDO::PARAM_INT);
        $SignUp->execute();
    }

    /**
     * Check database for correct credentials. Returns account information.
     *
     * @return Array[mixed]
     */
    public function CheckAccount(string $Username, string $Password)
    {
        $Password = crypt($Password, '$2a$07$302838711915bef2db65cc$');
        $LogIn = $this->DB->prepare('SELECT * FROM users WHERE username = :username AND password = :password');
        $LogIn->bindParam(':username', $Username);
        $LogIn->bindParam(':password', $Password);
        $LogIn->execute();
        $Accounts = $LogIn->fetchAll();
        return (count($Accounts) > 0) ? $Accounts[0] : null;
    }

    /**
     * Check database for correct credentials. Returns account information.
     *
     * @return Array[mixed]
     */
    public function CheckPassword(int $ID, string $Password)
    {
        $Password = crypt($Password, '$2a$07$302838711915bef2db65cc$');
        $LogIn = $this->DB->prepare('SELECT * FROM users WHERE id_user = :id_user AND password = :password');
        $LogIn->bindParam(':id_user', $ID, \PDO::PARAM_INT);
        $LogIn->bindParam(':password', $Password, \PDO::PARAM_STR);
        $LogIn->execute();
        $Accounts = $LogIn->fetchAll();
        return (count($Accounts) > 0) ? true : false;
    }

    /**
     * Tests if username is already present in the database
     *
     * @return bool
     */
    public function IsUsernamePresent()
    {
        $UsernameTest = $this->DB->prepare('SELECT * FROM users WHERE username = :username');
        $UsernameTest->bindParam(':username', $_POST['username']);
        $UsernameTest->execute();
        $Accounts = $UsernameTest->fetchAll();
        return (count($Accounts) > 0) ? false : true;
    }

    /**
     * Tests if mail is already present in the database
     *
     * @return bool
     */
    public function IsMailPresent()
    {
        $MailTest = $this->DB->prepare('SELECT * FROM contacts WHERE email = :email');
        $MailTest->bindParam(':email', $_POST['email']);
        $MailTest->execute();
        $Accounts = $MailTest->fetchAll();
        return (count($Accounts) > 0) ? false : true;
    }

    /**
     * Get one user if ID is given or all users
     *
     * @param int ID
     *
     * @return Array[mixed]
     */
    public function GetUser(int $ID = null) {
        if ($ID !== null) {
            $GetUser = $this->DB->prepare('SELECT * FROM users WHERE id_user = :id_user');
            $IntID = intval($ID);
            $GetUser->bindParam(':id_user', $IntID, \PDO::PARAM_INT);
            $GetUser->execute();
            $User = $GetUser->fetchAll();
            return (count($User) > 0) ? $User[0] : null;
        } else {
            $GetUsers = $this->DB->prepare('SELECT * FROM users');
            $GetUsers->execute();
            $Users = $GetUsers->fetchAll();
            return (count($Users) > 0) ? $Users : null;;
        }
    }

    /**
     *  Gets profile of a giver ID
     *
     *  @param int ID
     *
     *  @return Array[mixed]
     */
    public function GetProfile(int $ID = null)
    {
        if ($ID !== null) {
            $GetProfile = $this->DB->prepare('SELECT * FROM profiles WHERE id_profile = :id_profile');
            $IntID = intval($ID);
            $GetProfile->bindParam(':id_profile', $IntID, \PDO::PARAM_INT);
            $GetProfile->execute();
            $Profile = $GetProfile->fetchAll();
            return (count($Profile) > 0) ? $Profile[0] : null;
        } else {
            $GetProfiles = $this->DB->prepare('SELECT * FROM profiles');
            $GetProfiles->execute();
            $Profiles = $GetProfiles->fetchAll();
            return (count($Profiles) > 0) ? $Profiles : null;;
        }
    }

    /**
     * Deactivates a given user account
     *
     */
    public	function DeactivateAccount(int $ID) {
        $Deactivate = $this->DB->prepare('UPDATE users SET active = 0 WHERE id_user = :id_user');
        $Deactivate->bindParam(':id_user', $ID, \PDO::PARAM_INT);
        $Deactivate->execute();
    }

    /**
     * Updates all the contact info in the database
     *
     */
    public function UpdateProfile(int $ID, string $FirstName, string $LastName, string $Email, string $Avatar = null, int $IDAsso = null, string $Position = null, string $FacebookLink = null, string $TwitterLink = null, string $Phone = null) {
        $UpdateProfile = $this->DB->prepare('UPDATE profiles SET  first_name = :first_name, last_name = :last_name, email = :email, avatar = :avatar, id_asso = :id_asso, position = :position, facebook_link = :facebook_link, twitter_link = :twitter_link, phone = :phone WHERE id_profile = :id_profile');
        $UpdateProfile->bindParam(':first_name',    $FirstName,    \PDO::PARAM_STR);
        $UpdateProfile->bindParam(':last_name',     $LastName,     \PDO::PARAM_STR);
        $UpdateProfile->bindParam(':email',         $Email,        \PDO::PARAM_STR);
        $UpdateProfile->bindParam(':avatar',        $Avatar,       \PDO::PARAM_STR);
        $UpdateProfile->bindParam(':id_asso',       $IDAsso,       \PDO::PARAM_INT);
        $UpdateProfile->bindParam(':position',      $Position,     \PDO::PARAM_STR);
        $UpdateProfile->bindParam(':facebook_link', $FacebookLink, \PDO::PARAM_STR);
        $UpdateProfile->bindParam(':twitter_link',  $TwitterLink,  \PDO::PARAM_STR);
        $UpdateProfile->bindParam(':phone',         $Phone,        \PDO::PARAM_STR);
        $UpdateProfile->bindParam(':id_profile',    $ID,           \PDO::PARAM_INT);
        $UpdateProfile->execute();
    }


    /**
     * Updates the username in the database
     *
     */
    public function UpdateUsername(int $ID, string $Username) {
        $UpdateProfile = $this->DB->prepare('UPDATE users SET username = :username WHERE id_user = :id_user');
        $UpdateProfile->bindParam(':username',  $Username,  \PDO::PARAM_STR);
        $UpdateProfile->bindParam(':id_user',   $ID,        \PDO::PARAM_INT);
        $UpdateProfile->execute();
    }

    /**
     * Updates the password in the database
     *
     */
    public function UpdatePassword(int $ID, string $NewPassword) {
        $NewPassword = crypt($NewPassword, '$2a$07$302838711915bef2db65cc$');
        $UpdatePassword = $this->DB->prepare('UPDATE users SET password = :password WHERE id_user = :id_user');
        $UpdatePassword->bindParam(':password', $NewPassword,   \PDO::PARAM_STR);
        $UpdatePassword->bindParam(':id_user',       $ID,            \PDO::PARAM_INT);
        $UpdatePassword->execute();
    }
}
