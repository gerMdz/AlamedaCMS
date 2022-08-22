<?php

namespace App\Test\Controller;

use App\Entity\SectionImage;
use App\Repository\SectionImageRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SectionImageControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private SectionImageRepository $repository;
    private string $path = '/section/image/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(SectionImage::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('SectionImage index');

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
            'section_image[nOrder]' => 'Testing',
            'section_image[isPrincipal]' => 'Testing',
            'section_image[isUsable]' => 'Testing',
            'section_image[filter]' => 'Testing',
            'section_image[createdAt]' => 'Testing',
            'section_image[updatedAt]' => 'Testing',
            'section_image[sectionId]' => 'Testing',
            'section_image[imageId]' => 'Testing',
        ]);

        self::assertResponseRedirects('/section/image/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new SectionImage();
        $fixture->setNOrder('My Title');
        $fixture->setIsPrincipal('My Title');
        $fixture->setIsUsable('My Title');
        $fixture->setFilter('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setSectionId('My Title');
        $fixture->setImageId('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('SectionImage');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new SectionImage();
        $fixture->setNOrder('My Title');
        $fixture->setIsPrincipal('My Title');
        $fixture->setIsUsable('My Title');
        $fixture->setFilter('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setSectionId('My Title');
        $fixture->setImageId('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'section_image[nOrder]' => 'Something New',
            'section_image[isPrincipal]' => 'Something New',
            'section_image[isUsable]' => 'Something New',
            'section_image[filter]' => 'Something New',
            'section_image[createdAt]' => 'Something New',
            'section_image[updatedAt]' => 'Something New',
            'section_image[sectionId]' => 'Something New',
            'section_image[imageId]' => 'Something New',
        ]);

        self::assertResponseRedirects('/section/image/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNOrder());
        self::assertSame('Something New', $fixture[0]->getIsPrincipal());
        self::assertSame('Something New', $fixture[0]->getIsUsable());
        self::assertSame('Something New', $fixture[0]->getFilter());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getSectionId());
        self::assertSame('Something New', $fixture[0]->getImageId());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new SectionImage();
        $fixture->setNOrder('My Title');
        $fixture->setIsPrincipal('My Title');
        $fixture->setIsUsable('My Title');
        $fixture->setFilter('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setSectionId('My Title');
        $fixture->setImageId('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/section/image/');
    }
}
