<?php

namespace AnomaliesBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Risklevel
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Risklevel
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="risklevel", type="string", length=255, options={"collation":"utf8_general_ci"}, unique=true)
     */
    private $risklevel;

    /**
     * @var integer
     *
     * @ORM\Column(name="enabled", type="integer")
     */
    private $enabled;


    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set risklevel
     *
     * @param string $risklevel
     *
     * @return Risklevel
     */
    public function setRisklevel($risklevel)
    {
        $this->risklevel = $risklevel;

        return $this;
    }

    /**
     * Get risklevel
     *
     * @return string
     */
    public function getRisklevel()
    {
        return $this->risklevel;
    }

    /**
     * Set enabled
     *
     * @param integer $enabled
     *
     * @return Risklevel
     */
    public function setEnabled($enabled)
    {
        $this->enabled = $enabled;

        return $this;
    }

    /**
     * Get enabled
     *
     * @return integer
     */
    public function getEnabled()
    {
        return $this->enabled;
    }
}

