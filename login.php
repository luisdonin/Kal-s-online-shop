<?php
include 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = :email";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user['name'];
        header("Location: home.php");
    } else {
        $error = "Email ou senha inválidos!";
    }
}
?>


<form action="" method="POST">
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Senha</label>
    <input type="password" name="password" required>
    <button type="submit">Login</button>
</form>
<?php if (isset($error)) echo "<p>$error</p>"; ?>
