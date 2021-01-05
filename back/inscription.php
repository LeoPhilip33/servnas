<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <section class="form_container">
        <form class="w-25" method="POST">
            <div class="form-group">
                <label> Email : </label>
                <input class="form-control" type="text" name="Login" placeholder="Mot de passe" maxlength="45">
            </div>
            <div class="form-group">
                <label> Mot de passe : </label>
                <input class="form-control" type="password" name="Pass" placeholder="Mot de passe" maxlength="45">
            </div>
            <button class="btn btn-green" type="envoyer" value="Envoyer"> Connexion </button>
        </form>
    </section>
</body>
</html>

