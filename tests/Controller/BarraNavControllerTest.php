<?php

namespace App\Test\Controller;

use App\Entity\BarraNav;
use App\Repository\BarraNavRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class BarraNavControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private BarraNavRepository $repository;
    private string $path = '/barra/nav/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(BarraNav::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('BarraNav index');

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
            'barra_nav[title]' => 'Testing',
            'barra_nav[identifier]' => 'Testing',
            'barra_nav[content]' => 'Testing',
            'barra_nav[imageFilename]' => 'Testing',
            'barra_nav[description]' => 'Testing',
            'barra_nav[isIndex]' => 'Testing',
            'barra_nav[createdAt]' => 'Testing',
            'barra_nav[updatedAt]' => 'Testing',
            'barra_nav[cssClass]' => 'Testing',
            'barra_nav[cssStyle]' => 'Testing',
            'barra_nav[author]' => 'Testing',
            'barra_nav[modelTemplate]' => 'Testing',
        ]);

        self::assertResponseRedirects('/barra/nav/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new BarraNav();
        $fixture->setTitle('My Title');
        $fixture->setIdentifier('My Title');
        $fixture->setContent('My Title');
        $fixture->setImageFilename('My Title');
        $fixture->setDescription('My Title');
        $fixture->setIsIndex('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCssClass('My Title');
        $fixture->setCssStyle('My Title');
        $fixture->setAuthor('My Title');
        $fixture->setModelTemplate('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('BarraNav');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new BarraNav();
        $fixture->setTitle('My Title');
        $fixture->setIdentifier('My Title');
        $fixture->setContent('My Title');
        $fixture->setImageFilename('My Title');
        $fixture->setDescription('My Title');
        $fixture->setIsIndex('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCssClass('My Title');
        $fixture->setCssStyle('My Title');
        $fixture->setAuthor('My Title');
        $fixture->setModelTemplate('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'barra_nav[title]' => 'Something New',
            'barra_nav[identifier]' => 'Something New',
            'barra_nav[content]' => 'Something New',
            'barra_nav[imageFilename]' => 'Something New',
            'barra_nav[description]' => 'Something New',
            'barra_nav[isIndex]' => 'Something New',
            'barra_nav[createdAt]' => 'Something New',
            'barra_nav[updatedAt]' => 'Something New',
            'barra_nav[cssClass]' => 'Something New',
            'barra_nav[cssStyle]' => 'Something New',
            'barra_nav[author]' => 'Something New',
            'barra_nav[modelTemplate]' => 'Something New',
        ]);

        self::assertResponseRedirects('/barra/nav/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getTitle());
        self::assertSame('Something New', $fixture[0]->getIdentifier());
        self::assertSame('Something New', $fixture[0]->getContent());
        self::assertSame('Something New', $fixture[0]->getImageFilename());
        self::assertSame('Something New', $fixture[0]->getDescription());
        self::assertSame('Something New', $fixture[0]->getIsIndex());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getCssClass());
        self::assertSame('Something New', $fixture[0]->getCssStyle());
        self::assertSame('Something New', $fixture[0]->getAuthor());
        self::assertSame('Something New', $fixture[0]->getModelTemplate());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new BarraNav();
        $fixture->setTitle('My Title');
        $fixture->setIdentifier('My Title');
        $fixture->setContent('My Title');
        $fixture->setImageFilename('My Title');
        $fixture->setDescription('My Title');
        $fixture->setIsIndex('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCssClass('My Title');
        $fixture->setCssStyle('My Title');
        $fixture->setAuthor('My Title');
        $fixture->setModelTemplate('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/barra/nav/');
    }
}
