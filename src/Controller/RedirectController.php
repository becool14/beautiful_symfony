<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\RedirectResponse;

class RedirectController extends AbstractController
{
    #[Route('/{any}', name: 'redirect_to_register', requirements: ['any' => '^(?!login$|register$).*'])]
    public function redirectToRegister(): RedirectResponse
    {
        return $this->redirectToRoute('register');
    }
}
?>