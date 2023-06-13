<html>
    <head>
        <meta charset="uttf-8">
        <link rel="stylesheet" href="hw1.css">
        <link rel="stylesheet" href="log.css">
        <title>Post Camera</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lora">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <script src="menu_mobile.js" defer></script>
        <link rel="shortcut icon" href="logo.png" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
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
                <h1 class="t">UPLOAD FOTO</h1>
            </div>
        </header>
        
        <section class="s1">
        
			<form action="upload" method="POST" enctype="multipart/form-data"> <!-- enctype serve per permettere di inviare file dal form  -->	
                <?php
                // $db=ConnessioneDB();
                // if(!empty($_POST['luogo'])&&!empty($_POST['macchina'])&&!empty($_POST['obiettivo'])&&!empty($_POST['F'])&&!empty($_POST['iso'])&&!empty($_POST['T'])){

                //     $n=''.rand(0,100000);
                //     if(file_exists($_SESSION['user'].$n.'.jpg'))
                //         $name=$_SESSION['user'].rand(0,100000).'.jpg';
                //     else
                //         $name=$_SESSION['user'].$n.'.jpg';
                //     $tmp=$_FILES['foto']['tmp_name'];
                //     move_uploaded_file($tmp,'foto_utenti/'.$name);
                //     // ------------------------------------------------------------------
                //     $luogo=mysqli_real_escape_string($db, $_POST['luogo']);
                //     $macchina=mysqli_real_escape_string($db, $_POST['macchina']);
                //     $obiettivo=mysqli_real_escape_string($db, $_POST['obiettivo']);
                //     $F=mysqli_real_escape_string($db, $_POST['F']);
                //     $iso=mysqli_real_escape_string($db, $_POST['iso']);
                //     $T=mysqli_real_escape_string($db, $_POST['T']);
                //     $d=mysqli_real_escape_string($db, $_POST['d']);
                //     $u=$_SESSION['ID'];	
                //     $query="INSERT INTO foto VALUES ('','$name','$luogo','$macchina','$obiettivo','$F','$iso','$T','$d','$u',(SELECT CURRENT_TIMESTAMP()),'')";
                //     mysqli_query($db, $query) or die ("Impossibile eseguire la query");
                //     echo '<p class="corretto">FOTO CARICATA CORRETTAMENTE</p>';
                // }
                // //verifcare presenza di campi vuoti in js
                ?>
                @csrf
                <p class="corretto">{{$corretto}}</p>
				<h2>Carica le tue foto</h2>
                <div class="dati_upload">
					<br>
					Seleziona la tua foto: <input type="file" name="foto" accept="image/*">
					<br>
					Luogo dello scatto: <input type="text" name="luogo" >
					<br>
					Corpo macchina: <input type="text" name="macchina">
					<br>
					Obbiettivo: <input type="text" name="obiettivo">
					<br>
					Apertura focale: <input type="text" name="F" >
					<br>
					ISO: <input type="text" name="iso">
					<br>
					Tempo d'esposizione: <input type="text" name="T">
					<br>
					Descrizione: <textarea name="d" id="d" rows="5" cols="25" ></textarea>
					<br>
					<input type="submit" value="INVIA" >
                    <br>
                    <br>
					<input type="reset" value="ANNULLA" >
					<br><br>
					<a href="account" class="link">Torna a gestisci account</a>
                </div>
            </form>
		
        </section>
        <footer id="f1">
            REALIZZATO DA: Cristiano Pistorio 1000015332
        </footer>
    </body>
</html>
