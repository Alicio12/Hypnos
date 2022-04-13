<?php
// ... processus de connexion
// $user est un objet User retourné par PDO

$pdo=new
PDO('mysql:host=localhost;port:3006;dbname=Hypnos;user=root');

class User
{
    private string $id;
    private string $email;
    private string $password;
    //tableau des rôles
    private array $roles = [];
    public function getId(): string
    {
        return $this->id;
    }

    public function addRole(string $role): void
    {
        $this->roles[] = $role;
    }

    public function getRoles(): array
    {
        return $this->roles;
    }
};

$statement = $pdo->prepare('SELECT * FROM userRoles JOIN roles ON roles.id = userRoles.roleId WHERE id = :id');
$statement->bindValue(':id', $user->getId());
if ($statement->execute()) {
    while ($role = $statement->fetch(PDO::FETCH_ASSOC)) {
        $user->addRole($role['name']);
    }
}