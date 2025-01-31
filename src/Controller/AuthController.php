<?php
namespace App\Controller;

use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends AbstractController
{
    private UserService $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    #[Route('/login', name: 'login', methods: ['GET', 'POST'])]
    public function login(Request $request): Response
    {
        $error = null;
        $message = null;

        if ($request->isMethod('POST')) {
            $login = $request->request->get('login');
            $password = $request->request->get('password');

            if (!$login || !$password) {
                $error = "Both fields are required!";
            } else {
                $error = $this->userService->loginUser($login, $password);
                if (!$error) {
                    $this->addFlash('success', "Login successful!");
                    return $this->redirectToRoute('login');
                }
                $this->addFlash('error', $error);                
            }
        }

        return $this->render('auth/login.html.twig', [
            'error' => $error,
            'message' => $message,
        ]);
    }

    #[Route('/register', name: 'register', methods: ['GET', 'POST'])]
    public function register(Request $request): Response
    {
        $error = null;
        $message = null;

        if ($request->isMethod('POST')) {
            $login = $request->request->get('login');
            $password = $request->request->get('password');

            if (!$login || !$password) {
                $error = "Both fields are required!";
            } else {
                $error = $this->userService->registerUser($login, $password);
                if (!$error) {
                    $this->addFlash('success', "Registration successful! You can now log in.");
                    return $this->redirectToRoute('login');
                }
                $this->addFlash('error', $error);                
            }
        }

        return $this->render('auth/register.html.twig', [
            'error' => $error,
            'message' => $message,
        ]);
    }
}
?>