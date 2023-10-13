<?php
namespace App\Security;
use Symfony\Component\Security\Http\Authorization\AccessDeniedHandlerInterface;
class CustomHandler implements AccessDeniedHandlerInterface
{

    public function handle(\Symfony\Component\HttpFoundation\Request $request, \Symfony\Component\Security\Core\Exception\AccessDeniedException $accessDeniedException)
    {
        $url = '/noadmin';
        return new \Symfony\Component\HttpFoundation\RedirectResponse($url);
    }
}