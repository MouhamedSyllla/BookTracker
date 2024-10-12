<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo BASE_URL?>/app/assets/images/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/app/assets/css/styles.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Books List</title>
</head>
<body>
    <header>
        <?php include_once APPROOT . 'app/views/partials/nav.php'; ?>
    </header>

    <div class="container my-5">
    <?php if (isset($error)): ?>
        <div class="alert alert-danger text-center my-5"><?php echo htmlspecialchars($error); ?></div>
    <?php else: ?>
        <h2 class=" mb-4 text-center ">Vos livres disponibles</h2>
        <?php if (!empty($books)): ?>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead >
                        <tr>
                            <th>Titre</th>
                            <th>Auteur</th>
                            <th>Année de publication</th>
                            <th>Genre</th>
                            <th>Ajouté le</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($books as $book): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($book['title']); ?></td>
                                <td><?php echo htmlspecialchars($book['author']); ?></td>
                                <td><?php echo htmlspecialchars($book['published_year']); ?></td>
                                <td><?php echo htmlspecialchars($book['genre']); ?></td>
                                <td><?php echo htmlspecialchars(date('Y-m-d', strtotime($book['created_at']))); ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/Book/show/<?php echo $book['id']; ?>" class="btn btn-info btn-sm">Voir</a>
                                    <?php if (isLoggedIn() && $_SESSION['user_id'] === $book['owner_id']): ?>
                                            <a href="<?php echo BASE_URL; ?>/Loan/create/<?php echo $book['id']; ?>" class="btn btn-warning btn-sm">Prêter</a>
                                            <a href="<?php echo BASE_URL; ?>/Book/edit/<?php echo $book['id']; ?>" class="btn btn-warning btn-sm">Modifier</a>
                                            <a href="<?php echo BASE_URL; ?>/Book/delete/<?php echo $book['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre?');">Supprimer</a>
                                    <?php else: ?>
                                        <?php $DisableClass = "" ?>
                                        <?php if (!isLoggedIn()){
                                            $DisableClass = " text-muted disabled";
                                        }
                                        ?>
                                            <a href="#" class="btn btn-warning <?php echo $DisableClass ?>  ">Empreinter</a>
                                    <?php endif; ?> 
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php else: ?>
            <p class="text-center text-danger alert alert-danger text-center w-50 mx-auto my-5">Aucun livre disponible.</p>
        <?php endif; ?>
    <?php endif; ?>    
</div>

    <?php include_once APPROOT . 'app/views/partials/footer.php'; ?>

</body>
</html>
