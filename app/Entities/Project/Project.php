<?php

namespace DDS\Entities\Project;

use DDS\Entities\Communication\CommunicationUnit;
use DDS\Entities\Site\Site;
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

    /**
     * @var Site[]
     *
     * @ORM\OneToMany(targetEntity="DDS\Entities\Site\Site", mappedBy="project", cascade={"persist", "remove"})
     */
    private $sites;



    public function __construct() {
        $this->SETools = new ArrayCollection();
        $this->sites = new ArrayCollection();
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function addSite(Site $site){
        $this->sites->add($site);
        return $this;
    }

    public function listSites(){
        return $this->sites;
    }

}