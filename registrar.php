<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (name, email, password) VALUES (:name, :email, :password)";
    $stmt = $conn->prepare($sql);

    try {
        $stmt->execute(['name' => $name, 'email' => $email, 'password' => $password]);
        header("Location: login.php?success=1");
    } catch (PDOException $e) {
        $error = "Error: " . $e->getMessage();
    }
}
?>


<form action="" method="POST">
    <label>Nome</label>
    <input type="text" name="name" required>
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Senha</label>
    <input type="password" name="password" required>
    <button type="submit">Registrar</button>
</form>
