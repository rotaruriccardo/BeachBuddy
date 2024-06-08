<!DOCTYPE html> 
<html lang="it"> 
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Registrazione</title>
        <link rel="stylesheet" href="vecchio.css">
    </head>
    <body>
        <?php
            $dbconn = pg_connect("host=localhost port=5432 dbname=beachdb2 user=postgres password=biar") 
            or die("Errore di connessione:" .pg_last_error());
            if ($dbconn){
                $email=$_POST['inputEmail'];
                $query ="SELECT * from utente where email=$1";
                $q_result=pg_query_params($dbconn,$query,array($email));
                if($tuple=pg_fetch_array($q_result,null,PGSQL_ASSOC)){
                    header('Location: /registrazione/email-presa.html');
                }
                else{
                    $pswd=$_POST['inputPassword'];
                    $nome=$_POST['inputNome'];
                    $cognome=$_POST['inputCognome'];

                    $query2="INSERT INTO utente (email, pswd, nome, cognome) values ($1, $2, $3, $4)";
                    $q_result=pg_query_params($dbconn,$query2,array($email,$pswd,$nome,$cognome));
                    if ($q_result){
                        header('Location: /registrazione/email-ok.html');
                    }
                }
            }
        ?>
    </body>
</html>