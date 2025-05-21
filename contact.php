<!-- index.php -->
<?php
$title = "Contact";
$description = "Ceci est la page Contact";
?>

<?php require('header.php'); ?>

<?php
session_start();
// Initialisation des variables
$errors = [];
$successMessage = '';
$data = $_SESSION['form_data'] ?? [
    'gender' => '',
    'name' => '',
    'firstname' => '',
    'email' => '',
    'reason' => '',
    'message' => '',
    'fileToUpload' => '',
];

// Liste des options valides pour éviter la triche
$validGenders = ['Homme', 'Femme', 'Dinosaure', 'Hélicoptère de combat'];
$validReasons = ['radio_choice1', 'radio_choice2', 'radio_choice3'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Nettoyage basique
    foreach ($data as $key => $value) {
        $data[$key] = htmlspecialchars(trim($_POST[$key] ?? ''));
    }

    /*
    // Validation (Original)
    if (!in_array($data['gender'], $validGenders)) {
        $errors['gender'] = "Veuillez choisir une civilité valide.";
    }

    if (strlen($data['name']) < 1) {
        $errors['name'] = "Le nom est obligatoire.";
    }

    if (strlen($data['firstname']) < 1) {
        $errors['firstname'] = "Le prénom est obligatoire.";
    }

    if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'email n'est pas valide.";
    }

    if (!in_array($data['reason'], $validReasons)) {
        $errors['reason'] = "Veuillez choisir une raison valide.";
    }

    if (strlen($data['message']) < 5) {
        $errors['message'] = "Le message doit contenir au moins 5 caractères.";
    }
    */

    // Validation (Filter Input)
    if (!filter_has_var(INPUT_POST, "gender") || empty($data['gender'])) {
        $errors['gender'] = "Veuillez choisir une civilité valide.";
    }

    if (!filter_has_var(INPUT_POST, "name") || empty($data['name'])) {
        $errors['name'] = "Le nom est obligatoire.";
    }

    if (!filter_has_var(INPUT_POST, "firstname") || empty($data['firstname'])) {
        $errors['firstname'] = "Le prénom est obligatoire.";
    }

    // Remove all illegal characters from email
    $data['email'] = filter_var($data['email'], FILTER_SANITIZE_EMAIL);


    if (!filter_has_var(INPUT_POST, "email") || empty($data['email'])) {
        $errors['email'] = "L'email n'est pas rentré.";
    }
    else if (filter_var($data['email'], FILTER_VALIDATE_EMAIL) === false) {
        $errors['email'] = $data['email'] . " n'est pas une addresse valide";
    }

    if (!filter_has_var(INPUT_POST, "reason") || empty($data['reason'])) {
        $errors['reason'] = "Veuillez choisir une raison valide.";
    }

    if (!filter_has_var(INPUT_POST, "message") || empty($data['message'])) {
        $errors['message'] = "Le message doit contenir au moins 5 caractères.";
    }

    $target_dir = "storage/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    //echo $target_file;
    if (file_exists($target_file)){
        $errors['file'] = "The file already exists";
    } else {
        if (!move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $errors['file'] = "Error uploading the file.";
        }
    }

    if (empty($errors)) {
        $successMessage = "Formulaire envoyé avec succès !";

        // Sauvegarde dans un fichier avec les clés visibles
        $log = '<?php $data = ' . var_export($data, true) . ';';
        file_put_contents('form_saves/form_' . time() . '.php', $log);

        unset($_SESSION['form_data']); // On efface les données après succès
    } else {
        $_SESSION['form_data'] = $data; // On garde les données en cas d'erreur
    }
}
?>

<main>
    <h1>Formulaire de contact</h1>

    <form action="index.php?page=contact" method="POST" enctype="multipart/form-data">
        <div>
            <label for="gender">Civilité</label>
            <select name="gender" id="gender-select">
                <option value="">--Civilité--</option>
                <?php foreach ($validGenders as $gender): ?>
                    <option value="<?= $gender ?>" <?= $data['gender'] === $gender ? 'selected' : '' ?>><?= $gender ?></option>
                <?php endforeach; ?>
            </select>
            <span style="color:red"><?= $errors['gender'] ?? '' ?></span>
        </div>
        <div>
            <label for="name">Nom</label>
            <input type="text" name="name" value="<?= $data['name'] ?>">
            <span style="color:red"><?= $errors['name'] ?? '' ?></span>
        </div>
        <div>
            <label for="firstname">Prénom</label>
            <input type="text" name="firstname" value="<?= $data['firstname'] ?>">
            <span style="color:red"><?= $errors['firstname'] ?? '' ?></span>
        </div>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" value="<?= $data['email'] ?>">
            <span style="color:red"><?= $errors['email'] ?? '' ?></span>
        </div>

        <!-- Zone boutons radio -->
        <fieldset>
            <legend>Raison du contact</legend>

            <div>
                <input type="radio" id="radio_choice1" name="reason" value="radio_choice1"
                    <?= $data['reason'] === 'radio_choice1' ? 'checked' : '' ?> />
                <label for="radio_choice1">Service comptable</label>
            </div>

            <div>
                <input type="radio" id="radio_choice2" name="reason" value="radio_choice2"
                    <?= $data['reason'] === 'radio_choice2' ? 'checked' : '' ?> />
                <label for="radio_choice2">Le concierge</label>
            </div>

            <div>
                <input type="radio" id="radio_choice3" name="reason" value="radio_choice3"
                    <?= $data['reason'] === 'radio_choice3' ? 'checked' : '' ?> />
                <label for="radio_choice3">Facebook</label>
            </div>

            <span style="color:red"><?= $errors['reason'] ?? '' ?></span>
        </fieldset>

        <div>
            <label for="message">Votre message</label>
            <textarea placeholder="Exprimez vous" name="message"><?= $data['message'] ?></textarea>
            <span style="color:red"><?= $errors['message'] ?? '' ?></span>
        </div>

        <div>
            <label for="file">Ajouter un fichier</label>
            <input type="file" name="fileToUpload" id="fileToUpload">
            <span style="color:red"><?= $errors['file'] ?? '' ?></span>
        </div>

        <button type="submit">Envoyer</button>
    </form>

    <?php if (!empty($successMessage)): ?>
        <div style="color: green; margin-top: 40px;">
            <?= $successMessage ?>
        </div>
    <?php endif; ?>


</main>

<?php require('footer.php'); ?>