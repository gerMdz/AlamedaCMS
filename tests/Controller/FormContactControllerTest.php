<?php

namespace App\Test\Controller;

use App\Entity\FormContact;
use App\Repository\FormContactRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class FormContactControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private FormContactRepository $repository;
    private string $path = '/form/contact/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(FormContact::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('FormContact index');

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
            'form_contact[name]' => 'Testing',
            'form_contact[email]' => 'Testing',
            'form_contact[text]' => 'Testing',
            'form_contact[subject]' => 'Testing',
            'form_contact[createdAt]' => 'Testing',
            'form_contact[updatedAt]' => 'Testing',
        ]);

        self::assertResponseRedirects('/form/contact/');

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new FormContact();
        $fixture->setName('My Title');
        $fixture->setEmail('My Title');
        $fixture->setText('My Title');
        $fixture->setSubject('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('FormContact');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new FormContact();
        $fixture->setName('My Title');
        $fixture->setEmail('My Title');
        $fixture->setText('My Title');
        $fixture->setSubject('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'form_contact[name]' => 'Something New',
            'form_contact[email]' => 'Something New',
            'form_contact[text]' => 'Something New',
            'form_contact[subject]' => 'Something New',
            'form_contact[createdAt]' => 'Something New',
            'form_contact[updatedAt]' => 'Something New',
        ]);

        self::assertResponseRedirects('/form/contact/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getName());
        self::assertSame('Something New', $fixture[0]->getEmail());
        self::assertSame('Something New', $fixture[0]->getText());
        self::assertSame('Something New', $fixture[0]->getSubject());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();

        $originalNumObjectsInRepository = count($this->repository->findAll());

        $fixture = new FormContact();
        $fixture->setName('My Title');
        $fixture->setEmail('My Title');
        $fixture->setText('My Title');
        $fixture->setSubject('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');

        $this->repository->add($fixture, true);

        self::assertSame($originalNumObjectsInRepository + 1, count($this->repository->findAll()));

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertSame($originalNumObjectsInRepository, count($this->repository->findAll()));
        self::assertResponseRedirects('/form/contact/');
    }
}
