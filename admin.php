<html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Přihlášení pro zaměstnance | Tropico</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styladmin.css">
</head>
<body class="login-body" style="background-image: url('obrazky/pozadi.jpg'); background-size: cover;">

    <div class="login-container">
        <form action="admin.php" method="POST" class="login-form">
            <h2 style="color: Green;">Přihlášení pro zaměstnance</h2>
            <p><strong>Vstup do interního systému</strong></p>
            
            <label>Uživatelské jméno:</label>
            <input type="text" name="uzivatel" required>
            
            <label>Heslo:</label>
            <input type="password" name="heslo" required>
            
            <button type="submit" class="btn-login">Vstoupit do systému</button>
            
            <br><br>
            <a href="index.php" style="color: Gray; text-decoration: none; font-size: 14px;">← Zpět na hlavní web</a>
        </form>
    </div>

</body>
</html>