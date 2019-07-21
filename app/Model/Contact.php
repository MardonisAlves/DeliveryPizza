<?php
//namespace App\Model;

use Doctrine\ORM\Mapping\Entity;
use Doctrine\ORM\Mapping\Table;
use Doctrine\ORM\Mapping\Index;
use Doctrine\ORM\Mapping\Id;
use Doctrine\ORM\Mapping\GeneratedValue;
use Doctrine\ORM\Mapping\Column;

/**
* Blog post entity
*
* @Entity
* @Table(indexes={*@Index(name="publication_date_idx",columns="publicationDate")
* })
*/
class Contact
{
    /**
* @var int
*
* @Id
* @GeneratedValue
* @Column(type="integer")
*/
protected $id;

/**
* @var string
*
* @Column(type="string")
*/
protected $name;

/**
* @var string
*
* @Column(type="string")
*/
protected $email;

/**
 * @var string
 * 
 * @Column(type="string")
 * 
 */
protected $telefone;

/**
* @var string
*
* @Column(type="text")
*/
protected $text;


/**
* @var \DateTime
*
* @Column(type="datetime")
*/
protected $publicationDate;

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name.
     *
     * @param string $name
     *
     * @return Contact
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set text.
     *
     * @param string $text
     *
     * @return Contact
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text.
     *
     * @return string
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set publicationDate.
     *
     * @param \DateTime $publicationDate
     *
     * @return Contact
     */
    public function setPublicationDate($publicationDate)
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    /**
     * Get publicationDate.
     *
     * @return \DateTime
     */
    public function getPublicationDate()
    {
        return $this->publicationDate;
    }


    /**
     * Set telefone.
     *
     * @param string $telefone
     *
     * @return Contact
     */
    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;

        return $this;
    }

    /**
     * Get telefone.
     *
     * @return string
     */
    public function getTelefone()
    {
        return $this->telefone;
    }
}
