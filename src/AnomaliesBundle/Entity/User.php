<?php

namespace AnomaliesBundle\Entity;


use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @ORM\Table(name="ar_user", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_8D93D64992FC23A8", columns={"username_canonical"}), 
 *                            @ORM\UniqueConstraint(name="UNIQ_8D93D649A0D96FBF", columns={"email_canonical"}), 
 *                            @ORM\UniqueConstraint(name="UNIQ_username", columns={"username"}) })
 * @ORM\Entity
 */
class User extends BaseUser
{
        
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\OneToMany(targetEntity="Documents", mappedBy="user", cascade={"persist"})
     */
    protected $documents;


    /**
     * @var string
     *
     * @ORM\Column(name="matricule", type="string", length=6, options={"collation":"utf8_general_ci"}, nullable=true)
     */
    private $matricule;

    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, options={"collation":"utf8_general_ci"}, nullable=true)
     */
    private $photo;


    /**
     * Set matricule
     *
     * @param string $matricule
     * @return ArUser
     */
    public function setMatricule($matricule)
    {
        $this->matricule = $matricule;

        return $this;
    }

    /**
     * Get matricule
     *
     * @return string 
     */
    public function getMatricule()
    {
        return $this->matricule;
    }

    /**
     * Set photo
     *
     * @param string $photo
     * @return ArUser
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }
    
    public function addRole($role)
    {
        $role = strtoupper($role);
        if ($role === "ROLE_USER_DEFAULT") {
            return $this;
        }

        if (!in_array($role, $this->getRoles(), true)) {
            $this->roles[] = $role;
        }

        return $this;
    }
    
    
    public function getRoles()
    {
        $roles = $this->roles;

        foreach ($this->getGroups() as $group) {
            $roles = array_merge($roles, $group->getRoles());
        }

        // we need to make sure to have at least one role
        $roles[] = "ROLE_USER_DEFAULT";

        return array_unique($roles);
    }
    
    
    
     /**
     * Constructor
     */
    public function __construct()
    {
        $this->documents = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Add document
     *
     * @param \AnomaliesBundle\Entity\Documents $document
     *
     * @return User
     */
    public function addDocument(\AnomaliesBundle\Entity\Documents $document)
    {
        $this->documents[] = $document;

        return $this;
    }

    /**
     * Remove document
     *
     * @param \AnomaliesBundle\Entity\Documents $document
     */
    public function removeDocument(\AnomaliesBundle\Entity\Documents $document)
    {
        $this->documents->removeElement($document);
    }

    /**
     * Get documents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDocuments()
    {
        return $this->documents;
    }
}
