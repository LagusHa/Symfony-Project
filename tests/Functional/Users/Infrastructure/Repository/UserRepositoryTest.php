<?php

namespace App\Tests\Functional\Users\Infrastructure\Repository;

use App\Tests\Resource\Fixture\UserFixture;
use App\Users\Domain\Entity\User;
use App\Users\Domain\Factory\UserFactory;
use App\Users\Infrastructure\Repository\UserRepository;
use Faker\Factory;
use Faker\Generator;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;
use Liip\TestFixturesBundle\Services\DatabaseTools\AbstractDatabaseTool;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserRepositoryTest extends WebTestCase
{
    private Generator $faker;
    private UserRepository $repository;
    private AbstractDatabaseTool $databaseTool;

    public function setUp(): void
    {
        parent::setUp();
        $this->faker = Factory::create();
        $this->repository = static::getContainer()->get(UserRepository::class);
        $this->databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
    }

    public function testUserAddedSuccessfully(): void
    {
        $email = $this->faker->email();
        $password = $this->faker->password();
        $user = (new UserFactory())->create($email, $password);

        $this->repository->add($user);

        $existingUser = $this->repository->findByUlid($user->getUlid());
        $this->assertEquals($user->getUlid(), $existingUser->getUlid());
    }

    public function testUserFoundSuccessfully(): void
    {
        $executor = $this->databaseTool->loadFixtures([UserFixture::class]);
        $user = $executor->getReferenceRepository()->getReference(UserFixture::REFERENCE);

        /** @var User $user */
        $existingUser = $this->repository->findByUlid($user->getUlid());

        $this->assertEquals($user->getUlid(), $existingUser->getUlid());
    }
}
