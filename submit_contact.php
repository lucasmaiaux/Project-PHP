<?php
$postData = $_POST;

if (
    !isset($postData['email'])
    || !filter_var($postData['email'], FILTER_VALIDATE_EMAIL)
    || empty($postData['name'])
    || empty($postData['firstname'])
    || empty($postData['reason'])
    || empty($postData['message'])
    || trim($postData['message']) === ''
    || strlen(trim($postData['message'])) < 5
) {
    echo ('Il faut un email et un message valides pour soumettre le formulaire.');
    return;
}
?>

<!-- submit_contact.php -->
<?php
$title = "Formulaire";
$description = "Ceci est la page Formulaire";
?>

<?php require('header.php'); ?>

<main>
    <div class="container">
        <h1>Message bien reçu !</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Rappel de vos informations</h5>
                <p class="card-text"><b>Email</b> : <?php echo ($postData['email']); ?></p>
                <p class="card-text"><b>Message</b> : <?php echo (strip_tags($postData['message'])); ?></p>
            </div>
        </div>
</main>


<?php require('footer.php'); ?>