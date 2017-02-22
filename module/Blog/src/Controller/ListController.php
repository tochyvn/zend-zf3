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

    public function testAction() 
    {
        //Insertion d'un nouvel Album
        $param = [
            'artist' => 'PHP Security',
            'title' => '<script>alert(\'Faille XSS\')</script>'
        ];
        //$this->postRepository->saveAlbum($param);

        return [
            'results' => $this->postRepository->toch()
        ];
    }

    
}