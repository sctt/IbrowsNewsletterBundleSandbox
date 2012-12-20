<?php

namespace Ibrows\NewsletterSandboxBundle\Entity;

use Ibrows\Bundle\NewsletterBundle\Model\User\MandantUserInterface;
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_user")
 */
class User extends BaseUser implements MandantUserInterface
{
	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	protected $mandant;

    /**
     * @return string
     */
    public function getMandant()
	{
		return $this->mandant;
	}
}
