<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo BASE_URL?>/app/assets/images/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/app/assets/css/styles.css">
    <title>A propos</title>
</head>
<body>
    <?php include_once APPROOT . '/app/views/partials/nav.php' ?>
    <div class="container py-5">
    <h1 class="text-center mb-4">À propos de Book Tracker</h1>

    <section class="mb-5">
        <h2 class="">Notre Mission</h2>
        <p>
            Bienvenue sur <strong>Book Tracker</strong>, votre destination pour
            la gestion simplifiée de votre collection de livres.
        </p>
        <p>
            Nous sommes dédiés à fournir un outil intuitif et efficace pour aider
            les bibliophiles, les bibliothécaires et les amateurs de lecture à 
            organiser, suivre et profiter de leurs collections de livres. 
            Notre plateforme vous permet de gérer facilement votre bibliothèque 
            personnelle, de suivre les prêts de livres, et de découvrir de nouveaux ouvrages.
        </p>
    </section>

    <section class="mb-5">
        <h2 class="">Pourquoi nous choisir ?</h2>
        <ul class="list-unstyled">
            <li class="mb-3"><strong>Facilité d'utilisation :</strong> Notre interface conviviale rend la gestion de votre collection de livres simple et agréable, même pour les débutants.</li>
            <li class="mb-3"><strong>Gestion complète des livres :</strong> Ajoutez, modifiez, et supprimez des livres de votre collection en quelques clics. Suivez les détails importants tels que le titre, l'auteur, l'année de publication, et l'état du livre.</li>
            <li class="mb-3"><strong>Suivi des prêts :</strong> Gardez une trace des livres que vous avez prêtés à des amis, avec des informations sur l'emprunteur, les dates de prêt et de retour.</li>
            <li class="mb-3"><strong>Sécurité des données :</strong> Vos données sont sécurisées et protégées, vous permettant de gérer votre collection en toute tranquillité.</li>
        </ul>
    </section>

    <section class="mb-5">
        <h2 class="">Notre Équipe</h2>
        <p>
            Nous sommes une équipe passionnée de technologie et de littérature, 
            travaillant sans relâche pour améliorer et enrichir notre plateforme. 
            Notre objectif est de rendre la gestion de livres aussi simple que 
            possible, afin que vous puissiez vous concentrer sur ce que vous aimez 
            le plus.
        </p>
    </section>

    <section class="mb-5">
        <h2 class="">Contactez-nous</h2>
        <p>
            Si vous avez des questions, des suggestions, ou des commentaires, 
            n'hésitez pas à nous contacter à l'adresse 
            suivante : <strong>contact@votresite.com</strong>. 
            Nous serions ravis d'avoir de vos nouvelles !
        </p>
    </section>

    <section class="mb-5 text-center">
        <p>
            Merci d'avoir choisi <strong>Book Tracker</strong> pour la gestion
            de votre collection de livres. Ensemble, faisons en sorte que chaque 
            livre compte !
        </p>
    </section>
</div>

    <?php include_once APPROOT . '/app/views/partials/footer.php' ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>

