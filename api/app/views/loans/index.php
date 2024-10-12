<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo BASE_URL?>/app/assets/images/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/app/assets/css/styles.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Liste des prtêts</title>
</head>
<body>
    <header>
        <?php include_once APPROOT . 'app/views/partials/nav.php'; ?>
    </header>
    <div class="container my-5">
        <h2 class="mb-4 text-center">Vos prêts</h2>
        <?php if (isset($data['error'])): ?>
            <div class="alert alert-danger text-center w-50 mx-auto my-5"><?php echo $data['error']; ?></div>
        <?php else: ?>
            <?php if (!empty($data['loans'])): ?>
                <div class="table-responsive">
                <table class=" table table-striped">
                    <thead>
                        <tr>
                            <th>Livre</th>
                            <th>Nom de l'empreinteur</th>
                            <th>Adresse de l'empreinteur</th>
                            <th>Numéro de l'empreinteur</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['loans'] as $loan): ?>
                            <tr>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/Book/show/<?php echo $loan['book_id'] ?? '1'; ?>?referrer=<?php echo urlencode($_SERVER['REQUEST_URI'])?>" class="text-primary">
                                        <?php echo htmlspecialchars($loan['book_title'] ?? 'Solutions'); ?>
                                    </a>
                                </td>
                                <td><?php echo htmlspecialchars($loan['borrower_name']); ?></td>
                                <td><?php echo htmlspecialchars($loan['borrower_adress']); ?></td>
                                <td><?php echo htmlspecialchars($loan['borrower_num']); ?></td>
                                <td>
                                    <a href="<?php echo BASE_URL; ?>/Loan/show/<?php echo $loan['id'];?>?referrer=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" class="btn btn-info btn-sm">Voir</a>
                                    <a href="<?php echo BASE_URL; ?>/Loan/edit/<?php echo $loan['id']; ?>" class="btn btn-warning btn-sm">Editer</a>
                                    <a href="<?php echo BASE_URL; ?>/Loan/delete/<?php echo $loan['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce prêt?');">Supprimer</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                </div>
            <?php else: ?>
                <p class="text-center text-danger alert alert-danger w-50 mx-auto">Aucun prêt trouvés.</p>
            <?php endif; ?>
        <?php endif; ?>
        
    </div>
    <?php include_once APPROOT . 'app/views/partials/footer.php'; ?>
</html>


