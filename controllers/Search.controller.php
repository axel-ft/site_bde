<?php namespace Controller;

require_once "controllers/Common.controller.php";
require_once "models/Search.model.php";

class Search extends CommonController
{
    private $SearchQuery;
    private $Query;
    private $Accents;
    private $Results;

    public function __construct(string $Query = null)
    {
        $this->SearchQuery = new \Model\Search();
        $this->Query = (!is_null($Query) && $_SERVER['REQUEST_METHOD'] === 'GET' ) ? $Query : $this->GetPostQuery();
        $this->Accents = "àèìòùÀÈÌÒÙáéíóúÁÉÍÓÚâêîôûÂÊÎÔÛäëïöüÄËÏÖÜçÇœ";
    }

    public function GetPostQuery()
    {
        return (self::IsFieldPresent('query')) ? self::ValidateStringField('query') : null;
    }

    public function PrepareQuery()
    {
        $this->Query = \strtolower($this->Query);
        $this->Query = \preg_replace("/[^ 0-9a-zA-Z" . $this->Accents . "]/", " ", $this->Query);
        while (\strstr($this->Query, "  ")) $this->Query = \str_replace("  ", " ", $this->Query);
    }

    public function ProcessPostQuerySearch()
    {
        if (is_null($this->Query)) throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                                <i class="zmdi zmdi-close"></i>
                                                            </button>
                                                            <strong><i class="zmdi zmdi-close-circle"></i></strong>Votre recherche n\'a pas pu aboutir
                                                        </div>');

        $this->PrepareQuery();
        $this->Query = \str_replace(" ", "+", $this->Query);

        if (!is_null($this->Query) && !empty($this->Query)) \header('Location: /search/' . htmlspecialchars($this->Query));
        else throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                       <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                           <i class="zmdi zmdi-close"></i>
                                       </button>
                                       <strong><i class="zmdi zmdi-close-circle"></i></strong>Votre recherche n\'a pas pu aboutir
                                   </div>');
    }

    public function ProcessGetQuerySearch()
    {
        if (is_null($this->Query)) throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                                <i class="zmdi zmdi-close"></i>
                                                            </button>
                                                            <strong><i class="zmdi zmdi-close-circle"></i></strong>Votre recherche n\'a pas pu aboutir
                                                        </div>');

        $this->PrepareQuery();
        $this->Query = \str_replace(" ", " +", $this->Query);
        if (\substr($this->Query, 0, 2) === ' +') $this->Query = \substr($this->Query, 1);
        else $this->Query = '+' . $this->Query;

        if (is_null($this->Query) || empty($this->Query)) throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                                                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                                                        <i class="zmdi zmdi-close"></i>
                                                                                    </button>
                                                                                    <strong><i class="zmdi zmdi-close-circle"></i></strong>Votre recherche n\'a pas pu aboutir
                                                                                </div>');
    }

    public function GetSearchResults(string $Content)
    {
        switch ($Content)
        {
            case "Full":
                $this->Results = $this->SearchQuery->FullSearch($this->Query);
        }
    }

    public function RequireView(string $Type, string $Message = null)
    {
        switch ($Type)
        {
            case "NoQuery":
                return require_once('views/search/Search.view.php');
                break;

            case "Results":
                var_dump($this->Results);
                return require_once('views/search/FullSearchResults.view.php');
                break;
        }
    }
}

?>
