<?php

namespace DDS\Entities\Traits;


use DDS\Entities\Project\SETool;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

trait SEToolsTrait {

    /**
     * Ferramentas de engenharia de softwares que estão sendo utilizadas pelo colaborador.
     *
     * @var SETool[] | ArrayCollection
     * @ORM\ManyToMany(targetEntity="DDS\Entities\Project\SETool", cascade={"persist"})
     */
    protected $SETools;

    public function addSETool(SETool $SETool) {
        $this->init();
        $this->SETools->add($SETool);
        return $this;
    }

    public function listSETools() {
        $this->init();
        return $this->SETools;
    }

    private function init() {
        if (empty($this->SETools)) {
            $this->SETools = new ArrayCollection();
        }
    }
}