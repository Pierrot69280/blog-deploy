<?php

namespace App\Controller;

use App\Entity\Comment;
use App\Repository\ArticleRepository;
use App\Repository\CommentRepository;
use Core\Controller\Controller;
use Core\Http\Response;

class CommentController extends Controller
{
    public function delete():Response
    {

        $id = null;

        if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
            $id = $_GET['id'];
        } // vérifie que c'est le bon id dans l'url

        if (!$id) {return $this->redirect();}

        $commentRepository = new CommentRepository();
        $comment = $commentRepository->find($id);

        if($comment)
        {
            $idArticle = $comment->getArticleId();
            $commentRepository->delete($comment);


            return $this->redirect("?type=article&action=show&id=$idArticle");
        }
        return $this->redirect();
    }

    public function create():Response
    {

        $articleId = null;
        $content = null;

        if(!empty($_POST['articleId']) && ctype_digit($_POST['articleId']))
        {
            $articleId = $_POST['articleId'];
        }
        if(!empty($_POST['content']))
        {
            $content = $_POST['content'];
        }

        if($articleId && $content){

            $articleRepo = new ArticleRepository();
            $article = $articleRepo->find($articleId);

            if(!$article){return $this->redirect();}
            $actualUser = $this->getUser();
            $comment = new Comment();
            $comment->setContent($content);
            $comment->setArticleId($articleId);
           $comment->setUserId($actualUser->getId());
           // $comment->setAuthorUsername($actualUser);

            $commentRepository = new CommentRepository();
            $commentRepository->save($comment);

            return $this->redirect("?type=article&action=show&id=".$article->getId());

        }

        return $this->redirect("?type=article&action=index");
    }

    public function update():Response
    {
        $commentId = null;
        $content = null;


        if(!empty($_POST['id']) && ctype_digit($_POST['id']))
        {
            $commentId = $_POST['id'];
        }
        if(!empty($_POST['content']))
        {
            $content = $_POST['content'];
        }

        if($commentId && $content) {

            $commentRepository = new CommentRepository();

            $comment = $commentRepository->find($commentId);

            if (!$comment) {
                return $this->redirect();
            }


            $comment->setContent($content);


            $commentRepository->edit($comment);

            return $this->redirect("?type=article&action=show&id=" . $comment->getArticleId());

        }


        $id = null;

        if(!empty($_GET['id']) && ctype_digit($_GET['id'])){
            $id = $_GET['id'];
        }

        if(!$id){ return  $this->redirect();}

        $commentRepository = new CommentRepository();
        $comment = $commentRepository->find($id);

        if($comment)
        {

            return $this->render("comments/edit", [
                "pageTitle"=>"modifier",
                "comment"=>$comment
            ]);
        }
        return $this->redirect();
    }

}