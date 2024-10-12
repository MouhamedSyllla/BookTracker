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
    <title>Modifier livre</title>
</head>
<body>
    <header>
        <?php include_once APPROOT . 'app/views/partials/nav.php'; ?>
    </header>

    <main class="container my-5">
        <h1 class="text-center mb-4">Modifier le livre</h1>
        
        <?php if (isset($data['error'])): ?>
            <div class="alert alert-danger"><?php echo $data['error']; ?></div>
        <?php endif; ?>
            <form 
                action="<?php echo BASE_URL; ?>/Book/edit/<?php echo $book['id']; ?>" 
                method="post" 
                enctype="multipart/form-data" 
                class="row gap-5 bg-light p-4 rounded shadow mx-auto" 
                style="max-width: 600px;"
            >
                <div class="col-md-6 col-sm-12 imgholder bookCoverHolder">
                    <label 
                        for="image" 
                        class="form-label mb-0 upload">Image de couverture: 
                        <input 
                            type="file" 
                            name="image" 
                            id="image" 
                            class="form-control-file w-100" 
                            onchange="previewImage(event)"
                        >
                        <span>+</span>
                    </label> 
                    <img 
                        id="imagePreview" 
                        src="<?php echo BASE_URL . $book['cover']; ?>" 
                        alt="Image Preview" 
                        class="" 
                        style="width: 182px; height: 304px; border-radius: 20px;">
                    <span class="text-danger"><?php echo htmlspecialchars($image_err ?? ''); ?></span>
                </div>

                <div class="col-md-6 col-sm-12">
                    <div class="mb-3">
                        <label 
                            for="title" 
                            class="form-label">Titre:
                        </label>
                        <input 
                            type="text" 
                            name="title" 
                            id="title" 
                            class="custom_form form-control" 
                            value="<?php echo htmlspecialchars($book['title'] ?? ''); ?>"
                        >
                        <span class="text-danger"><?php echo htmlspecialchars($book['title_err'] ?? ''); ?></span>
                    </div>

                    <div class="mb-3">
                        <label 
                            for="author" 
                            class="form-label"
                        >
                            Auteur:
                        </label>
                        <input 
                            type="text" 
                            name="author" 
                            id="author" 
                            class="custom_form form-control" 
                            value="<?php echo htmlspecialchars($book['author'] ?? ''); ?>"
                        >
                        <span class="text-danger"><?php echo htmlspecialchars($book['author_err'] ?? ''); ?></span>
                    </div>

                    <div class="mb-3">
                        <label 
                            for="published_year" 
                            class="form-label"
                        >
                            Année de publication:
                        </label>
                        <input 
                            type="text" 
                            name="published_year" 
                            id="published_year" 
                            class="custom_form form-control" 
                            value="<?php echo htmlspecialchars($book['published_year'] ?? ''); ?>"
                        >
                        <span class="text-danger"><?php echo htmlspecialchars($book['published_year_err'] ?? ''); ?></span>
                    </div>

                    <div class="mb-3">
                        <label 
                            for="genre" 
                            class="form-label"
                        >
                            Genre:
                        </label>
                        <input 
                            type="text" 
                            name="genre" 
                            id="genre" 
                            class="custom_form form-control" 
                            value="<?php echo htmlspecialchars($book['genre'] ?? ''); ?>"
                        >
                        <span class="text-danger"><?php echo htmlspecialchars($book['genre_err'] ?? ''); ?></span>
                    </div>

                    <div class="mb-3">
                        <label 
                            for="description" 
                            class="form-label"
                        >
                            Description:
                        </label>
                        <textarea 
                            name="description" 
                            id="description" 
                            class="custom_form form-control"><?php echo htmlspecialchars($book['description'] ?? ''); ?>
                        </textarea>
                        <span class="text-danger"><?php echo htmlspecialchars($book['description_err'] ?? ''); ?></span>
                    </div>
                </div> 

                <button  
                    type="submit" 
                    class=" btn btn-md w-50 yellow_btn"
                >
                    Modifier
                </button>

            </form>
</main>
    <?php include_once APPROOT . 'app/views/partials/footer.php'; ?>
</body>
</html>
