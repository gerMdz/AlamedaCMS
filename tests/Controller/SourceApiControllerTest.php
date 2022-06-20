<?php

namespace App\Test\Controller;

use App\Entity\SourceApi;
use App\Repository\SourceApiRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class SourceApiControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private SourceApiRepository $repository;
    private string $path = '/source/api/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(SourceApi::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('SourceApi index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'source_api[identifier]' => 'Testing',
            'source_api[base_uri]' => 'Testing',
            'source_api[auth_basic]' => 'Testing',
            'source_api[auth_bearer]' => 'Testing',
            'source_api[auth_ntlm]' => 'Testing',
            'source_api[base_auth]' => 'Testing',
            'source_api[auth_username]' => 'Testing',
            'source_api[auth_pass]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new SourceApi();
        $fixture->setIdentifier('My Title');
        $fixture->setBase_uri('My Title');
        $fixture->setAuth_basic('My Title');
        $fixture->setAuth_bearer('My Title');
        $fixture->setAuth_ntlm('My Title');
        $fixture->setBase_auth('My Title');
        $fixture->setAuth_username('My Title');
        $fixture->setAuth_pass('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('SourceApi');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new SourceApi();
        $fixture->setIdentifier('My Title');
        $fixture->setBase_uri('My Title');
        $fixture->setAuth_basic('My Title');
        $fixture->setAuth_bearer('My Title');
        $fixture->setAuth_ntlm('My Title');
        $fixture->setBase_auth('My Title');
        $fixture->setAuth_username('My Title');
        $fixture->setAuth_pass('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'source_api[identifier]' => 'Something New',
            'source_api[base_uri]' => 'Something New',
            'source_api[auth_basic]' => 'Something New',
            'source_api[auth_bearer]' => 'Something New',
            'source_api[auth_ntlm]' => 'Something New',
            'source_api[base_auth]' => 'Something New',
            'source_api[auth_username]' => 'Something New',
            'source_api[auth_pass]' => 'Something New',
        ]);

        self::assertResponseRedirects('/source/api/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getIdentifier());
        self::assertSame('Something New', $fixture[0]->getBase_uri());
        self::assertSame('Something New', $fixture[0]->getAuth_basic());
        self::assertSame('Something New', $fixture[0]->getAuth_bearer());
        self::assertSame('Something New', $fixture[0]->getAuth_ntlm());
        self::assertSame('Something New', $fixture[0]->getBase_auth());
        self::assertSame('Something New', $fixture[0]->getAuth_username());
        self::assertSame('Something New', $fixture[0]->getAuth_pass());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new SourceApi();
        $fixture->setIdentifier('My Title');
        $fixture->setBase_uri('My Title');
        $fixture->setAuth_basic('My Title');
        $fixture->setAuth_bearer('My Title');
        $fixture->setAuth_ntlm('My Title');
        $fixture->setBase_auth('My Title');
        $fixture->setAuth_username('My Title');
        $fixture->setAuth_pass('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/source/api/');
        self::assertSame(0, $this->repository->count([]));
    }
}
