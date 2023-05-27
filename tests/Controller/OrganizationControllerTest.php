<?php

namespace App\Test\Controller;

use App\Entity\Organization;
use App\Repository\OrganizationRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class OrganizationControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private OrganizationRepository $repository;
    private string $path = '/organization/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Organization::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Organization index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $originalNumObjectsInRepository = count($this->repository->findAll());

        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'organization[name]' => 'Testing',
            'organization[address1]' => 'Testing',
            'organization[address2]' => 'Testing',
            'organization[identifier]' => 'Testing',
            'organization[responsable]' => 'Testing',
            'organization[owner]' => 'Testing',
            'organization[email]' => 'Testing',
            'organization[isActive]' => 'Testing',
            'organization[contact]' => 'Testing',
        ]);

        self::assertResponseRedirects('/organization/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Organization();
        $fixture->setName('My Title');
        $fixture->setAddress1('My Title');
        $fixture->setAddress2('My Title');
        $fixture->setIdentifier('My Title');
        $fixture->setResponsable('My Title');
        $fixture->setOwner('My Title');
        $fixture->setEmail('My Title');
        $fixture->setIsActive('My Title');
        $fixture->setContact('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Organization');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Organization();
        $fixture->setName('My Title');
        $fixture->setAddress1('My Title');
        $fixture->setAddress2('My Title');
        $fixture->setIdentifier('My Title');
        $fixture->setResponsable('My Title');
        $fixture->setOwner('My Title');
        $fixture->setEmail('My Title');
        $fixture->setIsActive('My Title');
        $fixture->setContact('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'organization[name]' => 'Something New',
            'organization[address1]' => 'Something New',
            'organization[address2]' => 'Something New',
            'organization[identifier]' => 'Something New',
            'organization[responsable]' => 'Something New',
            'organization[owner]' => 'Something New',
            'organization[email]' => 'Something New',
            'organization[isActive]' => 'Something New',
            'organization[contact]' => 'Something New',
        ]);

        self::assertResponseRedirects('/organization/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getAddress1());
        self::assertSame('Something New', $fixture[0]->getAddress2());
        self::assertSame('Something New', $fixture[0]->getIdentifier());
        self::assertSame('Something New', $fixture[0]->getResponsable());
        self::assertSame('Something New', $fixture[0]->getOwner());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getIsActive());
        self::assertSame('Something New', $fixture[0]->getContact());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new Organization();
        $fixture->setName('My Title');
        $fixture->setAddress1('My Title');
        $fixture->setAddress2('My Title');
        $fixture->setIdentifier('My Title');
        $fixture->setResponsable('My Title');
        $fixture->setOwner('My Title');
        $fixture->setEmail('My Title');
        $fixture->setIsActive('My Title');
        $fixture->setContact('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/organization/');
    }
}
