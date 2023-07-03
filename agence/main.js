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
        if (password === 'motdepasse') { // Remplacez 'motdepasse' par le mot de passe correct
          // Réinitialiser le nombre de tentatives de mot de passe incorrectes
          passwordAttempts = 0;
  
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