
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire de connexion</title>
    <link rel="stylesheet" href="awesome/css/all.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<style>
    *{
    box-sizing: border-box;
}
:root{
    --color-first:#09582ff1;
    --color-second:#f0f0f0;
    --color-white:#fff;
    --color-success:#2ecc71;
    --color-error:#e74c3c;
}
body{
    background-image:url(image/sigle_logo.png);
    font-family: "Open sabs" sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
    margin: 0;
    overflow: hidden;
}
.container{
    background: var(--color-white);
    border-radius: 5px;
    box-shadow: 0 2px 6px rgba(0,0,0,.5);
    width: 400px;
    max-width: 100%;
}
.header{
    background: #f7f7f7;
    border-bottom: 1px solid var(--color-second);
    padding: 20px 40px;
}
.header h2{
    margin: 0;
    text-align: center;
    font-style: italic;
}
.form{
    padding: 30px 40px;
}
.form-control{
    margin-bottom: 10px;
    padding-bottom: 20px;
    position: relative;
}
.form-control label{
    display: inline-block;
    margin-bottom: 5px;
}
.form-control input{
    border:  2px solid var(--color-second);
    border-radius: 4px;
    display: block;
    font-family: inherit;
    font-size: 14px;
    width: 100%;
    height: 40px;
    padding-left: 10px;
}
.form-control i{
    position: absolute;
    top: 33px;
    right: 10px;
    visibility: hidden;
}
.form-control small{
    position: absolute;
    bottom: 0;
    left: 0;
    visibility: hidden;
}
.form button{
    background: var(--color-first);
    border: 2px solid var(--color-first);
    color: var(--color-white);
    display: block;
    font-family: inherit;
    border-radius: 4px;
    padding: 10px;
    font-size: 16px;
    width: 100%;
    cursor: pointer;
}
.form-control.success input{
    border-color: var(--color-success);
}
.form-control.error input{
    border-color: var(--color-error);
}
.form-control.success i.fa-check-circle{
    color: var(--color-success);
    visibility: visible;
}
.form-control.error i.fa-exclamation{
    color: var(--color-error);
    visibility: visible;
}
.form-control.error small{
    color: var(--color-error);
    visibility: visible;
}

.success {
    border: 1px solid green;
  }
  
  .success + .error-message {
    display: none;
  }
  
  .success ~ .error-message {
    display: none;
  }
  
  .success-message {
    color: green;
  }
  
</style>
<body>
    <div class="container">
        <div class="header">
            <h2>Connexion</h2>
        </div>
        <form class="form" id="form" action="traitementt.php" method="POST">
            <div class="form-control">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="ronasdev@gmail.com">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation"></i>
                <small class="error-message"></small>
            </div>
            <div class="form-control">
                <label for="password">Mot de passe</label>
                <input type="password" name="password" id="password" placeholder="Mot de passe">
                <i class="fas fa-check-circle"></i>
                <i class="fas fa-exclamation"></i>
                <small class="error-message"></small>
            </div>
            <div class="form-control">
                <p class="error-message"></p>
            </div>
            <button type="submit"> <i class="fas fa-sign-in-alt"></i> Se connecter</button>
            <a href="index.php">Créer un compte</a>
        </form>
    </div>
</body>

<script>
$(document).ready(function() {
  var passwordAttempts = 0; // Variable pour suivre le nombre de tentatives de mot de passe incorrectes

  $('#form').submit(function(event) {
    event.preventDefault(); // Empêche le rechargement de la page

    // Réinitialiser les messages d'erreur et les styles des champs
    $('.error-message').text('');
    $('.form-control').removeClass('error success');

    // Récupérer les données du formulaire
    var formData = $(this).serialize();
    var email = $('#email').val();
    var password = $('#password').val();

    // Vérifier les champs vides
    var isValid = true;

    if (email.trim() === '') {
      $('#email').siblings('.error-message').text('L\'email est requis');
      $('#email').closest('.form-control').addClass('error');
      isValid = false;
    }

    if (password.trim() === '') {
      $('#password').siblings('.error-message').text('Le mot de passe est requis');
      $('#password').closest('.form-control').addClass('error');
      isValid = false;
    }

    if (isValid) {
      // Ajouter la classe 'success' aux champs valides
      $('.form-control').addClass('success');

      // Vérifier le mot de passe
      if (password === '1234') { // Remplacez 'motdepasse' par le mot de passe correct
        // Réinitialiser le nombre de tentatives de mot de passe incorrectes
        passwordAttempts = 0;

        // Envoyer les données du formulaire via AJAX
        $.ajax({
          type: 'POST',
          url: 'traitementt.php',
          data: formData,
          dataType: 'json',
          success: function(response) {
            // Traitement de la réponse en cas de succès
            if (response.success) {
              // Réinitialiser le formulaire
              $('#form')[0].reset();
              // Afficher un message de succès
              $('.success-message').text(response.message);
              // Rediriger vers la page espace.php après 2 secondes
              setTimeout(function() {
                window.location.href = response.redirect;
              }, 2000);
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
      } else {
        // Incrémenter le nombre de tentatives de mot de passe incorrectes
        passwordAttempts++;

        // Afficher un message d'erreur
        $('.error-message').text('Mot de passe incorrect');

        // Vérifier si le nombre de tentatives a atteint la limite
        if (passwordAttempts >= 3) {
          // Désactiver le bouton de soumission
          $('button[type="submit"]').prop('disabled', true);
          // Afficher un message de suspension
          $('.error-message').text('Trop de tentatives de mot de passe incorrectes. Votre compte est suspendu.');
        }
      }
    }
  });
});
</script>



</html
