<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ApiResource(
 *     attributes={
 *      "security"="is_granted('ROLE_ADMIN')"
 *      },
 *     itemOperations={
 *          "get"={
 *              "normalization_context"={
 *                  "groups"={"marque:get"}
 *              },
 *          },
 *          "delete",
 *          "patch"
 *     }
 * )
 *
 * @ORM\Entity(repositoryClass=MarqueRepository::class)
 */
class Marque
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"marque:get" , "modele:get"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"annonce:get_lite" , "marque:get" , "modele:get"})
     * @Assert\Length(
     *     min=2,
     *     max=25,
     *     minMessage="La Marque doit avoir au moin 3 caractères",
     *     maxMessage="La Marque ne doit pas avoir plus de 10 caractère"
     * )
     */
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Modele::class, mappedBy="marque" , cascade={"remove"})
     * @Groups({"marque:get"})
     */
    private $modeles;

    /**
     * @ORM\Column(type="integer")
     */
    private $idApi;

    public function __construct()
    {
        $this->modeles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection|modele[]
     */
    public function getModeles(): Collection
    {
        return $this->modeles;
    }

    public function addModele(modele $modele): self
    {
        if (!$this->modeles->contains($modele)) {
            $this->modeles[] = $modele;
            $modele->setMarque($this);
        }

        return $this;
    }

    public function removeModele(modele $modele): self
    {
        if ($this->modeles->removeElement($modele)) {
            // set the owning side to null (unless already changed)
            if ($modele->getMarque() === $this) {
                $modele->setMarque(null);
            }
        }

        return $this;
    }

    public function getIdApi(): ?int
    {
        return $this->idApi;
    }

    public function setIdApi(int $idApi): self
    {
        $this->idApi = $idApi;

        return $this;
    }
}
