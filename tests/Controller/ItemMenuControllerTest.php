<?php

namespace App\Test\Controller;

use App\Entity\ItemMenu;
use App\Repository\ItemMenuRepository;
use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ItemMenuControllerTest extends WebTestCase
{
    private KernelBrowser $client;
    private ItemMenuRepository $repository;
    private string $path = '/item/menu/';

    protected function setUp(): void
    {
        $this->client = static::createClient();
        $this->repository = (static::getContainer()->get('doctrine'))->getRepository(ItemMenu::class);

        foreach ($this->repository->findAll() as $object) {
            $this->repository->remove($object, true);
        }
    }

    public function testIndex(): void
    {
        $crawler = $this->client->request('GET', $this->path);

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ItemMenu index');

        // Use the $crawler to perform additional assertions e.g.
        // self::assertSame('Some text on the page', $crawler->filter('.p')->first());
    }

    public function testNew(): void
    {
        $this->markTestIncomplete();
        $this->client->request('GET', sprintf('%snew', $this->path));

        self::assertResponseStatusCodeSame(200);

        $this->client->submitForm('Save', [
            'item_menu[role]' => 'Testing',
            'item_menu[label]' => 'Testing',
            'item_menu[badge]' => 'Testing',
            'item_menu[icon]' => 'Testing',
            'item_menu[isExterno]' => 'Testing',
            'item_menu[isActivo]' => 'Testing',
            'item_menu[pathLibre]' => 'Testing',
            'item_menu[orderitem]' => 'Testing',
            'item_menu[createdAt]' => 'Testing',
            'item_menu[updatedAt]' => 'Testing',
            'item_menu[cssClass]' => 'Testing',
            'item_menu[identificador]' => 'Testing',
            'item_menu[parent]' => 'Testing',
            'item_menu[pathInterno]' => 'Testing',
            'item_menu[menu]' => 'Testing',
        ]);

        self::assertResponseRedirects('/sweet/food/');

        self::assertSame(1, $this->repository->count([]));
    }

    public function testShow(): void
    {
        $this->markTestIncomplete();
        $fixture = new ItemMenu();
        $fixture->setRole('My Title');
        $fixture->setLabel('My Title');
        $fixture->setBadge('My Title');
        $fixture->setIcon('My Title');
        $fixture->setIsExterno('My Title');
        $fixture->setIsActivo('My Title');
        $fixture->setPathLibre('My Title');
        $fixture->setOrderitem('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCssClass('My Title');
        $fixture->setIdentificador('My Title');
        $fixture->setParent('My Title');
        $fixture->setPathInterno('My Title');
        $fixture->setMenu('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));

        self::assertResponseStatusCodeSame(200);
        self::assertPageTitleContains('ItemMenu');

        // Use assertions to check that the properties are properly displayed.
    }

    public function testEdit(): void
    {
        $this->markTestIncomplete();
        $fixture = new ItemMenu();
        $fixture->setRole('My Title');
        $fixture->setLabel('My Title');
        $fixture->setBadge('My Title');
        $fixture->setIcon('My Title');
        $fixture->setIsExterno('My Title');
        $fixture->setIsActivo('My Title');
        $fixture->setPathLibre('My Title');
        $fixture->setOrderitem('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCssClass('My Title');
        $fixture->setIdentificador('My Title');
        $fixture->setParent('My Title');
        $fixture->setPathInterno('My Title');
        $fixture->setMenu('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s/edit', $this->path, $fixture->getId()));

        $this->client->submitForm('Update', [
            'item_menu[role]' => 'Something New',
            'item_menu[label]' => 'Something New',
            'item_menu[badge]' => 'Something New',
            'item_menu[icon]' => 'Something New',
            'item_menu[isExterno]' => 'Something New',
            'item_menu[isActivo]' => 'Something New',
            'item_menu[pathLibre]' => 'Something New',
            'item_menu[orderitem]' => 'Something New',
            'item_menu[createdAt]' => 'Something New',
            'item_menu[updatedAt]' => 'Something New',
            'item_menu[cssClass]' => 'Something New',
            'item_menu[identificador]' => 'Something New',
            'item_menu[parent]' => 'Something New',
            'item_menu[pathInterno]' => 'Something New',
            'item_menu[menu]' => 'Something New',
        ]);

        self::assertResponseRedirects('/item/menu/');

        $fixture = $this->repository->findAll();

        self::assertSame('Something New', $fixture[0]->getRole());
        self::assertSame('Something New', $fixture[0]->getLabel());
        self::assertSame('Something New', $fixture[0]->getBadge());
        self::assertSame('Something New', $fixture[0]->getIcon());
        self::assertSame('Something New', $fixture[0]->getIsExterno());
        self::assertSame('Something New', $fixture[0]->getIsActivo());
        self::assertSame('Something New', $fixture[0]->getPathLibre());
        self::assertSame('Something New', $fixture[0]->getOrderitem());
        self::assertSame('Something New', $fixture[0]->getCreatedAt());
        self::assertSame('Something New', $fixture[0]->getUpdatedAt());
        self::assertSame('Something New', $fixture[0]->getCssClass());
        self::assertSame('Something New', $fixture[0]->getIdentificador());
        self::assertSame('Something New', $fixture[0]->getParent());
        self::assertSame('Something New', $fixture[0]->getPathInterno());
        self::assertSame('Something New', $fixture[0]->getMenu());
    }

    public function testRemove(): void
    {
        $this->markTestIncomplete();
        $fixture = new ItemMenu();
        $fixture->setRole('My Title');
        $fixture->setLabel('My Title');
        $fixture->setBadge('My Title');
        $fixture->setIcon('My Title');
        $fixture->setIsExterno('My Title');
        $fixture->setIsActivo('My Title');
        $fixture->setPathLibre('My Title');
        $fixture->setOrderitem('My Title');
        $fixture->setCreatedAt('My Title');
        $fixture->setUpdatedAt('My Title');
        $fixture->setCssClass('My Title');
        $fixture->setIdentificador('My Title');
        $fixture->setParent('My Title');
        $fixture->setPathInterno('My Title');
        $fixture->setMenu('My Title');

        $this->repository->add($fixture, true);

        $this->client->request('GET', sprintf('%s%s', $this->path, $fixture->getId()));
        $this->client->submitForm('Delete');

        self::assertResponseRedirects('/item/menu/');
        self::assertSame(0, $this->repository->count([]));
    }
}
