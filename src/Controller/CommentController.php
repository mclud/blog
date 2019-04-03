<?php
include_once ('src/Entity/Comment.php');
include_once ('src/Model/CommentModel.php');

class CommentController
{
    public function addCom($content, $author, $idPost) {
        $em = new Manager();
        if (!empty($content) && !empty($author)) {
            if (isset($_SESSION['id'])) {
                $com = new Comment();
                $com->hydrate(array(
                    'content' => $content,
                    'author' => $_SESSION['id'],
                    'anonymous' => false,
                    'postId' => $idPost
                ));
            } else {
                $com = new Comment();
                $userAnonymous = $em->getUserRepository()->getByUserName('Anonymous');
                $user = new User();
                $user->hydrate($userAnonymous);
                $com->hydrate(array(
                    'content' => $content,
                    'author' =>  $user->getId(),
                    'anonymous' => $author,
                    'postId' => $idPost
                ));
            }

            $em->getCommentRepository()->addCom($com);
            $postController = new PostController();
            $postController->postView($idPost);
        } else {
            echo 'error add com controller';
        }
    }
    public function delCom($id, $idPost) {
        $em = new Manager();
        $em->getCommentRepository()->delCom($id);
        $postController = new PostController();
        $postController->postView($idPost);
    }
}