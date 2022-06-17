<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Filmai
 *
 * @ORM\Table(name="Filmai")
 * @ORM\Entity
 */
class Filmai
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
     * @var string|null
     *
     * @ORM\Column(name="pavadinimas", type="string", length=200, nullable=true)
     * @Assert\NotBlank(message = "Pavadinimas negali būti tuščias")
     */
    private $pavadinimas;

    /**
     * @var float
     *
     * @ORM\Column(name="imdb", type="float", precision=10, scale=1, nullable=false)
     * @Assert\Positive(message = "Įvertinimas negali būti neigiamas")
     */
    private $imdb;

    /**
     * @var int|null
     *
     * @ORM\Column(name="metai", type="integer", nullable=true)
     * @Assert\NotBlank(message = "Turi būti įvesti metai")
     * @Assert\Positive(message = "Metai negali būti neigiamas skaičius")
     */
    private $metai;

    /**
     * @var float|null
     *
     * @ORM\Column(name="kaina", type="float", precision=10, scale=0, nullable=true)
     * @Assert\Positive(message = "Kaina negali būti neigiama")
     * @Assert\NotBlank
     */
    private $kaina;

    /**
     * @var string|null
     *
     * @ORM\Column(name="paveikslelis", type="string", length=255, nullable=true)
     */
    private $paveikslelis;

    /**
     * @var string|null
     *
     * @ORM\Column(name="zanras", type="string", length=0, nullable=true)
     */
    private $zanras;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPavadinimas(): ?string
    {
        return $this->pavadinimas;
    }

    public function setPavadinimas(?string $pavadinimas): self
    {
        $this->pavadinimas = $pavadinimas;

        return $this;
    }

    public function getImdb(): ?float
    {
        return $this->imdb;
    }

    public function setImdb(?float $imdb): self
    {
        $this->imdb = $imdb;

        return $this;
    }

    public function getMetai(): ?int
    {
        return $this->metai;
    }

    public function setMetai(?int $metai): self
    {
        $this->metai = $metai;

        return $this;
    }

    public function getKaina(): ?float
    {
        return $this->kaina;
    }

    public function setKaina(?float $kaina): self
    {
        $this->kaina = $kaina;

        return $this;
    }

    public function getPaveikslelis(): ?string
    {
        return $this->paveikslelis;
    }

    public function setPaveikslelis(?string $paveikslelis): self
    {
        $this->paveikslelis = $paveikslelis;

        return $this;
    }

    public function getZanras(): ?string
    {
        return $this->zanras;
    }

    public function setZanras(?string $zanras): self
    {
        $this->zanras = $zanras;

        return $this;
    }

}
