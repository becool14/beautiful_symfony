<?php
namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserService
{
    private UserRepository $userRepository;
    private EntityManagerInterface $entityManager;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager, UserPasswordHasherInterface $passwordHasher)
    {
        $this->userRepository = $userRepository;
        $this->entityManager = $entityManager;
        $this->passwordHasher = $passwordHasher;
    }

    public function registerUser(string $login, string $password): ?string
    {
        if ($this->userRepository->findOneBy(['login' => $login])) {
            return "User already exists!";
        }

        $user = new User();
        $user->setLogin($login);
        $user->setPassword($this->passwordHasher->hashPassword($user, $password));

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return null; // Якщо все успішно, повертаємо null (без помилки)
    }

    public function loginUser(string $login, string $password): ?string
    {
        $user = $this->userRepository->findOneBy(['login' => $login]);

        if (!$user) {
            return "User does not exist!";
        }

        if (!$this->passwordHasher->isPasswordValid($user, $password)) {
            return "Invalid password!";
        }

        return null; // Успішний вхід
    }
}
?>