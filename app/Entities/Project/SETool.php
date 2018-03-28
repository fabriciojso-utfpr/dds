<?php


namespace DDS\Entities\Project;

use Doctrine\ORM\Mapping as ORM;

/**
 * Ferramenta de Engenharia de Software
 *
 * @ORM\Entity
 * @ORM\Table(name="setools")
 */
class SETool {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Nome da ferramenta
     *
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    public function __construct($name = null) {
        $this->name = $name;
    }

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


}