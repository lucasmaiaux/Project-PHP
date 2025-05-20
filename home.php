<!-- index.php -->
<?php
$title = "Index";
$description = "Ceci est la page Index";
?>

<?php require('header.php'); ?>

<main>
    <h1>Bienvenue sur mon site web</h1>
    <h2>Page d'Accueil</h2>
    <p>Bienvenue sur la page d'accueil de mon site web.</p>

    <form action="submit_contact.php" method="GET">
        <div>
            <label for="email">Email</label>
            <input type="email" name="email">
        </div>
        <div>
            <label for="message">Votre message</label>
            <textarea placeholder="Exprimez vous" name="message"></textarea>
        </div>
        <button type="submit">Envoyer</button>
    </form>


</main>

<?php require('footer.php'); ?>