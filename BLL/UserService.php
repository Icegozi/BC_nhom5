<?php
require_once __DIR__ . '/../DAL/UserRepository.php'; 

class UserService {
    private $userRepository;

    public function __construct() {
        $this->userRepository = new UserRepository();
    }

    public function login($email, $password) {
        $user = $this->userRepository->findUserByEmail($email);
        if ($user && $password == $user['password']) {
            return $user;
        }
        return null;
    }

}