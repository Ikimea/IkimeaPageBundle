<?php

namespace Ikimea\PageBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="component")
 * @ORM\Entity(repositoryClass="Ikimea\PageBundle\Repository\ComponentRepository")
 */
class Component {  
    
    /**
     * @ORM\GeneratedValue
     * @ORM\Id
     * @ORM\Column(type="integer")
     */
    private $id;
    
     /** 
      * @ORM\Column(type="integer")
      * @Assert\NotBlank()
      */
    private $zone;
    
    /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */  
    private $type;
    
    /**
     * @ORM\Column(type="text")
     */  
    private $text;

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
     * Set zone
     *
     * @param string $zone
     */
    public function setZone($zone)
    {
        $this->zone = $zone;
    }

    /**
     * Get zone
     *
     * @return string 
     */
    public function getZone()
    {
        return $this->zone;
    }
    
    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Get text
     *
     * @return text 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set text
     *
     * @param text $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }
}