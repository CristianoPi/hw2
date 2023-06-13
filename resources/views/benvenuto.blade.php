<html>
    <head>
        <meta charset="uttf-8">
        <link rel="stylesheet" href="hw1.css">
        <title>Post Camera</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="menu_mobile.js" defer></script>
        <link rel="shortcut icon" href="logo.png" />
    </head>
    <body>
  
        <div id="header">
            <img src="logo.png" alt="">
            <nav id="menu">
                <a href="index">HOME</a>
                <a href="bacheca">BACHECA</a>
                <a href="account">IL TUO ACCOUNT</a>
                <a href="logout">LOGOUT</a>
                <div id="menu_icon">
                  <div></div>
                  <div></div>
                  <div></div>
                </div>
            </nav>
        </div>
        <div id="menu_mobile" class="menu_mobile">

            <a href="index">HOME</a>
            <a href="bacheca">BACHECA</a>
            <a href="account">IL TUO ACCOUNT</a>
            <a href="logout">LOGOUT</a>

        </div>
        <header id="i1">
            <div class="overlay">
                <h1 class="t">Benvenuto <br>{{$user}}!</h1>
            </div>
        </header>
        
        <section class="s1">
          <div class="contenuto">
            <img src="img\im_blog1.png" class="foto">
            <p class="descrizione">
                ORA POTRAI ACCEDERE AL BLOG FOTOGRAFICO
                <a href="bacheca">ENTRA</a>
            </p>
          </div>
          <div class="contenuto">
            <p class="descrizione">
                CARICA UNA NUOVA FOTO
                <a href="upload">VAI!</a>
            </p>
            <img src="img\im_carica.jpg" class="foto">
          </div>
          <div class="contenuto">
            <img src="img\im_account.jpg" class="foto">
            <p class="descrizione">
                IMPOSTAZIONI ACCOUNT
                <a href="account">GESTISCI</a>
            </p>
          </div>
        </section>
        <footer id="f1">
            REALIZZATO DA: Cristiano Pistorio 1000015332
        </footer>
    </body>
</html>
