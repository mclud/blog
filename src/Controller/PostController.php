<?php
include_once ('src/Entity/Post.php');
include_once ('src/Entity/TypePost.php');
include_once ('src/Model/Manager.php');
include_once ('src/Model/PostModel.php');
include_once ('src/Model/TypePostModel.php');

class PostController extends Manager {

    public function listPostsView()
    {
        $posts = $this->getPostRepository()->getPosts();
        $rep = $this->sortPostsCustom($posts);
        $categories = $this->getTypePostRepository()->getTypes();
        $lastPosts = $this->getPostRepository()->getLast5Posts();
        $lastComss = $this->getCommentRepository()->getLast5Coms();
        $commentaires = $this->sortsComsCustom($lastComss);
        $lastUser = $this->getUserRepository()->getLastUser();
        require ('views/home.php');
    }
    public function listPostsByCatView($catId) {
        $postsByCat = $this->getPostRepository()->getPostsByCat($catId);
        $posts = $this->sortPostsCustom($postsByCat);
        $categories = $this->getTypePostRepository()->getTypes();
        $categorie = $this->getTypePostRepository()->getTypeById($catId);
        $lastPosts = $this->getPostRepository()->getLast5Posts();
        $lastComss = $this->getCommentRepository()->getLast5Coms();
        $commentaires = $this->sortsComsCustom($lastComss);
        $lastUser = $this->getUserRepository()->getLastUser();
        require('views/postsByCatView.php');
    }
    public function postView($id) {
        $rep = $this->getPostRepository()->getPost($id);
        $coms = $this->getCommentRepository()->getComsByPost($id);
        $comsCustom = [];
        foreach ($coms as $com) {
            $commentaire = new Comment();
            $commentaire->hydrate($com);
            $user = new User();
            $user->hydrate($this->getUserRepository()->getUserById($commentaire->getAuthor()));
            $temp = array(
                'id' => $commentaire->getId(),
                'content' => nl2br($commentaire->getContent()),
                'anonymous' => $commentaire->getAnonymous(),
                'author' => $user->getUsername(),
                'postId' => $commentaire->getPostId(),
            );
            $comsCustom[] = $temp;
        }
        $categories = $this->getTypePostRepository()->getTypes();
        require ('views/postView.php');
    }
    public function addPostView()
    {
        $categories = $this->getTypePostRepository()->getTypes();
        $types = $this->getTypePostRepository()->getTypes();
        require('views/post/addPostView.php');
    }
    public function addPost($title, $content, $typeId, $imgsrc)
    {
        $post = new Post();
        $post->hydrate(array(
            'title' => $title,
            'content' => $content,
            'archive' => 0,
            'type' => $typeId,
        ));
        if (!empty($imgsrc)) {
            var_dump('PICTURE ON');
            $post->setImgsrc($imgsrc);
        }
        var_dump($post);
        $this->getPostRepository()->addPost($post);
        $this->listPostsView();
    }
    public function delPost($id)
    {
        $em = new Manager();
        $postSelected = $em->getPostRepository()->getPost($id);
        if ($postSelected) {
            //Suppression des commentaires sur l'article
            $em->getCommentRepository()->deleteComsByPost($id);
            //Suppression du post
            $em->getPostRepository()->deletePost($id);
//            $posts = $em->getPostRepository()->getPosts();
//            $users = $em->getUserRepository()->getUsers();
//            require('views/adminView.php');
            $userController = new UserController();
            $userController->adminView();
        } else {
            echo 'erreur';
        }
    }
    public function editPostView($id)
    {
        $em = new Manager();
        $types = $em->getTypePostRepository()->getTypes();
        $post = $em->getPostRepository()->getPost($id);
        $categories = $this->getTypePostRepository()->getTypes();
        require ('views/editPostView.php');
    }
    public function editPost($id, $title, $content, $type, $imgsrc)
    {
        $em = new Manager();
        $db = $em->dbConnect();
        $postRepo = new PostModel($db);
        $postSelected = $postRepo->getPost($id);
        $post = new Post();
        $post->hydrate($postSelected);
        $post->setTitle($title);
        $post->setContent($content);
        $post->setType($type);
        $post->hydrate(array(
            $post->hydrate($postSelected),
            'title' => $title,
            'content' => $content,
            'type' => $type,
            'imgsrc' => $imgsrc,

        ));
        $em->getPostRepository()->updatePost($post);
        $this->listPostsView();
    }
    private function sortPostsCustom(array $posts) {
        $rep = [];
        foreach ($posts as $post) {
            $newPost = new Post();
            $newPost->hydrate($post);
            $datePost = $newPost->getCreatedAt();
            $date = new DateTime($datePost);
            $type = new TypePost();
            $type->hydrate($this->getTypePostRepository()->getTypeById($newPost->getType()));
            $temp = array(
                'id' => $newPost->getId(),
                'title' => $newPost->getTitle(),
                'content' => $newPost->getContent(),
                'imgsrc' => $newPost->getImgsrc(),
                'createdAt' => $date->format('d/m/y à H:i'),
                'counter' => $this->getCommentRepository()->getNbComs($newPost->getId()),
                'type' => $type->getLibelle(),
                'typeId' => $type->getId(),
            );
            $rep[] = $temp;
        }
        return $rep;
    }
    private function sortsComsCustom(array $coms) {

        $commentaires = [];
        foreach ($coms as $lastCom) {
            //Create com
            $com = new Comment();
            $com->hydrate($lastCom);
            //Create Post
            $post = new Post();
            $post->hydrate($this->getPostRepository()->getPost($com->getPostId()));
            //Get author name
            $user = new User();
            $user->hydrate($this->getUserRepository()->getUserById($com->getAuthor()));
            $temp['author'] = $user->getUsername();
            $temp['post'] = $post->getTitle();
            $temp['postId'] = $post->getId();
            $commentaires[] = $temp;
        }
        return $commentaires;
    }
}