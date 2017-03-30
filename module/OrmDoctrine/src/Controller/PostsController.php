<?php
namespace OrmDoctrine\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use Doctrine\ORM\EntityManager;
use OrmDoctrine\Entity\Post;


class PostsController extends AbstractActionController
{

	private $entityManager;

	public function __construct(EntityManager $entityManager) 
	{
		$this->entityManager = $entityManager;
		//var_dump($entityManager);
	}

    public function indexAction()
    {
    	
    }

    public function saveAction() 
    {
    	$post = new Post();
    	$post->setTitle("Top 10+ Books abo''''ut Zend Framework 3");
		$post->setContent("Post bo''dy goes h''''''''ere");
		$post->setStatus(Post::STATUS_PUBLISHED);
		$currentDate = date('Y-m-d H:i:s');
		$post->setDateCreated($currentDate);        

		// Add the entity to entity manager.
		var_dump($this->entityManager->persist($post));

		// Apply changes to database.
		$this->entityManager->flush();
	    //var_dump($post);
	    die('Fin de l\insertion!!!!!!!!!');
    }

    public function findAllAction() 
    {
    	$posts = $this->entityManager->getRepository(Post::class)
    								 ->findBy(['status' => Post::STATUS_PUBLISHED]);
    	//var_dump($posts);
    	foreach ($posts as $post) {
    		var_dump($post->getTitle());
    		$comments = $post->getComments();
    		foreach ($comments as $comment) {
    			var_dump($comment);
    		}
    	}
    	die('fin du listages des posts');
    }

    

    
}