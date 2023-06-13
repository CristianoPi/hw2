<html>
    <head>
        <meta charset="uttf-8">
        <link rel="stylesheet" href="hw1.css">
        <title>Post Camera</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="menu_mobile.js" defer></script>
        <script src="index.js" defer></script>
        <link rel="shortcut icon" href="logo.png" />
    </head>

    <body>
        <div id="header">
            <img src="logo.png" alt="">
            <nav id="menu">

                <a href="/bacheca">BACHECA</a>
    
                <a href="/cerca">ISPIRATI</a>

          
                @if ($id)
                  <a href="/account">{{$user}}</a> 
                @else
                  <a href="/login">LOGIN</a>
                @endif
        
                <div id="menu_icon">
                  <div></div>
                  <div></div>
                  <div></div>
                </div>
            </nav>
        </div>
        <div id="menu_mobile" class="menu_mobile">

            <a href="/bacheca">BACHECA</a>
          
            <a href="/cerca">ISPIRATI</a>

            @if ($id)
              <a href="/account">{{$user}}</a> 
            @else
              <a href="/login">LOGIN</a>
            @endif


        </div>
        <header id="i1">
            <div class="overlay">
                <h1 class="t">POST &nbsp <span class="t_y">CAMERA</span></h1>
            </div>
        </header>
        
        <section class="s1">
          <div class="contenuto">
              <img src="img\im_blog1.png" class="foto">
              <p class="descrizione_">  
                <span class="t_y_">COS'È POST CAMERA?</span>
                Post Camera è un blog fotografico, in cui i fotografi possono condividere e commentare le proprie foto. 
                Post Camera è un blog dedicato ai fotografi, ogni foto sarà pubblicata insieme a i suoi dettagli tecnici.
                Inoltre ogni fotografo potrà mettere "like" alle foto presenti sul blog, la foto maggiormente apprezzata diventerà la copertina del sito.
                <br>
                <br>
 
                @if ($id)
                 <a href="/bacheca">VAI ALLA BACHECA</a> 
                @else
                  <a href="/login">ACCEDI</a>
                @endif
                PER AVERE TUTTE LE FUNZIONALITÀ
              </p>
          </div>
         
          <div id="album-wrapper">
            <div id="some_foto"></div>
          </div>
        </section>
        <footer id="f1">
            REALIZZATO DA: Cristiano Pistorio 1000015332
        </footer>
    </body>
</html>
