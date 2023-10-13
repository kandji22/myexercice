<?php
namespace App\Security;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

class CustomUserChecker implements UserCheckerInterface
{

    public function checkPreAuth(UserInterface $user)
    {
        $this->check($user);
    }

    public function checkPostAuth(UserInterface $user)
    {
        $this->check($user);
    }
    public function check(UserInterface $user) {
        if(str_contains($user->getUserIdentifier(),'modou')) {
            throw new CustomUserMessageAuthenticationException('Vous ete banni');
        }
    }
}