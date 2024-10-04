<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo BASE_URL?>/app/assets/images/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/app/assets/css/styles.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Modifier pret</title>
</head>
<body>
    <header>
        <?php include_once APPROOT . 'app/views/partials/nav.php'; ?>    
    </header>
    <div class="container my-5">
    <h2 class="text-center mb-4">Modifier le prêt</h2>
    
    <?php if (isset($data['error'])): ?>
        <div class="alert alert-danger"><?php echo $data['error']; ?></div>
    <?php endif; ?>
    
    <form action="<?php echo BASE_URL; ?>/Loan/edit/<?php echo $data['loan']['id']; ?>" method="post" class="bg-light p-4 rounded shadow mx-auto" style="max-width: 400px;">
        
        <div class="mb-3">
            <label for="borrower_name" class=" form-label">Nom de l'empreinteur:</label>
            <input type="text" name="borrower_name" class="custom_form form-control" value="<?php echo htmlspecialchars($data['loan']['borrower_name'] ?? ''); ?>">
            <span class="text-danger"><?php echo htmlspecialchars($data['borrower_name_err'] ?? ''); ?></span>
        </div>
        
        <div class="mb-3">
            <label for="borrower_adress" class="form-label">Address de l'empreinteur:</label>
            <input type="text" name="borrower_adress" class="custom_form form-control" value="<?php echo htmlspecialchars($data['loan']['borrower_adress'] ?? ''); ?>">
            <span class="text-danger"><?php echo htmlspecialchars($data['borrower_adress_err'] ?? ''); ?></span>
        </div>
        
        <div class="mb-3">
            <label for="borrower_num" class="form-label">Numéro de l'empreinteur:</label>
            <input type="text" name="borrower_num" class="custom_form form-control" value="<?php echo htmlspecialchars($data['loan']['borrower_num'] ?? ''); ?>">
            <span class="text-danger"><?php echo htmlspecialchars($data['borrower_num_err'] ?? ''); ?></span>
        </div>

        <div class="mb-3">
            <label for="return_date" class="form-label">Date de retour:</label>
            <input type="date" name="return_date" class="custom_form form-control" value="<?php echo htmlspecialchars($data['loan']['return_date'] ?? ''); ?>">
            <span class="text-danger"><?php echo htmlspecialchars($data['return_date_err'] ?? ''); ?></span>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description:</label>
            <textarea name="description" class="custom_form form-control"><?php echo htmlspecialchars($data['loan']['description'] ?? ''); ?></textarea>
            <span class="text-danger"><?php echo htmlspecialchars($data['description_err'] ?? ''); ?></span>
        </div>
        
        <button type="submit" class="btn yellow_btn w-50">Modifier</button>
    </form>
</div>
<?php include_once APPROOT . 'app/views/partials/footer.php'; ?>

</body>
</html>