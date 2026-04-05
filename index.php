<html>
<html lang="cs">
<head>
    <meta charset="UTF-8">
    <title>Moje semestrální práce - Tropico</title>
    <link rel="stylesheet" href="styl.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
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

    <div id="paticka">
        <hr>
        <p>&copy; 2026 TROPICO - Vivian Tuháčková</p>
    </div>

</body>
</html>