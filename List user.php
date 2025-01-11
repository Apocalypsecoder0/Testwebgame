<?php
class User {
    private $id;
    private $name;
    private $email;

    public function __construct($id, $name, $email) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
}

class UserManager {
    private $users = [];

    public function addUser(User $user) {
        $this->users[$user->getId()] = $user;
    }

    public function getUser($id) {
        return isset($this->users[$id]) ? $this->users[$id] : null;
    }

    public function getAllUsers() {
        return $this->users;
    }
}

// Example usage
$userManager = new UserManager();
$user1 = new User(1, "John Doe", "john@example.com");
$userManager->addUser($user1);

$user2 = new User(2, "Jane Smith", "jane@example.com");
$userManager->addUser($user2);

print_r($userManager->getAllUsers());
?>
