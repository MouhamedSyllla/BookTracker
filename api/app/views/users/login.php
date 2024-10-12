<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo BASE_URL?>/app/assets/images/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo BASE_URL?>/app/assets/css/styles.css">
    <title>Connection</title>
</head>
<body>
    <?php include_once APPROOT . 'app/views/partials/nav.php'; ?>

    <div class="container my-5">
        <h2 class="text-center mb-4">Welcome back</h2>
        <form 
            action="<?php echo BASE_URL; ?>/User/login" 
            class="row gap-3 bg-light p-4 rounded shadow mx-auto d-flex justify-content-center" 
            style="max-width: 400px;" 
            method="post"
        >
            <div class="">
                <label class="form-label" for="email">Email:</label>
                <input 
                    type="email" 
                    name="email" 
                    class="custom_form form-control " 
                    value="<?php echo $data['email']; ?>"
                >
                <span class="text-danger"><?php echo $data['email_err']; ?></span>
            </div>
            <div class="">
                <label for="password">Mot de passe:</label>
                <input 
                    type="password" 
                    name="password" 
                    class="custom_form form-control" 
                    value="<?php echo $data['password']; ?>"
                >
                <span class="text-danger"><?php echo $data['password_err']; ?></span>
            </div>
            <div class="mt-4">
                <button type="submit" class="btn w-100 yellow_btn">Se connecter</button>
            </div>
            <div class="mt-4  d-flex justify-content-center" style="display: flex; gap: 2rem;">
                <img class="" style="width: 30px;" src="<?php echo BASE_URL; ?>/app/assets/icons/google.svg" alt="Google icone">
                <img class="" style="width: 30px;" src="<?php echo BASE_URL; ?>/app/assets/icons/facebook.svg" alt="Facebook icone">
            </div>
        </form>
    </div>
    <?php include_once APPROOT . 'app/views/partials/footer.php'; ?>
</body>
</html>

