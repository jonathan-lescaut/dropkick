<?php

namespace App\Manager;

use App\Entity\User;
use App\Repository\UserRepository;
use App\Services\MessageService;
use App\Services\PasswordService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class UserManager
{
    /**
     * @var EntityManagerInterface
     */
    protected $em;

    /**
     * @var PasswordService
     */
    protected $passwordService;

    /**
     * @var UserRepository
     */
    protected $userRepository;

    /**
     * @var MessageService
     */
    protected $messageService;

    /**
     * UserManager constructor.
     * @param EntityManagerInterface $entityManager
     * @param PasswordService $passwordService
     * @param UserRepository $userRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        PasswordService $passwordService,
        UserRepository $userRepository,
        MessageService $messageService
    ) {
        $this->em = $entityManager;
        $this->passwordService = $passwordService;
        $this->userRepository = $userRepository;
        $this->messageService = $messageService;
    }

    /**
     * @param string $email
     * @return mixed
     */
    public function findByEmail(string $email)
    {
        $user = $this->userRepository->findByEmail($email);

        if ($user) {
            return $user[0];
        }

        return null;
    }

    /**
     * @param int $id
     */
    public function remove(int $id)
    {
        $user = $this->userRepository->find($id);

        if ($user instanceof User) {
            $user->setEmail('***********************');
            $user->setUsername('***********************');
            $this->em->persist($user);
            $this->em->flush();
        }
    }

    /**
     * @param User $user
     * @return array|string
     * @throws \Exception
     */
    public function registerAccount(User $user)
    {
        if ($this->findByEmail($user->getEmail())) {
            throw new BadRequestHttpException('Cette adresse email a d??j?? ??t?? utilis??.');
        }

        $user->setUsername($user->getEmail());
        $pass = $this->passwordService->encode($user, $user->getPassword());
        $user->setPassword($pass);
        $user->setActive(true);
        $user->setCreatedAt(new \DateTime());
        $user->setUpdatedAt(new \DateTime());
        $this->em->persist($user);
        $this->em->flush();

        $this->messageService->addSuccess('La cr??ation de votre compte a bien ??t?? valider.');

        return [
            'message' => 'Cr??ation de compte enregistr??e.',
            'user' => $user
        ];
    }

    /**
     * REP + ANNEE + MOIS + JOUR + TOKEN GENERER.
     *
     * @return string
     */
    public function referenceFormat()
    {
        return 'REP'.substr(date('Y'), 2).date('md').uniqid();
    }
}