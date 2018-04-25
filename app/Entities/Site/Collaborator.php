<?php

namespace DDS\Entities\Site;

use DDS\Entities\Interfaces\{
    Host
};
use DDS\Entities\Traits\SEToolsTrait;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="collaborators")
 */
class Collaborator implements Host {
    use SEToolsTrait;

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Nome do colaborador
     * @var string
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * E-mail do colaborador, usado principalmente para identifica-lo.
     * @var string
     * @ORM\Column(type="string")
     */
    private $email;

    /**
     * @var Site
     * @ORM\ManyToOne(targetEntity="DDS\Entities\Site\Site", inversedBy="collaborators", cascade={"persist", "remove"})
     */
    private $site;


    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
        return $this;
    }

    public function getSite() {
        return $this->site;
    }

    public function setSite(Site $site) {
        $site->addCollaborator($this);
        $this->site = $site;
    }

}