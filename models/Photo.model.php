<?php namespace Model;

require_once('DataBaseAccess.class.php');

/**
 * Photo model class which contains all request to the database for event galleries
 *
 * @author Axel Floquet-Trillot
 * @link https://axelfloquet.fr
 */
class Photo
{

    private $DB;

    public function __construct()
    {
        $this->DB = DataBaseAccess::getInstance();
    }

    public function NewPhoto(string $NamePhoto, string $Source, int $DescriptionPhoto = null, int $IdEvent = null, int $IdProfile = null)
    {
        $NewPhoto = $this->DB->prepare('INSERT INTO photos(name_photo,source,description_photo,id_event,id_profile)
                                      VALUES (:name_photo, :source, :description_photo, :id_event, :id_profile)');
        $NewPhoto->bindParam(':name_photo', $NamePost, \PDO::PARAM_STR);
        $NewPhoto->bindParam(':source', $Source, \PDO::PARAM_STR);
        $NewPhoto->bindParam(':description_photo', $DescriptionPhoto, \PDO::PARAM_STR);
        $NewPhoto->bindParam(':id_event', $IdEvent, \PDO::PARAM_INT);
        $NewPhoto->bindParam(':id_profile', $IdProfile, \PDO::PARAM_INT);
        $NewPhoto->execute();
    }

    public function GetPhoto(int $IdPhoto = null)
    {
        $Query = 'SELECT * FROM photos' . ((!is_null($IdPhoto)) ? ' WHERE id_photo = :id_photo' : '');
        $GetPhoto = $this->DB->prepare($Query);
        if (!is_null($IdPhoto)) $GetPhoto->bindParam(':id_photo', $IdPhoto, \PDO::PARAM_INT);
        $GetPhoto->execute();
        $Photos = $GetPhoto->fetchAll(\PDO::FETCH_ASSOC);
        return (count($Photos) > 0) ? $Pbotos : null;
    }

    public function UpdatePhoto(int $IdPhoto, string $NamePhoto, string $DescriptionPhoto = null)
    {
        $UpdatePhoto = $this->DB->prepare('UPDATE photos SET name_photo = :name_photo, description_photo = :description_photo, WHERE id_photo = :id_photo');
        $UpdatePhoto->bindParam(':name_photo', $NamePhoto, \PDO::PARAM_STR);
        $UpdatePhoto->bindParam(':description_photo', $DescriptionPhoto, \PDO::PARAM_STR);
        $UpdatePhoto->bindParam(':id_photo', $IdPhoto, \PDO::PARAM_INT);
        $UpdatePhoto->execute();
    }

    public function DeletePhoto(int $IdPhoto)
    {
        $DelPhoto = $this->DB->prepare('DELETE FROM photos WHERE id_photo = :id_photo');
        $DelPhoto->bindParam(':id_photo', $IdPhoto, \PDO::PARAM_INT);
        $DelPhoto->execute();
    }
}
