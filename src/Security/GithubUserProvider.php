<?php

namespace App\Security;

use App\Entity\User;
use GuzzleHttp\Client;
use Symfony\Component\Serializer\SerializerInterface;
use GuzzleHttp\Exception\GuzzleException;
use JMS\Serializer\Exception\LogicException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;


class GithubUserProvider implements UserProviderInterface
{
    private Client $client;


    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /**
     * @throws GuzzleException
     */
    public function loadUserByUsername(string $username): User
    {
        $response = $this->client->get('https://api.github.com/user?access_token='.$username);
        $result = $response->getBody()->getContents();

        $userData = json_decode($result,  true);

        if (!$userData) {
            throw new LogicException('Did not managed to get your user info from Github.');
        }
        $user = new User();
        $user->setEmail($userData["email"]);
        $user->setPassword($userData['password']);

        return $user;
    }

    public function refreshUser(UserInterface $user): UserInterface
    {
        $class = get_class($user);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException();
        }
        return $user;
    }

    public function supportsClass($class): bool
    {
        return 'App\Entity\User' === $class;
    }

    #[Pure]
    public function loadUserByIdentifier(string $identifier): UserInterface
    {
        return new User('dDupont', 'dupont', 'ddupont@test.fr','avatarUrl','profilHtmlUrl');
    }
}