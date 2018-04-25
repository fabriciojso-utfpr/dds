<?php

namespace DDS\Entities\Communication\Content;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class Content {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="string")
     */
    private $type;


    public function __construct($content, $type) {
        $this->content = $content;
        $this->type = $type;
    }

    public function getId() {
        return $this->id;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }

}