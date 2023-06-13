<html>
    <head>
        <meta charset="uttf-8">
        <link rel="stylesheet" href="hw1.css">
        <link rel="stylesheet" href="log.css">
        <title>Post Camera</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="menu_mobile.js" defer></script>
        <script src="change_password.js" defer></script>
        <link rel="shortcut icon" href="logo.png" />
        <meta name="csrf-token" content="{{csrf_token()}}">
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
                <h1 class="t">Cambia la tua password <br>{{$user}}!</h1>
            </div>
        </header>
        
        <section class="s1">
        <form>
            @csrf
            <h2>CAMBIA LA TUA PASSWORD</h2>
            <div class="dati">
                <label for="pwd">Vecchia Password</label><input type="password" name="pwd_old" id="pwd_old">
                <span id="errore_pwd_old" class="errore"></span>
                <br>
                <label for="pwd">Nuova Password</label><input type="password" name="pwd" id="pwd">
                <span id="errore_pwd" class="errore"></span>
                <br>
                <label for="pwd">Reinserisci la nuova Password</label><input type="password" name="pwd_v" id="pwd_v">
                <span id="errore_pwd_v" class="errore"></span>
                <br>
                <input type="submit" value="INVIA">
                <br>
                <input type="reset" value="ANNULLA"> 
            </div>
        </form>
        </section>
        <footer id="f1">
            REALIZZATO DA: Cristiano Pistorio 1000015332
        </footer>
    </body>
</html>
