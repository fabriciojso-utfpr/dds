<?php

namespace DDS\Entities\Site;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
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



}