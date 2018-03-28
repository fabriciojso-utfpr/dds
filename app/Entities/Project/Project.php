<?php

namespace DDS\Entities\Project;

use DDS\Entities\Traits\SEToolsTrait;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="projects")
 */
class Project {

    use SEToolsTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Descrição do projeto.
     *
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $description;


    public function __construct() {
        $this->SETools = new ArrayCollection();
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }
}