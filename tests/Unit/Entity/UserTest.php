<?php

namespace App\Tests\Unit\Entity;

use PHPUnit\Framework\TestCase;
use App\Entity\User;

/**
 * This clas tests various methods of the User entity
 *
 * @cover User
 * @author calmacil
 */
class UserTest extends TestCase
{
    /**
     * Checks if a User has the proper roles according to it's $isAdmin property
     *
     * @return void
     */
    public function testGetRole(): void
    {
        $u = new User;
        $u->setIsAdmin(false);
        $this->assertContains('ROLE_USER', $u->getRoles());
        $this->assertNotContains('ROLE_ADMIN', $u->getRoles());

        $u->setIsAdmin(true);
        $this->assertContains('ROLE_USER', $u->getRoles());
        $this->assertContains('ROLE_ADMIN', $u->getRoles());
    }

    /**
     * Checks if the standard setters and getters work correctly
     *
     * @return void
     */
    public function testGettersSetters(): void
    {
        $u = new User;
        $this->assertNotNull($u->getCreatedAt());

        $u->setUsername("john.dee@alchemy.com");
        $this->assertEquals("john.dee@alchemy.com", $u->getUsername());
        $this->assertEquals("john.dee@alchemy.com", $u->getUserIdentifier());

        $u->setFirstName("John");
        $this->assertEquals("John", $u->getFirstName());

        $u->setLastName("Dee");
        $this->assertEquals("Dee", $u->getLastName());

        $dt = new \DateTimeImmutable;
        $u->setCreatedAt($dt);
        $this->assertEquals($dt, $u->getCreatedAt());

        $dt_update = new \DateTimeImmutable;
        $u->setUpdatedAt($dt_update);
        $this->assertEquals($dt_update, $u->getUpdatedAt());

        $dt_del = new \DateTimeImmutable;
        $u->setDeletedAt($dt_del);
        $this->assertEquals($dt_del, $u->getDeletedAt());

        $u->setIsAdmin(true);
        $this->assertTrue($u->getIsAdmin());

        $u->setPassword("TOTO");
        $this->assertEquals("TOTO", $u->getPassword());
    }
}
