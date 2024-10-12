<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo BASE_URL?>/app/assets/images/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/app/assets/css/styles.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Détails prêt</title>
</head>
<body>
    <header>
        <?php include_once APPROOT . 'app/views/partials/nav.php'; ?>
    </header>
    <div class="container my-5">
        <h2 class="text-center mb-4">Détails du prêt</h2>
        
        <?php if (isset($data['error'])): ?>
            <div class="alert alert-danger"><?php echo $data['error']; ?></div>
        <?php else: ?>
            <div class="card shadow w-50 mx-auto">
                <div class="row mx-auto">
                    <div class="card-body col-6">
                        <p class="card-text"><strong>Nom de l'empreinteur:</strong> <?php echo htmlspecialchars($data['loan']['borrower_name']); ?></p>
                        <p class="card-text"><strong>Adresse de l'empreinteur:</strong> <?php echo htmlspecialchars($data['loan']['borrower_adress']); ?></p>
                        <p class="card-text"><strong>Numéro de l'empreinteur</strong> <?php echo htmlspecialchars($data['loan']['borrower_num']); ?></p>
                        <p class="card-text"><strong>Description:</strong> <?php echo htmlspecialchars($data['loan']['description']); ?></p>
                        <a href="<?php echo BASE_URL; ?>/Loan/edit/<?php echo $data['loan']['id']; ?>" class="btn btn-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M240-360h280l80-80H240v80Zm0-160h240v-80H240v80Zm-80-160v400h280l-80 80H80v-560h800v120h-80v-40H160Zm756 212q5 5 5 11t-5 11l-36 36-70-70 36-36q5-5 11-5t11 5l48 48ZM520-120v-70l266-266 70 70-266 266h-70ZM160-680v400-400Z"/></svg>                                
                            Editer
                        </a>
                        <a href="<?php echo BASE_URL; ?>/Loan/delete/<?php echo $data['loan']['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce prêt?');">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>                                
                            Supprimer
                        </a>
                        <?php $referrer = isset($_GET['referrer']) ? $_GET['referrer'] : BASE_URL . '/Loan'; ?>
                        <a href="<?php echo $referrer; ?>" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M400-80 0-480l400-400 71 71-329 329 329 329-71 71Z"/></svg>                            
                            Retour
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <?php include_once APPROOT . 'app/views/partials/footer.php'; ?>
</body>
</html>

