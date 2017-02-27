<?php
namespace OrmDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use OrmDoctrine\Entity\Comment;

/**
 * @ORM\Entity
 * @ORM\Table(name="post")
 */
class Post 
{

  const STATUS_DRAFT       = 1; // Draft.
  const STATUS_PUBLISHED   = 2; // Published.

  /**
   * @ORM\Id
   * @ORM\GeneratedValue
   * @ORM\Column(name="id")   
   */
  protected $id;

  /** 
   * @ORM\Column(name="title")  
   */
  protected $title;

  /** 
   * @ORM\Column(name="content")  
   */
  protected $content;

  /** 
   * @ORM\Column(name="status")  
   */
  protected $status;

  /**
   * @ORM\Column(name="date_created")  
   */
  protected $dateCreated;

  /**
   * @ORM\OneToMany(targetEntity="\OrmDoctrine\Entity\Comment", mappedBy="post")
   * @ORM\JoinColumn(name="id", referencedColumnName="post_id")
   */
  protected $comments;

  /**
   * @ORM\ManyToMany(targetEntity="\OrmDoctrine\Entity\Tag", inversedBy="posts")
   * @ORM\JoinTable(name="post_tag",
   *      joinColumns={@ORM\JoinColumn(name="post_id", referencedColumnName="id")},
   *      inverseJoinColumns={@ORM\JoinColumn(name="tag_id", referencedColumnName="id")}
   *      )
   */
  protected $tags;


  /**
   * Constructor.
   */
  public function __construct() 
  {
    $this->comments = new ArrayCollection(); 
    $this->tags = new ArrayCollection();            
  }

  public function getId() 
  {
    return $this->id;
  }

  public function setId($id) 
  {
    $this->id = $id;
  }

  public function getTitle() 
  {
    return $this->title;
  }

  public function setTitle($title) 
  {
    $this->title = $title;
  }

  public function getStatus() 
  {
    return $this->status;
  }

  public function setStatus($status) 
  {
    $this->status = $status;
  }
    
  public function getContent() 
  {
    return $this->content; 
  }
    
  public function setContent($content) 
  {
    $this->content = $content;
  }
    
  public function getDateCreated() 
  {
    return $this->dateCreated;
  }
    
  public function setDateCreated($dateCreated) 
  {
    $this->dateCreated = $dateCreated;
  }
    
  /**
   * Returns comments for this post.
   * @return array
   */
  public function getComments() 
  {
    return $this->comments;
  }
    
  /**
   * Adds a new comment to this post.
   * @param $comment
   */
  public function addComment($comment) 
  {
    $this->comments[] = $comment;
  }

  // Returns tags for this post.
  public function getTags() 
  {
    return $this->tags;
  }      
    
  // Adds a new tag to this post.
  public function addTag($tag) 
  {
    $this->tags[] = $tag;        
  }
    
  // Removes association between this post and the given tag.
  public function removeTagAssociation($tag) 
  {
    $this->tags->removeElement($tag);
  }

}