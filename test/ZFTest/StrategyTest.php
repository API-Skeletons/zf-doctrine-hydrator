<?php

namespace ZFTest\Doctrine\Hydrator\Strategy;

use Doctrine\Common\DataFixtures\Loader as BaseLoader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;
use Zend\Http\Request;

class StrategyTest extends AbstractHttpControllerTestCase
{
    public function createDatabase()
    {
        // build test database
        $objectManager = $this->getApplication()->getServiceManager()->get('doctrine.entitymanager.orm_default');
        $schemaTool = new \Doctrine\ORM\Tools\SchemaTool($objectManager);
        $schemaTool->createSchema($objectManager->getMetadataFactory()->getAllMetadata());

        // Run fixtures
        $loader = new BaseLoader($objectManager);
        $purger = new ORMPurger();
        $executor = new ORMExecutor($objectManager, $purger);

        $loader->loadFromDirectory(__DIR__ . '/../module/Db/src/Db/Fixture');
        $executor->execute($loader->getFixtures(), true);

        $objectManager->clear();
    }

    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../TestConfig.php'
        );
        parent::setUp();

        $this->createDatabase();
    }

    public function testTrue()
    {
        $this->getRequest()->getHeaders()->addHeaders(
            array(
                'Accept' => 'application/json',
                'Content-type' => 'application/json',
            )
        );

        $this->getRequest()->setMethod(Request::METHOD_GET);

        $this->dispatch('/artist/1');
        $this->getApplication()->run();
        $body = json_decode($this->getResponse()->getBody(), true);
        $this->assertResponseStatusCode(200);

        $this->assertEquals('Soft Cell', $body['name']);
        $this->assertEquals('1', $body['id']);
        $this->assertEquals('Non-Stop Erotic Cabaret', $body['_embedded']['album'][0]['name']);
        $this->assertEquals('1', $body['_embedded']['album'][0]['id']);
        $this->assertEquals(
            'http:///song?filter%5B0%5D%5Bfield%5D=album&filter%5B0%5D%5Btype%5D=eq&filter%5B0%5D%5Bvalue%5D=1',
            $body['_embedded']['album'][0]['_embedded']['song']['_links']['self']['href']
        );
        $this->assertEquals(1, sizeof($body['_embedded']['album'][0]['_embedded']['artist']));
    }
}



/*
use PHPUnit_Framework_TestCase;
use ZFTest\Doctrine\Hydrator\Bootstrap;

class StrategyTest extends PHPUnit_Framework_TestCase
{
    public function testCollectionLink()
    {
        $serviceManager = Bootstrap::getApplication()->getServiceManager();
        $objectManager = $serviceManager->get('doctrine.entitymanager.orm_default');

        $artist = $objectManager->getRepository('Db\Entity\Artist')->find(1);

        $this->assertEquals('Soft Cell', $artist->getName());
    }
}
*/
