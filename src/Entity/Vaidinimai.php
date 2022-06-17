<?php

namespace App\Entity;

use App\Repository\VaidinimaiRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="Vaidinimai")
 * @ORM\Entity(repositoryClass=VaidinimaiRepository::class)
 */
class Vaidinimai
{

    /**
     * @var \Filmai
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Filmai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Filmasid", referencedColumnName="id")
     * })
     */
    private $fk_Filmasid;

    /**
     * @var \Aktoriai
     *
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="Aktoriai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Aktoriusid", referencedColumnName="id_Aktorius")
     * })
     */
    private $fk_Aktoriusid;

    public function getFkFilmasid(): ?Filmai
    {
        return $this->fk_Filmasid;
    }

    public function setFkFilmasid(?Filmai $fk_Filmasid): self
    {
        $this->fk_Filmasid = $fk_Filmasid;

        return $this;
    }

    public function getFkAktoriusid(): ?Aktoriai
    {
        return $this->fk_Aktoriusid;
    }

    public function setFkAktoriusid(?Aktoriai $fk_Aktoriusid): self
    {
        $this->fk_Aktoriusid = $fk_Aktoriusid;

        return $this;
    }
}
