<?php

namespace DDS\Entities\Communication;

use DDS\Entities\Site\Collaborator;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Channel {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToMany(targetEntity="DDS\Entities\Site\Collaborator", cascade={"persist", "remove"})
     */
    private $hosts;

    /**
     * @ORM\Column(type="string")
     */
    private $type; // Direto, Grupo, Canal

    public function __construct() {
        $this->hosts = new ArrayCollection();
    }


    public function getId() {
        return $this->id;
    }

    public function addHost(Collaborator $host){
        $this->hosts->add($host);
        return $this;
    }

    public function listHosts(){
        return $this->hosts;
    }


    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
        return $this;
    }
}