$(document).ready(function() {
    $('#form').submit(function(event) {
        event.preventDefault(); // Empêche le rechargement de la page

        // Réinitialiser les messages d'erreur et les styles des champs
        $('.error-message').text('');
        $('.form-control').removeClass('error');

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
        } else if (password.length < 5) {
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

        if (!isValid) {
            return; // Arrêter la soumission du formulaire si les champs ne sont pas valides
        }

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
    });
});