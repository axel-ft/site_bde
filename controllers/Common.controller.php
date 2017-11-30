<?php namespace Controller;

class CommonController
{
    protected $Message;

    public function __construct()
    {

    }

    protected static function Connected()
    {
        return isset($_SESSION['connected']) && $_SESSION['connected']
            && isset($_SESSION['id_user']) && !empty($_SESSION['id_user'])
            && isset($_SESSION['id_profile']) && !empty($_SESSION['id_profile']);
    }

    protected static function IsAccountActive($Account)
    {
        return (intval($Account['active']) === 1);
    }

    protected static function IsManager($Account = null)
    {
        if (is_null($Account))
            return (!isset($_SESSION['manager']) || empty($_SESSION['manager']) || !$_SESSION['manager']);
        else
            return (intval($Account['admin']) === 1);
    }

    protected static function IsFieldPresent(string $PostInput)
    {
        return (isset($_POST[$PostInput]) && (!empty(trim($_POST[$PostInput])) || trim($_POST[$PostInput]) === "0"));
    }

    protected static function IsFilePresent(string $PostFile)
    {
        return (isset($_FILES[$PostFile]) && (!empty($_FILES[$PostFile])));
    }

    protected static function AreFieldsPresent()
    {
        $Fields = func_get_args();

        foreach($Fields as $Field)
        {
            if(!self::IsFieldPresent($Field))
                return false;
        }

        return true;
    }

    protected static function ValidateStringField(string $PostInput)
    {
        return (isset($_POST[$PostInput]) && !empty(trim($_POST[$PostInput]))) ? trim($_POST[$PostInput]) : null;
    }

    protected static function ValidateIntField(string $PostInput)
    {
        return (isset($_POST[$PostInput]) && (!empty(intval(trim($_POST[$PostInput]))) || intval(trim($_POST[$PostInput])) === 0)) ? intval(trim($_POST[$PostInput])) : null;
    }

    protected static function ValidateDateField(string $PostInput)
    {
        $DateTimeOutput;

        if (isset($_POST[$PostInput]) && !empty(trim($_POST[$PostInput])))
            $DateTimeOutput = new \DateTime(trim($_POST[$PostInput]));

        return (!is_null($DateTimeOutput)) ? $DateTimeOutput : null;
    }

    protected static function ValidateUploadedImage(string $PostFileInput, string $PathInImagesFolder = "")
    {
        if (!empty($_FILES[$PostFileInput]) && $_FILES[$PostFileInput]['error'] !== 4)
        {
            $Extension = strrchr($_FILES[$PostFileInput]['name'], '.');
            $ImageFileName = md5_file($_FILES[$PostFileInput]['tmp_name']) . $Extension;
            $MaxSize = 10485760;
            $Size = filesize($_FILES[$PostFileInput]['tmp_name']);
            $AuthorizedExtensions = array(".png", ".gif", ".jpg", "jpeg", ".bmp", ".PNG", ".GIF", ".JPG", ".JPEG", ".BMP");

            $FInfo = finfo_open(FILEINFO_MIME_TYPE);
            $MIME = finfo_file($FInfo, $_FILES[$PostFileInput]['tmp_name']);
            $AuthorizedMIMEs = array("image/png", "image/gif", "image/jpeg", "images/bmp");

            if (!in_array($Extension, $AuthorizedExtensions) && !in_array($MIME, $AuthorizedMIMEs))
                throw new \Exception("Vous devez uploader un fichier de type PNG, JPG, JPEG, GIF ou BMP");

            if ($Size > $MaxSize)
                throw new \Exception("Le fichier est trop grand (max. 10Mo)");

            if (move_uploaded_file($_FILES[$PostFileInput]['tmp_name'], './public/images/' . $PathInImagesFolder . "/" . $ImageFileName))
                return '/public/images/' . $PathInImagesFolder . "/" . $ImageFileName;
            else
                throw new \Exception("Il y a eu un problème lors de l'enregistrement du fichier");
        }

        else
            return null;
    }

    public function GetMessage()
    {
        return (isset($this->Message) && !empty($this->Message)) ? $this->Message : null;
    }
}
