<?php namespace Model;

require_once('DataBaseAccess.class.php');

/**
 * Post model class which contains all request to the database for posts
 *
 * @author Axel Floquet-Trillot
 * @link https://axelfloquet.fr
 */
class Post
{

    private $DB;

    public function __construct()
    {
        $this->DB = DataBaseAccess::getInstance();
    }

    public function NewPost(string $NamePost, string $ContentPost, string $HeadingImage = null, int $IdCat = null, int $IdUser)
    {
        $NewPost = $this->DB->prepare('INSERT INTO posts(name_post,content_post,heading_image,publish_date,id_category,id_user)
                                      VALUES (:name_post, :content_post, :heading_image, NOW(), :id_cat, :id_user)');
        $NewPost->bindParam(':name_post', $NamePost, \PDO::PARAM_STR);
        $NewPost->bindParam(':content_post', $ContentPost, \PDO::PARAM_STR);
        $NewPost->bindParam(':heading_image', $HeadingImage, \PDO::PARAM_STR);
        $NewPost->bindParam(':id_cat', $IdCat, \PDO::PARAM_INT);
        $NewPost->bindParam(':id_user', $IdUser, \PDO::PARAM_INT);
        $NewPost->execute();
    }

    public function GetPost(int $IdPost = null)
    {
        $Query = 'SELECT posts.*,name_cat,profiles.id_profile,first_name,last_name,avatar
                  FROM posts
                      LEFT JOIN categories ON posts.id_category = categories.id_category
                      JOIN users ON posts.id_user = users.id_user
                      JOIN profiles ON users.id_profile = profiles.id_profile'
                  .((!is_null($IdPost)) ? ' WHERE id_post = :id_post' : '');
        $GetPost = $this->DB->prepare($Query);
        if (!is_null($IdPost)) $GetPost->bindParam(':id_post', $IdPost, \PDO::PARAM_INT);
        $GetPost->execute();
        $Posts = $GetPost->fetchAll(\PDO::FETCH_ASSOC);
        return (count($Posts) > 0) ? $Posts : null;
    }

    public function UpdatePost(int $IdPost, string $NamePost, string $ContentPost, string $HeadingImage = null, int $IdCat = null)
    {
        $UpdatePost = $this->DB->prepare('UPDATE posts SET name_post = :name_post, content_post = :content_post, edited_date = NOW(), id_category = :id_cat WHERE id_post = :id_post');
        $UpdatePost->bindParam(':name_post', $NamePost, \PDO::PARAM_STR);
        $UpdatePost->bindParam(':content_post', $ContentPost, \PDO::PARAM_STR);
        $UpdatePost->bindParam(':id_cat', $IdCat, \PDO::PARAM_INT);
        $UpdatePost->bindParam(':id_post', $IdPost, \PDO::PARAM_INT);
        $UpdatePost->execute();
    }

    public function DeletePost(int $IdPost)
    {
        $DelPost = $this->DB->prepare('DELETE FROM posts WHERE id_post = :id_post');
        $DelPost->bindParam(':id_post', $IdPost, \PDO::PARAM_INT);
        $DelPost->execute();
    }
}
