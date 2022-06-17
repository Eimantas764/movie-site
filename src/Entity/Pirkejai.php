<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Pirkejai
 *
 * @ORM\Table(name="Pirkejai")
 * @ORM\Entity
 */
class Pirkejai
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
     * @ORM\Column(name="vardas", type="string", length=100, nullable=true)
     * @Assert\NotBlank
     * @Assert\Regex(pattern="/^[A-Z][a-z]+$/", message="Your name cannot contain a number")
     */
    private $vardas;

    /**
     * @var string|null
     *
     * @ORM\Column(name="pavarde", type="string", length=100, nullable=true)
     * @Assert\NotBlank
     * @Assert\Regex(pattern="/^[A-Z][a-z]+$/", message="Your name cannot contain a number")
     */
    private $pavarde;

    /**
     * @var string|null
     *
     * @ORM\Column(name="tel_nr", type="string", length=20, nullable=true)
     * @Assert\NotBlank
     * @Assert\Regex(pattern="/^[0-9]+$/", message="Your name cannot contain a number")
     */
    private $telNr;

    /**
     * @var string|null
     *
     * @ORM\Column(name="el_pastas", type="string", length=100, nullable=true)
     * @Assert\NotBlank
     * @Assert\Email(message="Netinkamas vartotojo elektroninis paštas")
     */
    private $elPastas;

     /**
     * @var string|null
     *
     * @ORM\Column(name="adresas", type="string", length=100, nullable=true)
     * @Assert\NotBlank
     */
    private $adresas;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getVardas(): ?string
    {
        return $this->vardas;
    }

    public function setVardas(?string $vardas): self
    {
        $this->vardas = $vardas;

        return $this;
    }

    public function getPavarde(): ?string
    {
        return $this->pavarde;
    }

    public function setPavarde(?string $pavarde): self
    {
        $this->pavarde = $pavarde;

        return $this;
    }

    public function getTelNr(): ?string
    {
        return $this->telNr;
    }

    public function setTelNr(?string $telNr): self
    {
        $this->telNr = $telNr;

        return $this;
    }

    public function getElPastas(): ?string
    {
        return $this->elPastas;
    }

    public function setElPastas(?string $elPastas): self
    {
        $this->elPastas = $elPastas;

        return $this;
    }


    public function getPilnasVardas() : ?string
    {
        return $this->vardas + ' ' + $this->pavarde;
    }

    public function getAdresas(): ?string
    {
        return $this->adresas;
    }

    public function setAdresas(?string $adresas): self
    {
        $this->adresas = $adresas;

        return $this;
    }

}
