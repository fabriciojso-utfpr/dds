<?php

namespace DDS\Entities\Communication;


use DDS\Entities\Interfaces\Host;
use DDS\Entities\Site\Collaborator;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class CommunicationUnit {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="DDS\Entities\Communication\Menssage", mappedBy="communicationUnit", cascade={"persist", "remove"})
     */
    private $menssages;


    public function getId() {
        return $this->id;
    }

    public function __construct() {
        $this->menssages = new ArrayCollection();
    }

    public function addMenssage(Menssage $menssage){
        $this->menssages->add($menssage);
        return $this;
    }
    public function listMenssages(){
        return $this->menssages;
    }
}