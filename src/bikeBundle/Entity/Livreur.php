<?php

namespace bikeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Livreur
 *
 * @ORM\Table(name="livreur")
 * @ORM\Entity(repositoryClass="bikeBundle\Repository\LivreurRepository")
 */
class Livreur extends BaseUser
{

    /**
     * @ORM\OneToMany(targetEntity="Livraison", mappedBy="livreur")
     */
    private $livraison;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="liv_nom", type="string", length=255)
     */
    private $livNom;

    /**
     * @var string
     *
     * @ORM\Column(name="liv_prenom", type="string", length=255)
     */
    private $livPrenom;


    /**
     * @var int
     *
     * @ORM\Column(name="liv_tel", type="integer")
     */
    private $livTel;

    /**
     * @var bool
     *
     * @ORM\Column(name="liv_dispo", type="boolean",options={"default":true})
     */
    private $livDispo;

    /**
     * @var int
     *
     * @ORM\Column(name="nbrlivraison_parjour", type="integer",options={"default":0})
     */
    private $nbrlivraisonParjour;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set livNom
     *
     * @param string $livNom
     *
     * @return Livreur
     */
    public function setLivNom($livNom)
    {
        $this->livNom = $livNom;

        return $this;
    }

    /**
     * Get livNom
     *
     * @return string
     */
    public function getLivNom()
    {
        return $this->livNom;
    }

    /**
     * Set livPrenom
     *
     * @param string $livPrenom
     *
     * @return Livreur
     */
    public function setLivPrenom($livPrenom)
    {
        $this->livPrenom = $livPrenom;

        return $this;
    }

    /**
     * Get livPrenom
     *
     * @return string
     */
    public function getLivPrenom()
    {
        return $this->livPrenom;
    }





    /**
     * Set livTel
     *
     * @param integer $livTel
     *
     * @return Livreur
     */
    public function setLivTel($livTel)
    {
        $this->livTel = $livTel;

        return $this;
    }

    /**
     * Get livTel
     *
     * @return int
     */
    public function getLivTel()
    {
        return $this->livTel;
    }

    /**
     * Set livDispo
     *
     * @param boolean $livDispo
     *
     * @return Livreur
     */
    public function setLivDispo($livDispo)
    {
        $this->livDispo = $livDispo;

        return $this;
    }

    /**
     * Get livDispo
     *
     * @return bool
     */
    public function getLivDispo()
    {
        return $this->livDispo;
    }

    /**
     * Set nbrlivraisonParjour
     *
     * @param integer $nbrlivraisonParjour
     *
     * @return Livreur
     */
    public function setNbrlivraisonParjour($nbrlivraisonParjour)
    {
        $this->nbrlivraisonParjour = $nbrlivraisonParjour;

        return $this;
    }

    /**
     * Get nbrlivraisonParjour
     *
     * @return int
     */
    public function getNbrlivraisonParjour()
    {
        return $this->nbrlivraisonParjour;
    }

    public function __construct()
    {
        $this->livraison = new ArrayCollection();
        parent::__construct();
    }

    /**
     * @return ArrayCollection
     */
    public function getLivraison()
    {
        return $this->livraison;
    }

    /**
     * @param ArrayCollection $livraison
     */
    public function setLivraison($livraison)
    {
        $this->livraison = $livraison;
    }


}

