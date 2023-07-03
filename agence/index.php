<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de form avec js</title>
    <link rel="stylesheet" href="awesome/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>

</head>

<body>
    <div class="container">
        <div class="header">
            <h2>Créer un compte</h2>
        </div>
        <form class="form" id="form" action="traitement.php" method="POST">
            <div class="form-control">
                <label for="username">Nom d'utilisateur</label>
                <input type="text" name="nom" id="username" placeholder="Ronasdev">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation"></i>
                <small class="error-message"></small>
            </div>
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="ronasdev@gmail.com">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation"></i>
                <small class="error-message"></small>
            </div>
            <div class="form-control">
                <label for="password">Mot de passe</label>
                <input type="password" name="pass" id="password" placeholder="Ronasdev">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation"></i>
                <small class="error-message"></small>
            </div>
            <div class="form-control">
                <label for="password2">Confirmation du mot de passe</label>
                <input type="password" name="pass2" id="password2" placeholder="Ronasdev">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation"></i>
                <small class="error-message"></small>
            </div>
            <p class="error-message"></p>
            <button type="submit"> <i class="fas fa-user-plus"></i> S'inscrire</button>
            <a href="connexion.php">Se connecter ici</a>
        </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#form').submit(function(event) {
                event.preventDefault(); // Empêche le rechargement de la page

                // Réinitialiser les messages d'erreur et les styles des champs
                $('.error-message').text('');
                $('.form-control').removeClass('error success');

                // Récupérer les données du formulaire
                var formData = $(this).serialize();
                var username = $('#username').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var password2 = $('#password2').val();

                // Vérifier les champs vides et la longueur du mot de passe
                var isValid = true;

                if (username.trim() === '') {
                    $('#username').siblings('.error-message').text('Le nom d\'utilisateur est requis');
                    $('#username').closest('.form-control').addClass('error');
                    isValid = false;
                }

                if (email.trim() === '') {
                    $('#email').siblings('.error-message').text('L\'email est requis');
                    $('#email').closest('.form-control').addClass('error');
                    isValid = false;
                }

                if (password.trim() === '') {
                    $('#password').siblings('.error-message').text('Le mot de passe est requis');
                    $('#password').closest('.form-control').addClass('error');
                    isValid = false;
                } else if (password.length < 4) {
                    $('#password').siblings('.error-message').text('Le mot de passe doit contenir au moins 5 caractères');
                    $('#password').closest('.form-control').addClass('error');
                    isValid = false;
                }

                if (password2.trim() === '') {
                    $('#password2').siblings('.error-message').text('La confirmation du mot de passe est requise');
                    $('#password2').closest('.form-control').addClass('error');
                    isValid = false;
                } else if (password !== password2) {
                    $('#password2').siblings('.error-message').text('Les mots de passe ne correspondent pas');
                    $('#password2').closest('.form-control').addClass('error');
                    isValid = false;
                }

                if (isValid) {
                    // Ajouter la classe 'success' aux champs valides
                    $('.form-control').addClass('success');

                    // Envoyer les données du formulaire via AJAX
                    $.ajax({
                        type: 'POST',
                        url: 'traitement.php',
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                            // Traitement de la réponse en cas de succès
                            if (response.success) {
                                // Réinitialiser le formulaire
                                $('#form')[0].reset();
                                // Afficher un message de succès
                                $('.success-message').text(response.message);
                            } else {
                                // Afficher un message d'erreur
                                $('.error-message').text(response.message);
                            }
                        },
                        error: function(xhr, status, error) {
                            // Traitement de la réponse en cas d'erreur
                            console.error(xhr.responseText);
                        }
                    });
                }
            });
        });
    </script>
</body>

</html>