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

     public function getUserById($id) {
        return $this->userRepository->findUserById($id);
    }
    public function updateUser($id, $name, $password, $phone, $email, $address) {
        return $this->userRepository->updateUser($id, $name, $password, $phone, $email, $address);
    }

    public function getAllUsers() {
    return $this->userRepository->findAllUsers();
}

    public function deleteUser($id) {
        return $this->userRepository->deleteUser($id);
    }

    public function findNameType($id){
        return $this->userRepository->findNameTypebyId($id);
    }

      public function addUser($name, $email, $phone, $address, $type) {
        // Gọi phương thức addUser từ UserDAO để thêm người dùng vào cơ sở dữ liệu
        return $this->userRepository->addUser($name, $email, $phone, $address, $type);
    }
}