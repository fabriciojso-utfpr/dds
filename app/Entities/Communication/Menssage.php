<?php

namespace DDS\Entities\Communication;


use DDS\Entities\Communication\Content\Content;
use DDS\Entities\Interfaces\Host;
use DDS\Entities\Project\SETool;
use DDS\Entities\Site\Collaborator;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Menssage {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="DDS\Entities\Project\SETool", cascade={"persist", "remove"})
     */
    private $SETool;

    /**
     * @ORM\ManyToOne(targetEntity="DDS\Entities\Site\Collaborator", cascade={"persist", "remove"})
     */
    private $source;

    /**
     * @ORM\ManyToOne(targetEntity="DDS\Entities\Communication\Channel", cascade={"persist", "remove"})
     */
    private $destination;

    /**
     * @ORM\ManyToOne(targetEntity="DDS\Entities\Communication\Content\Content", cascade={"persist", "remove"})
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datetime;

    /**
     * @var CommunicationUnit
     * @ORM\ManyToOne(targetEntity="DDS\Entities\Communication\CommunicationUnit", inversedBy="menssages", cascade={"persist", "remove"})
     */
    private $communicationUnit;


    public function getId() {
        return $this->id;
    }

    public function getCommunicationUnit() {
        return $this->communicationUnit;
    }

    public function setCommunicationUnit(CommunicationUnit $communicationUnit) {
        $this->communicationUnit = $communicationUnit;
    }


    public function getSETool() {
        return $this->SETool;
    }

    public function setSETool(SETool $SETool) {
        $this->SETool = $SETool;
        return $this;
    }

    public function getSource() {
        return $this->source;
    }

    public function setSource(Collaborator $source) {
        $this->source = $source;
        return $this;
    }

    public function getDestination() {
        return $this->destination;
    }

    public function setDestination(Channel $destination) {
        $this->destination = $destination;
        return $this;
    }

    public function getContent() : Content {
        return $this->content;
    }

    public function setContent(Content $content) {
        $this->content = $content;
        return $this;
    }

    public function getDatetime() : \DateTime {
        return $this->datetime;
    }

    public function setDatetime(\DateTime $datetime) {
        $this->datetime = $datetime;
        return $this;
    }

}