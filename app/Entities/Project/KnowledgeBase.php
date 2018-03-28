<?php

namespace DDS\Entities\Project;

use DDS\Entities\Interfaces\Host;
use Doctrine\ORM\Mapping as ORM;

/**
 * Base de conhecimento
 *
 * @ORM\Entity
 * @ORM\Table(name="knowledgeBases")
 */
class KnowledgeBase implements Host {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * Nome da base de conhecimebto
     *
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * Conteúdo do arquivo
     *
     * @var string
     *
     * @ORM\Column(type="blob", nullable=true)
     */
    private $data;


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

    public function getData() {
        return $this->data;
    }

    public function setData($data) {
        $this->data = $data;
        return $this;
    }
}