<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Aktoriai
 *
 * @ORM\Table(name="Aktoriai")
 * @ORM\Entity
 */
class Aktoriai
{
    /**
     * @var string|null
     *
     * @ORM\Column(name="vardas", type="string", length=100, nullable=true)
     * @Assert\NotBlank(
     *  message = "Choose a valid genre."
     * )
     *  @Assert\Regex(pattern="/^[A-Z][a-z]+$/", message="Your name cannot contain a number")
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
     * @var \DateTime|null
     *
     * @ORM\Column(name="gim_data", type="date", nullable=true)
     * @Assert\NotBlank
     */
    private $gimData;

    /**
     * @var int
     *
     * @ORM\Column(name="id_Aktorius", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idAktorius;

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

    public function getGimData(): ?\DateTimeInterface
    {
        return $this->gimData;
    }

    public function setGimData(?\DateTimeInterface $gimData): self
    {
        $this->gimData = $gimData;

        return $this;
    }

    public function getIdAktorius(): ?int
    {
        return $this->idAktorius;
    }

}
