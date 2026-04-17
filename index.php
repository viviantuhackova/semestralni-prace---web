<?php 
include 'databaze.php'; 
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['odeslat_objednavku'])) {
    $jmeno = $_POST['jmeno'];
    $email = $_POST['email'];
    $produkt = $_POST['produkt'];
    $mnozstvi = $_POST['mnozstvi'];

    try {
        $sql = 'INSERT INTO "Tuhackova_web".objednavky (jmeno, email, produkt, datum_vytvoreni, mnozstvi) 
                VALUES (?, ?, ?, NOW(), ?)';
        $stmt_insert = $pdo->prepare($sql);
        $stmt_insert->execute([$jmeno, $email, $produkt, $mnozstvi]);
        $oznameni = "Objednávka na $mnozstvi $produkt byla odeslána!";
        echo "<script>
            window.onload = function() { 
                var element = document.getElementById('objednavka');
                element.scrollIntoView({ behavior: 'auto', block: 'center' }); 
            };
        </script>";
        
    } catch (PDOException $e) {
        $oznameni = "Chyba při zápisu: " . $e->getMessage();
    }
}

try {
    // Načtení všech produktů z databáze
    $stmt = $pdo->query('SELECT * FROM "Tuhackova_web".produkty ORDER BY id ASC');
} catch (PDOException $e) {
    die("Chyba při připojení k databázi: " . $e->getMessage());
}
?>

<html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Moje semestrální práce - Tropico</title>
    <link rel="stylesheet" href="styl.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    
    <script>
    function doKosiku(nazev) {
        document.getElementById('vybrany_produkt').value = nazev;
        var sekce = document.getElementById('objednavka');
        sekce.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
    </script>
</head>
<body>

    <div id="menu">
        <img src="obrazky/logo.jpg" alt="logo" width="80">
        <a href="index.php">Domů</a>
        <a href="#produkty">Nabídka</a>
        <a href="#kontakt">Kontakt</a>
        <a href="admin.php">Pro zaměstnance</a>
    </div>

    <div id="hlavni-foto">
        <img src="obrazky/banner.jpg" alt="banner" style="width: 100%;">
        <div class="nadpis-prekryv">
            <h1>To nejlepší z tropů na váš stůl!</h1>
            <p>Ručně vybíráme kousky, které nám samotným chutnají.</p>
            <a href="#produkty" class="moje-tlacitko">Chci ochutnat</a>
        </div>
    </div>

    <div id="produkty">

        <div style="text-align: center; padding: 20px; background: #fff5e6; border-radius: 10px; margin: 20px auto; width: 80%; border: 1px solid orange;">
            <?php
            date_default_timezone_set('Europe/Prague');
            $hodina = date("G");

            if ($hodina < 12) {
                echo "<h3>Dobré ráno! Dejte si k snídani čerstvé mango. </h3>";
            } elseif ($hodina < 18) {
                echo "<h3>Hezké odpoledne! Máme pro vás čerstvou várku ovoce. </h3>";
            } else {
                echo "<h3>Dobrý večer! Načerpejte tropickou energii na zítra. </h3>";
            }
            ?>
        </div>
        
        <h2 style="text-align: center;">Aktuální nabídka</h2>
        
        <div class="produkt-vypis">
            <?php while ($row = $stmt->fetch()): ?>
                <div class="polozka" style="position: relative;">
                    
                    <?php if (isset($row['bestseller']) && ($row['bestseller'] == true || $row['bestseller'] === 't')): ?>
                        <div style="position: absolute; top: 10px; right: 10px; padding: 5px 10px; background: white; border: 2px solid orange; border-radius: 5px; z-index: 10;">
                            <span style="color: orange; font-weight: bold; font-size: 12px; text-transform: uppercase;">
                                ★ Náš favorit
                            </span>
                        </div>
                    <?php endif; ?>

                    <img src="obrazky/<?php echo htmlspecialchars($row['obrazek']); ?>" alt="<?php echo htmlspecialchars($row['nazev']); ?>" width="200">
                    <h3><?php echo htmlspecialchars($row['nazev']); ?></h3>
                    
                    <p style="font-size: 14px; font-style: italic; color: #666; min-height: 40px;">
                        <?php echo htmlspecialchars($row['popis']); ?>
                    </p>
                    
                    <p>Původ: <?php echo htmlspecialchars($row['puvod']); ?></p>
                    <p><b>Cena: <?php echo number_format($row['cena'], 2, ',', ' '); ?> Kč / <?php echo htmlspecialchars($row['jednotka']); ?></b></p>
                    
                    <button type="button" onclick="doKosiku('<?php echo htmlspecialchars($row['nazev']); ?>')">Do košíku</button>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
    
    <div id="objednavka">
        <h3>Objednávka</h3>
        
        <?php if (isset($oznameni)): ?>
            <div style="background: lightgreen; color: darkgreen; padding: 10px; text-align: center; font-weight: bold; border: 1px solid green;">
                <?php echo $oznameni; ?>
            </div>
        <?php endif; ?>

        <form method="post" action="index.php">
            <label for="jmeno">Jméno:</label>
            <input type="text" name="jmeno" id="jmeno" required>
            
            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required>
            
            <label for="vybrany_produkt">Produkt:</label>
            <input type="text" id="vybrany_produkt" name="produkt" readonly>
            
            <label for="mnozstvi">Množství (kolik chcete):</label>
            <input type="text" name="mnozstvi" id="mnozstvi" placeholder="např. 5 kg" required>
            
            <button type="submit" name="odeslat_objednavku">ODESLAT</button>
        </form>
    </div>
    
    <div id="kontakt">
        <h2 style="text-align: center;">Kde nás najdete a odkud dovážíme:</h2>
        <div id="map" style="height: 500px; width: 90%; margin: 20px auto; border: 1px solid #ccc; border-radius: 8px;"></div>
    </div>

    <div id="paticka">
        <hr>
        <p>&copy; 2026 TROPICO - Vivian Tuháčková</p>
    </div>
    
    <script>
        var map = L.map('map').setView([49.8, 15.5], 7);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        L.marker([50.6607, 14.0325]).addTo(map)
            .bindPopup('<b>Pobočka Ústí</b><br>Dovážíme z: Peru');

        L.marker([50.0878, 14.4205]).addTo(map)
            .bindPopup('<b>Pobočka Praha</b><br>Centrální sklad');

        L.marker([49.1951, 16.6068]).addTo(map)
            .bindPopup('<b>Pobočka Brno</b><br>Dovážíme z: Vietnamu');

        L.marker([49.7475, 13.3776]).addTo(map)
            .bindPopup('<b>Pobočka Plzeň</b><br>Dovážíme z: Ekvádoru');

        L.marker([49.8209, 18.2625]).addTo(map)
            .bindPopup('<b>Pobočka Ostrava</b><br>Dovážíme z: Thajska');

        L.marker([48.9745, 14.4743]).addTo(map)
            .bindPopup('<b>Pobočka Č. Budějovice</b><br>Dovážíme z: Itálie');

        setTimeout(function(){ map.invalidateSize(); }, 500);
    </script>

</body>
</html>