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
        return (isset($_POST[$PostInput]) && !empty(trim($_POST[$PostInput])));
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
        return (isset($_POST[$PostInput]) && !empty(intval(trim($_POST[$PostInput])))) ? intval(trim($_POST[$PostInput])) : null;
    }

    public function GetMessage()
    {
        return (isset($this->Message) && !empty($this->Message)) ? $this->Message : null;
    }
}
