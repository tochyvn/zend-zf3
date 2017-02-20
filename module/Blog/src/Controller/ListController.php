<?php
namespace Blog\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Blog\Model\PostRepositoryInterface;
use Zend\View\Model\ViewModel;


class ListController extends AbstractActionController
{

    private $postRepository;

    public function __construct(PostRepositoryInterface $postRepository) 
    {
    	$this->postRepository = $postRepository;
    }

    public function indexAction()
    {
    	return new ViewModel(array(
    		'posts' => $this->postRepository->findAllPosts(),

    		'sqls' => $this->postRepository->toch(),
    	));
    }

    
}