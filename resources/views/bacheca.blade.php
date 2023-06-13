<html>
    <head>
        <meta charset="uttf-8">
        <link rel="stylesheet" href="hw1.css">
        <link rel="stylesheet" href="bacheca.css">
        <title>Post Camera</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="menu_mobile.js" defer></script>
        <script src="bacheca.js" defer></script>
        <link rel="shortcut icon" href="logo.png" />
        <meta name="csrf-token" content="{{csrf_token()}}"> 
    </head>
    <body>
        <div id="header">
            <img src="logo.png" alt="">
            <nav id="menu">
                <a href="index">HOME</a>
                <a href="account">{{$user}}</a>
                <a href="upload">CARICA FOTO</a>
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
            <a href="account">{{$user}}</a>
            <a href="upload">CARICA FOTO</a>
            <a href="logout">LOGOUT</a>

        </div>
        <header id="i2">
            <div class="overlay">
            <h1 class="t">POST &nbsp <span class="t_y">CAMERA</span></h1>
            <h2 class="t2">Foto di:</h2>
            </div>
        </header>
        
        <section id="bacheca">
        </section>

        <section id="modal-view" class="hidden">
        </section>

        <div id="modal-comment" class="hiden">
            <div class="modal-comment-content">
                <span class="close" id="close_c">&times;</span>
                <h1>COMMENTI</h1>
                <div class="view-comment">
                    
                </div>
                <form >
                        @csrf
                        <label for="user">Scrivi un commento:</label> <input type="text" name="comment" id="comment">
                        <input type="text" name="fotoID" class="hiden" id="fotoID">
                        <input type="submit" value="INVIA">
                </form>
            </div>
        </div>
        <div id="modal-desc" class="hiden">
        <div class="modal-desc-content">
            <span class="close" id="close_d">&times;</span>
            <h1>DESCRIZIONE</h1>
            <p>
            </p>
        </div>
        </div>

        <footer id="f1">
            REALIZZATO DA: Cristiano Pistorio 1000015332
        </footer>
    </body>
</html>
