<?php

namespace bikeBundle\Entity;

//use AppBundle\Entity\Notification;
use Doctrine\ORM\Mapping as ORM;
//use SBC\NotificationsBundle\Builder\NotificationBuilder;
//use SBC\NotificationsBundle\Model\NotifiableInterface;

/**
 * Livraison
 *
 * @ORM\Table(name="livraison")
 * @ORM\Entity(repositoryClass="bikeBundle\Repository\LivraisonRepository")
 */
class Livraison
{
    /**
     * @ORM\ManyToOne(targetEntity="Livreur")
     * *@ORM\JoinColumn(name="livreur_id",referencedColumnName="id")
     * @ORM\JoinColumn(nullable=false)
     */
    private $livreur;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="livraison_adresse", type="string", length=255)
     */
    private $livraisonAdresse;

    /**
     * @var int
     *
     * @ORM\Column(name="livreur_id", type="integer")
     */
    private $livreurId;

    /**
     * @var string
     *
     * @ORM\Column(name="livraison_produits", type="string", length=255)
     */
    private $livraisonProduits;

    /**
     * @var float
     *
     * @ORM\Column(name="montant_total", type="float")
     */
    private $montantTotal;



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
     * Set livreurId
     *
     * @param integer $livreurId
     *
     * @return Livraison
     */
    public function setLivreurId($livreurId)
    {
        $this->livreurId = $livreurId;

        return $this;
    }

    /**
     * Get livreurId
     *
     * @return int
     */
    public function getLivreurId()
    {
        return $this->livreurId;
    }

    /**
     * Set livraisonProduits
     *
     * @param string $livraisonProduits
     *
     * @return Livraison
     */
    public function setLivraisonProduits($livraisonProduits)
    {
        $this->livraisonProduits = $livraisonProduits;

        return $this;
    }

    /**
     * Get livraisonProduits
     *
     * @return string
     */
    public function getLivraisonProduits()
    {
        return $this->livraisonProduits;
    }

    /**
     * Set montantTotal
     *
     * @param float $montantTotal
     *
     * @return Livraison
     */
    public function setMontantTotal($montantTotal)
    {
        $this->montantTotal = $montantTotal;

        return $this;
    }

    /**
     * Get montantTotal
     *
     * @return float
     */
    public function getMontantTotal()
    {
        return $this->montantTotal;
    }

    /**
     * @return mixed
     */
    public function getLivreur()
    {
        return $this->livreur;
    }

    /**
     * @param mixed $livreur
     */
    public function setLivreur($livreur)
    {
        $this->livreur = $livreur;
    }

    /**
     * @return string
     */
    public function getLivraisonAdresse()
    {
        return $this->livraisonAdresse;
    }

    /**
     * @param string $livraisonAdresse
     */
    public function setLivraisonAdresse($livraisonAdresse)
    {
        $this->livraisonAdresse = $livraisonAdresse;
    }






}

