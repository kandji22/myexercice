<?php
namespace App\Security;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\SelfValidatingPassport;

class CustomStipudAuthenticator extends AbstractAuthenticator {
private $repo;
    public function __construct( UserRepository $repository) {
        $this->repo = $repository;
    }
    public function supports(Request $request): ?bool
    {
        return $request->get('auth') != null ? true : false;
    }

    public function authenticate(Request $request)
    {
        $idUser = $request->get('auth');
        return new SelfValidatingPassport(
            new UserBadge($idUser,function ($idUser){
               return $this->repo->find($idUser);
            })
        );
    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        $request->getSession()->getFlashbag()->add('success','un message');
        return null;
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        return null;
    }
}