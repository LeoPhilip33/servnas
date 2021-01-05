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
                <label for="nom"> Nom : </label>
                <input class="form-control" id="nom" type="text" name="Nom" placeholder="Nom" maxlength="45">
            </div>
            <div class="form-group">
                <label for="prenom"> Prenom : </label>
                <input class="form-control" id="prenom" type="text" name="Prenom" placeholder="Prenom" maxlength="45">
            </div>
            <div class="form-group">
                <label for="email"> Email : </label>
                <input class="form-control" id="email" type="text" name="Email" placeholder="Email" maxlength="45">
            </div>
            <div class="form-group">
                <label for="mdp"> Mot de passe : </label>
                <input class="form-control" id="mdp" type="password" name="Pass" placeholder="Mot de passe" maxlength="45">
            </div>
            <button class="btn btn-green" type="envoyer" value="Envoyer"> Inscription </button>
        </form>
    </section>
</body>
</html>

