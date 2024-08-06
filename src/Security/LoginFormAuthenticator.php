<?php

namespace App\Security;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Http\Authenticator\Passport\Passport;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authenticator\AbstractAuthenticator;
use Symfony\Component\Security\Http\Authenticator\Passport\Badge\UserBadge;
use Symfony\Component\Security\Http\Authenticator\Passport\Credentials\PasswordCredentials;

class LoginFormAuthenticator extends AbstractAuthenticator
{
    protected $encoder;
    private RouterInterface $router;

   

    public function __construct(UserPasswordHasherInterface $encoder, RouterInterface $router)
    {
       $this->encoder = $encoder;
       $this->router = $router;
    }

    public function supports(Request $request): ?bool
    {
        // TODO: Implement supports() method.
        return $request->attributes->get('_route') === 'security_login' && $request->isMethod('POST');
    }

    public function authenticate(Request $request): Passport
    {
        // TODO: Implement authenticate() method.
            $credentials = $request->request->all()['login'];        
        return new Passport( 
        new UserBadge($credentials['email']),           
        new PasswordCredentials($credentials['password'])    
            );  

    }

    public function onAuthenticationSuccess(Request $request, TokenInterface $token, string $firewallName): ?Response
    {
        // TODO: Implement onAuthenticationSuccess() method.
        return new RedirectResponse('/'); 
    }

    public function onAuthenticationFailure(Request $request, AuthenticationException $exception): ?Response
    {
        $errorMsg = "Erreur d'authentification"; 

        if ($exception->getMessage() === "Bad credentials.") 
        {
            $errorMsg = "Cette adresse email n'est pas connue.";
        } elseif ($exception->getMessage() === "The presented password is invalid.") 
        {
            $errorMsg = "Les informations de connexion ne correspondent pas";
        }

        $exception = new AuthenticationException($errorMsg);

        $request->attributes->set(Security::AUTHENTICATION_ERROR, $exception);
        $request->attributes->set(Security::LAST_USERNAME, $request->request->all()['login']['email']);
        
        return null;
    }

    public function start(Request $request, AuthenticationException $authException = null): Response
    {
    }
}