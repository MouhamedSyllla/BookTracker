<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo BASE_URL?>/app/assets/images/logo.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/app/assets/css/styles.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <title>Profile</title>
</head>
<body>
    <header>
        <!-- Navbar -->
        <?php include_once APPROOT . 'app/views/partials/nav.php'; ?>
    </header>

    <main class="main contianer" style="margin-top: 100px; display: flex; flex-direction: column; gap: 70px">
            <!-- Tous les livres ajoutés -->
            <h1 class="text-center" data-aos="fade-up" data-aos-duration="3000">Ayez un aperçu de chaque livre de votre collection</h1>
            <?php if(!empty($books)): ?>
                <div class="container" >
                    <div class="book_row row justify-content-center">
                        <?php $i = 0 ?>
                        <?php foreach ($books as $book): $i++?>
                            
                            <div class=" mb-4" style="width: 200px;" data-aos="fade-up" data-aos-duration="<?php echo 1000*$i ?>">
                                <a style="width: 150px;" class="hvr-grow" href="<?php echo BASE_URL; ?>/Book/show/<?php echo $book['id']; ?>?referrer=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">
                                    <div class="info text-center">
                                        <img 
                                            style="width: 100%; height: 250px; border-radius: 20px;"
                                            src="<?php echo BASE_URL . htmlspecialchars($book['cover']); ?>" 
                                            alt="bookCover1">
                                        <h1 class="h5"><?php echo htmlspecialchars($book['title']) ?></h1>
                                        <p><?php echo htmlspecialchars($book['author']) ?></p>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                    <div class=" w-25 mb-5  " style="margin-left: 100px"> 
                        <a class=" btn btn-warning text-center ft-lg" href="<?php echo BASE_URL; ?>/Book" >
                            Voir tous
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="m298-262-56-56 121-122H80v-80h283L242-642l56-56 218 218-218 218Zm222-18v-80h360v80H520Zm0-320v-80h360v80H520Zm120 160v-80h240v80H640Z"/></svg>                           
                        </a>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-center alert alert-danger w-50 mx-auto mb-4 text-danger" > Aucun livre disponible </p>
            <?php endif; ?>   
            
            </section>
            <!-- Tous les livres pretes -->
    </main>
    <?php include_once APPROOT . 'app/views/partials/footer.php'; ?>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>
</html>
