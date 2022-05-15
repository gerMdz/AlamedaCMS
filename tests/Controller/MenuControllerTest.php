<?php

namespace App\Test\Controller;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MenuControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private MenuRepository $repository;
    private string $path = '/menu/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(Menu::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Menu index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'menu[Nombre]' => 'Testing',
            'menu[identificador]' => 'Testing',
            'menu[createdAt]' => 'Testing',
            'menu[updatedAt]' => 'Testing',
            'menu[cssClass]' => 'Testing',
            'menu[itemMenus]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new Menu();
        $fixture->setNombre('My Title');
        $fixture->setIdentificador('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCssClass('My Title');
        $fixture->setItemMenus('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('Menu');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new Menu();
        $fixture->setNombre('My Title');
        $fixture->setIdentificador('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCssClass('My Title');
        $fixture->setItemMenus('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'menu[Nombre]' => 'Something New',
            'menu[identificador]' => 'Something New',
            'menu[createdAt]' => 'Something New',
            'menu[updatedAt]' => 'Something New',
            'menu[cssClass]' => 'Something New',
            'menu[itemMenus]' => 'Something New',
        ]);

        self::assertResponseRedirects('/menu/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getNombre());
        self::assertSame('Something New', $fixture[0]->getIdentificador());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getCssClass());
        self::assertSame('Something New', $fixture[0]->getItemMenus());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new Menu();
        $fixture->setNombre('My Title');
        $fixture->setIdentificador('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCssClass('My Title');
        $fixture->setItemMenus('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/menu/');
        self::assertSame(0, $this->repository->count([]));
    }
}
