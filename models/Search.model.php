<?php namespace Model;

require_once('DataBaseAccess.class.php');

/**
 * Category model class which contains all request to the database for posts categories
 *
 * @author Axel Floquet-Trillot
 * @link https://axelfloquet.fr
 */
class Search
{

    private $DB;

    public function __construct()
    {
        $this->DB = DataBaseAccess::getInstance();
    }

    public function FullSearch(string $Query)
    {
        return array("associations" => $this->AssoSearch($Query),
                     "categories" => $this->CatSearch($Query),
                     "events" => $this->EventSearch($Query),
                     "posts" => $this->PostSearch($Query),
                     "profiles" => $this->ProfileSearch($Query),
                     "staff" => $this->StaffSearch($Query),
                     "users" => $this->UserSearch($Query));
    }

    public function AssoSearch(string $Query)
    {
        $AssoSearch = $this->DB->prepare('SELECT id_asso,name_asso,acronym,description_asso,logo, MATCH(name_asso,acronym,description_asso,email,phone) AGAINST (:query) AS score_asso
                                          FROM associations
                                          WHERE MATCH(name_asso,acronym,description_asso,email,phone) AGAINST (:query)
                                          ORDER BY score_asso DESC');
        $AssoSearch->bindParam(':query', $Query, \PDO::PARAM_STR);
        $AssoSearch->execute();
        $FoundAssos = $AssoSearch->fetchAll(\PDO::FETCH_ASSOC);
        return (count($FoundAssos) > 0) ? $FoundAssos : null;
    }

    public function CatSearch(string $Query)
    {
        $CatSearch = $this->DB->prepare('SELECT id_category,name_cat,description_cat, MATCH(name_cat,description_cat) AGAINST (:query) AS score_cat
                                          FROM categories
                                          WHERE MATCH(name_cat,description_cat) AGAINST (:query)
                                          ORDER BY score_cat DESC');
        $CatSearch->bindParam(':query', $Query, \PDO::PARAM_STR);
        $CatSearch->execute();
        $FoundCat = $CatSearch->fetchAll(\PDO::FETCH_ASSOC);
        return (count($FoundCat) > 0) ? $FoundCat : null;
    }

    public function EventSearch(string $Query)
    {
        $EventSearch = $this->DB->prepare('SELECT events.*,name_asso,logo, MATCH(name_event,description_event) AGAINST (:query) AS score_event
                                          FROM events
                                              JOIN associations ON events.id_asso = associations.id_asso
                                          WHERE MATCH(name_event,description_event) AGAINST (:query)
                                          OR MATCH(name_asso,acronym) AGAINST (:query)
                                          ORDER BY score_event DESC');
        $EventSearch->bindParam(':query', $Query, \PDO::PARAM_STR);
        $EventSearch->execute();
    $FoundEvents = $EventSearch->fetchAll(\PDO::FETCH_ASSOC);
        return (count($FoundEvents) > 0) ? $FoundEvents : null;
    }

    public function PhotoSearch(string $Query)
    {

    }

    public function PostSearch(string $Query)
    {
        $PostSearch = $this->DB->prepare('SELECT posts.*,name_cat,username, MATCH(name_post,content_post) AGAINST (:query) AS score_post
                                          FROM posts
                                              JOIN categories ON posts.id_category = categories.id_category
                                              JOIN users ON posts.id_user = users.id_user
                                          WHERE MATCH(name_post,content_post) AGAINST (:query)
                                          OR MATCH(name_cat) AGAINST (:query)
                                          OR MATCH(username) AGAINST (:query)
                                          ORDER BY score_post DESC');
        $PostSearch->bindParam(':query', $Query, \PDO::PARAM_STR);
        $PostSearch->execute();
        $FoundPosts = $PostSearch->fetchAll(\PDO::FETCH_ASSOC);
        return (count($FoundPosts) > 0) ? $FoundPosts : null;
    }

    public function ProfileSearch(string $Query)
    {
        $ProfileSearch = $this->DB->prepare('SELECT profiles.id_profile,first_name,last_name,avatar,description_profile,staff.id_asso,name_asso,position, MATCH(first_name,last_name,profiles.email,profiles.phone,description_profile) AGAINST (:query) AS score_profile
                                          FROM profiles
                                              JOIN staff ON staff.id_profile = profiles.id_profile
                                              JOIN associations ON staff.id_asso = associations.id_asso
                                          WHERE MATCH(first_name,last_name,profiles.email,profiles.phone,description_profile) AGAINST (:query)
                                          OR MATCH(position) AGAINST (:query)
                                          OR MATCH(name_asso,acronym) AGAINST (:query)
                                          ORDER BY score_profile DESC');
        $ProfileSearch->bindParam(':query', $Query, \PDO::PARAM_STR);
        $ProfileSearch->execute();
        $FoundProfiles = $ProfileSearch->fetchAll(\PDO::FETCH_ASSOC);
        return (count($FoundProfiles) > 0) ? $FoundProfiles : null;
    }

    public function StaffSearch(string $Query)
    {
        $StaffSearch = $this->DB->prepare('SELECT staff.*,first_name,last_name,name_asso,acronym, MATCH(position) AGAINST (:query) AS score_staff
                                          FROM staff
                                              JOIN profiles ON staff.id_profile = profiles.id_profile
                                              JOIN associations ON staff.id_asso = associations.id_asso
                                          WHERE MATCH(position) AGAINST (:query)
                                          OR MATCH(first_name,last_name) AGAINST (:query)
                                          OR MATCH(name_asso,acronym) AGAINST (:query)
                                          ORDER BY score_staff DESC');
        $StaffSearch->bindParam(':query', $Query, \PDO::PARAM_STR);
        $StaffSearch->execute();
        $FoundStaff = $StaffSearch->fetchAll(\PDO::FETCH_ASSOC);
        return (count($FoundStaff) > 0) ? $FoundStaff : null;
    }

    public function UserSearch(string $Query)
    {
        $UserSearch = $this->DB->prepare('SELECT id_user,username,users.id_profile,first_name,last_name, MATCH(username) AGAINST (:query) AS score_users
                                          FROM users
                                              JOIN profiles ON users.id_profile = profiles.id_profile
                                          WHERE MATCH(username) AGAINST (:query)
                                          OR MATCH(first_name,last_name) AGAINST (:query)
                                          ORDER BY score_users DESC');
        $UserSearch->bindParam(':query', $Query, \PDO::PARAM_STR);
        $UserSearch->execute();
        $FoundUsers = $UserSearch->fetchAll(\PDO::FETCH_ASSOC);
        return (count($FoundUsers) > 0) ? $FoundUsers : null;
    }
}
