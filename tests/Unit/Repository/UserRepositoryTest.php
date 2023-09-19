<?php

namespace App\Tests\Unit\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;


/**
 * In fact this is a mock
 */
class Dummy implements PasswordAuthenticatedUserInterface
{
    public function getPassword(): ?string
    {
        return "";
    }
}


/**
 * Tests the UserRepository class
 */
class UserRepositoryTest extends KernelTestCase
{
    public function setUp(): void
    {
        self::bootKernel(['debug' => false]);
    }

    /**
     * Tests the password upgrade
     *
     * @todo Fix that, this test isn't complete
     * @return void
     */
    public function testUpgradePassword(): void
    {
        $container = self::getContainer();
        $repo = $container->get(UserRepository::class);
        $password = "randomvalue";

        $this->expectException(UnsupportedUserException::class);
        $repo->upgradePassword(new Dummy, $password);

        $u = $this->createMock(User::class);
        $u->expects(self::once())
            ->method('setPassword')
            ->willSelf();

        $manager = $this->createMock(EntityManagerInterface::class);
        $manager->expects(self::once())
            ->method('save');
        $manager->expects(self::once())
            ->method('flush');

        $repo->upgradePassword($u, $password);
    }
}
