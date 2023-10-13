<?php
namespace App\Tests\Security;
use App\Entity\User;
use App\Security\GithubUserProvider;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use JMS\Serializer\Exception\LogicException;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasher;
use Symfony\Component\Serializer\Serializer;


class GithubUserProviderTest extends TestCase {
    private $client;
    private $response;
    private $streamedResponse;
    public function setUp(): void
    {
        parent::setUp();
        $this->client = $this
            ->getMockBuilder('GuzzleHttp\Client')
            ->disableOriginalConstructor()
            ->getMock()
        ;

        $this->response = $this
            ->getMockBuilder('Psr\Http\Message\ResponseInterface')
            ->getMock()
        ;
        $this->streamedResponse = $this
            ->getMockBuilder('Psr\Http\Message\StreamInterface')
            ->getMock()
        ;
    }

    public function testLoadUser() {


        $this->client
            ->method('get')
            ->willReturn($this->response)
        ;

        $this->response
            ->method('getBody')
            ->willReturn($this->streamedResponse)
        ;

        $this->streamedResponse
            ->method('getContents')
            ->willReturn('{"password":"Kandji","email":"kandji.k66@gmail.com"}');

        $object = new GithubUserProvider($this->client);
        $this->assertSame("App\Entity\User",get_class($object->loadUserByUsername('test')));


    }

    public function testLoadUserException() {
        $this->client
            ->method('get')
            ->willReturn($this->response)
        ;

        $this->response
            ->method('getBody')
            ->willReturn($this->streamedResponse)
        ;

        $this->streamedResponse
            ->method('getContents')
            ->willReturn('{}');

        $object = new GithubUserProvider($this->client);
        $this->expectException('LogicException');
       $object->loadUserByUsername('test');


    }

    public function tearDown(): void
    {
        parent::tearDown();

    }
}