<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Uzsakymai
 *
 * @ORM\Table(name="Uzsakymai", indexes={@ORM\Index(name="fk_Filmasid", columns={"fk_Filmasid"}), @ORM\Index(name="fk_Pirkejasid", columns={"fk_Pirkejasid"})})
 * @ORM\Entity
 */
class Uzsakymai
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="data", type="date", nullable=true)
     */
    private $data;

    /**
     * @var \Filmai
     *
     * @ORM\ManyToOne(targetEntity="Filmai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Filmasid", referencedColumnName="id")
     * })
     */
    private $fkFilmasid;

    /**
     * @var \Pirkejai
     *
     * @ORM\ManyToOne(targetEntity="Pirkejai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fk_Pirkejasid", referencedColumnName="id")
     * })
     */
    private $fkPirkejasid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getData(): ?\DateTimeInterface
    {
        return $this->data;
    }

    public function setData(?\DateTimeInterface $data): self
    {
        $this->data = $data;

        return $this;
    }

    public function getFkFilmasid(): ?Filmai
    {
        return $this->fkFilmasid;
    }

    public function setFkFilmasid(?Filmai $fkFilmasid): self
    {
        $this->fkFilmasid = $fkFilmasid;

        return $this;
    }

    public function getFkPirkejasid(): ?Pirkejai
    {
        return $this->fkPirkejasid;
    }

    public function setFkPirkejasid(?Pirkejai $fkPirkejasid): self
    {
        $this->fkPirkejasid = $fkPirkejasid;

        return $this;
    }


}