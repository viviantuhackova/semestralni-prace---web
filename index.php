<html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Moje semestrální práce - Tropico</title>
    <link rel="stylesheet" href="styl.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
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
            <div class="polozka">
                <img src="obrazky/mango.jpg" alt="mango" width="200">
                <h3>Sladké Mango</h3>
                <p>Původ: Thajsko</p>
                <p><b>Cena: 89 Kč / kg</b></p>
                <button>Do košíku</button>
            </div>
            
            <div class="polozka">
                <img src="obrazky/pitaya.jpg" alt="pitaya" width="200">
                <h3>Dračí ovoce</h3>
                <p>Původ: Vietnam</p>
                <p><b>Cena: 120 Kč / ks</b></p>
                <button>Do košíku</button>
            </div>
        </div>
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
            .bindPopup('<b>Pobočka Ústí</b><br>Dovážíme z: Thajska');

        L.marker([50.0878, 14.4205]).addTo(map)
            .bindPopup('<b>Pobočka Praha</b><br>Dovážíme z: Vietnamu');

        L.marker([49.1951, 16.6068]).addTo(map)
            .bindPopup('<b>Pobočka Brno</b><br>Dovážíme z: Vietnamu');

        L.marker([49.7475, 13.3776]).addTo(map)
            .bindPopup('<b>Pobočka Plzeň</b><br>Dovážíme z: Thajska');

        L.marker([49.8209, 18.2625]).addTo(map)
            .bindPopup('<b>Pobočka Ostrava</b><br>Dovážíme z: Thajska');

        L.marker([48.9745, 14.4743]).addTo(map)
            .bindPopup('<b>Pobočka Č. Budějovice</b><br>Dovážíme z: Vietnamu');

        setTimeout(function(){ map.invalidateSize(); }, 500);
    </script>

</body>
</html>