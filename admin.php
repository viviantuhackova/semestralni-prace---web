<?php
session_start();
include 'databaze.php';

$prihlasen = false;
$chyba = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $jmeno = $_POST['uzivatel'];
    $heslo = $_POST['heslo'];

    if ($jmeno == 'tropico' && $heslo == 'tropico') {
        $_SESSION['prihlasen_uzivatel'] = true;
    } else {
        $chyba = "Nesprávné jméno nebo heslo!";
    }
}

if (isset($_SESSION['prihlasen_uzivatel']) && $_SESSION['prihlasen_uzivatel'] == true) {
    $prihlasen = true;
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}
?>

<html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Přihlášení pro zaměstnance | Tropico</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styladmin.css">
</head>
<body class="login-body" style="background-image: url('obrazky/pozadi.jpg'); background-size: cover;">

<?php if (!$prihlasen): ?>
    <div class="login-container">
        <form action="admin.php" method="POST" class="login-form">
            <h2 style="color: Green;">Přihlášení pro zaměstnance</h2>
            <?php if ($chyba) echo "<p style='color:red;'>$chyba</p>"; ?>
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
<?php else: ?>
        <div class="admin-box">
            <h2>Přehled objednávek</h2>
            <a href="admin.php?logout=1" style="color: red;">Odhlásit se</a>
            <br><br>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Jméno</th>
                    <th>Příjmení</th>
                    <th>Email</th>
                    <th>Produkt</th>
                    <th>Množství</th>
                    <th>Datum</th>
                </tr>
                <?php
                $stmt = $pdo->query('
                    SELECT o.*, p.nazev AS nazev_ovoce, p.jednotka
                    FROM "Tuhackova_web".objednavky o
                    JOIN "Tuhackova_web".produkty p ON o.produkt_id = p.id
                    ORDER BY o.datum_vytvoreni DESC
                ');
                
                while ($row = $stmt->fetch()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>" . htmlspecialchars($row['krestni_jmeno']) . "</td>
                            <td>" . htmlspecialchars($row['prijmeni']) . "</td>
                            <td>" . htmlspecialchars($row['email']) . "</td>
                            <td>" . htmlspecialchars($row['nazev_ovoce']) . "</td>
                            <td>" 
                                . htmlspecialchars($row['mnozstvi']) . " " 
                                . htmlspecialchars($row['jednotka']) . 
                            "</td>
                            <td>" . date("d.m.Y H:i", strtotime($row['datum_vytvoreni'])) . "</td>
                          </tr>";
                }
                ?>
            </table>
            <br>
            <a href="index.php">← Zpět na web</a>
        </div>
    <?php endif; ?>

</body>
</html>