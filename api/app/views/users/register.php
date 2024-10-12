<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo BASE_URL?>/app/assets/images/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/app/assets/css/styles.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script defer src="<?php echo BASE_URL; ?>/app/assets/js/scripts.js"></script>
    <title>Inscription</title>
</head>
<body>
    <?php include_once APPROOT . 'app/views/partials/nav.php'; ?>
    <div class="container my-5">
        <h2 class="text-center mb-4">Inscription</h2>
        <form 
            action="<?php echo BASE_URL; ?>/User/register" 
            class="row  gap-3 bg-light p-4 rounded shadow mx-auto d-flex justify-content-center" 
            style="max-width: 600px;" 
            method="post"
            enctype="multipart/form-data" 
        >
            <div 
                id="avatarHolder" 
                class="rounded-circle col-md-6 col-sm-12  overflow-hidden avatarHolder "
            >
                <label 
                    for="image" 
                    class="form-label mb-0 upload">Avatar: 
                    <input 
                        type="file" 
                        name="image" 
                        id="image" 
                        class="form-control-file w-100" 
                        onchange="previewProfile(event)"
                    >
                </label> 
                <span class="text-danger"><?php echo htmlspecialchars($image_err ?? ''); ?></span>
            </div>
            <!--  -->
            <div class="col-md-6 col-sm-12">
                <div 
                    class="form-group">
                    <label class="form-label" for="name">Nom:</label>
                    <input 
                        type="text" 
                        name="name" 
                        class="custom_form form-control" 
                        value="<?php echo $data['name']; ?>"
                    >
                    <span class="text-danger"><?php echo $data['name_err']; ?></span>
                </div>
                <div class="">
                    <label class="form-label" for="email">Email:</label>
                    <input 
                        type="email" 
                        name="email" 
                        class="custom_form form-control" 
                        value="<?php echo $data['email']; ?>"
                    >
                    <span class="text-danger"><?php echo $data['email_err']; ?></span>
                </div>
                <div class="">
                    <label class="form-label" for="password">Mot de passe:</label>
                    <input 
                        type="password" 
                        name="password" 
                        class="custom_form form-control" 
                        value="<?php echo $data['password']; ?>"
                    >
                    <span class="text-danger"><?php echo $data['password_err']; ?></span>
                </div>
                <div class="">
                    <label class="form-label" for="confirm_password">Confirmez le mot de passe:</label>
                    <input 
                        type="password" 
                        name="confirm_password" 
                        class="custom_form form-control"
                        value="<?php echo $data['confirm_password']; ?>"
                    >
                    <span class="text-danger"><?php echo $data['confirm_password_err']; ?></span>
                </div>
                <div class="mt-5">
                    <button type="submit" class="btn w-100 yellow_btn">S'inscrire</button>
                </div>
                <div class="mt-5 " style="display: flex; gap: 2rem;">
                    <img class="" style="width: 30px;" src="<?php echo BASE_URL; ?>/app/assets/icons/google.svg" alt="Google icone">
                    <img class="" style="width: 30px;" src="<?php echo BASE_URL; ?>/app/assets/icons/facebook.svg" alt="Facebook icone">
                </div>

            </div>
            
        </form>
    </div>
    <?php include_once APPROOT . 'app/views/partials/footer.php'; ?>

    <script>
        // Set the dynamic image URL
        const dynamicImageUrl = "<?php echo BASE_URL; ?>/app/assets/icons/userAvatarOutline.svg";

        // Get the avatarHolder element by its ID
        const avatarHolder = document.getElementById('avatarHolder');

        // Set the background image dynamically using JS
        avatarHolder.style.backgroundImage = `url('${dynamicImageUrl}')`;

    </script>
</body>
</html>



