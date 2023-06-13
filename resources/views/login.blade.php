<html>
    <head>
        <meta charset="uttf-8">
        <link rel="stylesheet" href="hw1.css">
        <link rel="stylesheet" href="log.css">
        <title>Post Camera</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="login.js" defer></script>
        <script src="menu_mobile.js" defer></script>
        <link rel="shortcut icon" href="logo.png" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <div id="header">
            <img src="logo.png" alt="">
            <nav id="menu">
                <a href="/index">HOME</a>
    
                <a href="/cerca">ISPIRATI</a>
                <a href="/login">LOGIN</a>
                <div id="menu_icon">
                  <div></div>
                  <div></div>
                  <div></div>
                </div>
            </nav>
        </div>
        <div id="menu_mobile" class="menu_mobile">

            <a href="/index">HOME</a>
            <a href="/cerca">ISPIRATI</a> 
            <a href="/login">LOGIN</a>
            
        </div>
        <header id="i1">
            <div class="overlay">
                <h1 class="t">POST &nbsp<span class="t_y"> CAMERA</span> </h1>
            </div>
        </header>

        <section class="s1">
        @foreach($errors->all() as $e)
         <p class='errore'>{{ $e }}</p>
        @endforeach
        <form action="/login" method="POST">
            @csrf
            <h2>ACCEDI </h2>
            <div class="dati">
                <label for="user">Username</label> <input type="text" name="user" id="user" >
                <br>
                <label for="pwd">Password</label><input type="password" name="pwd" id="pwd">
                <br>
                <a href="log" class="link">non hai un account? REGISTRATI</a>
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