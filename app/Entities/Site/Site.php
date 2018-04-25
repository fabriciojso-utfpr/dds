<?php

namespace DDS\Entities\Site;

use DDS\Entities\Communication\CommunicationUnit;
use DDS\Entities\Project\Project;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="SiteRepository")
 * @ORM\Table(name="sites")
 */
class Site {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Descrição da equipe.
     *
     * @ORM\Column(type="string")
     */
    private $description;

    /**
     * Data da criação da equipe.
     * @var \Datetime
     * @ORM\Column(type="date")
     */
    private $birth;

    /**
     * Timezone da equipe
     *
     * @var DateTimeZone
     * @ORM\Column(type="string")
     */
    private $timezone;

    /**
     * Cordenadas geográfica (latitude, longitude) da localização da equipe.
     *
     * @ORM\Column(type="string")
     */
    private $geocoors;

    /**
     * @ORM\OneToMany(targetEntity="Collaborator", mappedBy="site", cascade={"persist", "remove"})
     */
    private $collaborators;

    /**
     * @ORM\ManyToOne(targetEntity="DDS\Entities\Project\Project", inversedBy="sites", cascade={"persist", "remove"})
     */
    private $project;

    /**
     * @var CommunicationUnit[]
     *
     * @ORM\ManyToMany(targetEntity="DDS\Entities\Communication\CommunicationUnit", cascade={"persist", "remove"})
     */
    private $units;


    public function __construct() {
        $this->collaborators = new ArrayCollection();
        $this->units = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    public function getBirth() {
        return $this->birth;
    }

    public function setBirth(\DateTime $birth) {
        $this->birth = $birth;
        return $this;
    }

    public function getTimezone($instance = false) {
        if($instance){
            return new \DateTimeZone($this->getTimezone());
        }
        return $this->timezone;
    }

    public function setTimezone(\DateTimeZone $timezone) {
        $this->timezone = $timezone->getName();
        return $this;
    }

    public function getGeocoors() {
        return $this->geocoors;
    }

    public function setGeocoors($geocoors) {
        $this->geocoors = $geocoors;
        return $this;
    }


    public function addCollaborator(Collaborator $collaborator) {
        $this->collaborators->add($collaborator);
        return $this;
    }

    public function listCollaborators() {
        return $this->collaborators;
    }

    public function getProject() {
        return $this->project;
    }


    public function setProject(Project $project) {
        $this->project = $project;
        $project->addSite($this);
    }


    public function addCommunicationUnit(CommunicationUnit $unit){
        $this->units->add($unit);
        return $this;
    }

    public function listCommunicationUnits(){
        return $this->units;
    }


}