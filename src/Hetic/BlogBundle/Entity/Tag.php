<?php

namespace Hetic\BlogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Tag
 *
 * @ORM\Table(name="tag")
 * @ORM\Entity
 */
class Tag
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="Votre mot-clef ne doit pas être vide!")
     * @Assert\Length(
     *      min = 5,
     *      max = 60,
     *      minMessage = "Mon mot clef est trop court {{ limit }}",
     *      maxMessage = "Mon mot clef est trop long {{ limit }}"
     * )
     * @ORM\Column(name="word", type="string", length=300, nullable=true)
     */
    private $word;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Post", mappedBy="tag")
     */
    private $post;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->post = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Convertis un objet en chaine
     */
    public function __toString(){
        return empty($this->word) ? $this->id : $this->word;
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set word
     *
     * @param string $word
     * @return Tag
     */
    public function setWord($word)
    {
        $this->word = $word;

        return $this;
    }

    /**
     * Get word
     *
     * @return string 
     */
    public function getWord()
    {
        return $this->word;
    }

    /**
     * Add post
     *
     * @param \Hetic\BlogBundle\Entity\Post $post
     * @return Tag
     */
    public function addPost(\Hetic\BlogBundle\Entity\Post $post)
    {
        $this->post[] = $post;

        return $this;
    }

    /**
     * Remove post
     *
     * @param \Hetic\BlogBundle\Entity\Post $post
     */
    public function removePost(\Hetic\BlogBundle\Entity\Post $post)
    {
        $this->post->removeElement($post);
    }

    /**
     * Get post
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPost()
    {
        return $this->post;
    }
}
