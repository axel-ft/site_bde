<?php namespace Controller;

require_once "controllers/Common.controller.php";
require_once "models/Post.model.php";
require_once "models/Category.model.php";
require_once "models/User.class.php";

class ManagePosts extends CommonController
{
    private $PostsQueries,
            $UserQueries,
            $CatQueries;
    private $NamePost,
            $ContentPost,
            $HeadingImage,
            $IdCat,
            $IdUser;

    public function __construct()
    {
        if (!self::Connected() && self::IsManager())
           throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                        <i class="zmdi zmdi-close"></i>
                                    </button>
                                    <strong><i class="zmdi zmdi-close-circle"></i></strong>Vous n\'avez pas les droits suffisants pour accéder à cette page
                                 </div>');

        $this->PostsQueries = new \Model\Post();
        $this->UserQueries = new \Model\UserManagement();
        $this->CatQueries = new \Model\Category();
    }

    private function IsPostFormComplete()
    {
        if ($IsPostFormComplete = (self::AreFieldsPresent("name_post", "content_post")))
        {
            $this->NamePost = self::ValidateStringField("name_post");
            $this->ContentPost = self::ValidateStringField("content_post");
            $this->HeadingImage = self::ValidateUploadedImage("heading_image", "posts/heading");
            $this->IdCat = self::ValidateIntField("category");
            if ($this->IdCat === -1) $this->IdCat = null;
            $this->IdUser = $_SESSION['id_user'];
        }

        return $IsPostFormComplete;
    }

    public function AddPost()
    {
        if ($this->IsPostFormComplete())
        {
            $this->PostsQueries->NewPost($this->NamePost, $this->ContentPost, $this->HeadingImage, $this->IdCat, $this->IdUser);
            $this->Message = '<div class="alert alert-success alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-check"></i></strong>L\'article a correctement été ajouté
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

    private function IsPostDataCorrectlyRetrieved()
    {
        return ((!is_null($this->NamePost) && !empty($this->NamePost))
                && (!is_null($this->ContentPost) && !empty($this->ContentPost)));
    }

    public function UpdatePost(int $ID)
    {
        if ($this->IsPostFormComplete() && $this->IsPostDataCorrectlyRetrieved())
        {
            $this->PostsQueries->UpdatePost($ID, $this->NamePost, $this->ContentPost, $this->HeadingImage, $this->IdCat);
            $this->Message = '<div class="alert alert-success alert-light alert-dismissible text-center" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                    <i class="zmdi zmdi-close"></i>
                                </button>
                                <strong><i class="zmdi zmdi-check"></i></strong>L\'article a correctement été mis à jour
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

    public function DeletePost(int $ID)
    {
        $this->PostsQueries->DeletePost($ID);
        $this->Message = '<div class="alert alert-success alert-light alert-dismissible text-center" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                <i class="zmdi zmdi-close"></i>
                            </button>
                            <strong><i class="zmdi zmdi-check"></i></strong>L\'article a correctement été supprimé
                          </div>';
    }

    public function RequireView(string $CRUD, int $IdPost = null, string $Message = null)
    {
        if (is_null($Message))
            $Message = $this->Message;

        switch ($CRUD)
        {
            case "List":
                $Posts = $this->PostsQueries->GetPost();
                return require_once('views/manage/posts/ManagePosts.view.php');
                break;

            case "Add":
                $Categories = $this->CatQueries->GetCategories();
                return require_once('views/manage/posts/AddPost.view.php');
                break;

            case "Edit":
                if (!is_null($IdPost)) $Post = $this->PostsQueries->GetPost($IdPost);
                if (!isset($Post) || is_null($Post))
                    throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                <i class="zmdi zmdi-close"></i>
                                            </button>
                                            <strong><i class="zmdi zmdi-close-circle"></i></strong>Mauvais paramètre : cet article n\'existe pas
                                          </div>');
                $Categories = $this->CatQueries->GetCategories();
                return require_once('views/manage/posts/EditPost.view.php');
                break;

            case "Delete":
                if (!is_null($IdPost)) $Post = $this->PostsQueries->GetPost($IdPost);
                if (!isset($Post) || is_null($Post))
                    throw new \Exception('<div class="alert alert-danger alert-light alert-dismissible text-center" role="alert">
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Fermer">
                                                <i class="zmdi zmdi-close"></i>
                                            </button>
                                            <strong><i class="zmdi zmdi-close-circle"></i></strong>Mauvais paramètre : cet article n\'existe pas
                                          </div>');
                return require_once('views/manage/posts/DeletePost.view.php');
                break;
        }
    }
}

?>
