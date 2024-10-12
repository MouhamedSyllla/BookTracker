<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">
    <link rel="icon" href="<?php echo BASE_URL?>/app/assets/images/logo.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/app/assets/css/styles.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</head>
<body>
    <header>
        <!-- Navbar -->
        <?php include_once APPROOT . 'app/views/partials/nav.php'; ?>
    </header>

    <main class="main container my-5">
            <!-- Livres trouvés -->
            <h1 class="text-center mb-4 my-5 ">Livres trouvés</h1>

            <?php if(!empty($books)): ?>
                <div class="container mt-5" >
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
                </div>
            <?php endif; ?>  
            <?php if (isset($error)): ?>
                    <p class="error text-center  text-danger alert alert-danger w-50 mx-auto my-5">
                        <?php echo htmlspecialchars($error); ?>
                        <i class="fa-sharp-duotone fa-solid fa-magnifying-glass text-secondary mx-2 " style="font-size: 1rem"></i>
                        <!-- <i class="fa-duotone fa-magnifying-glass text-secondary mx-2 " style="font-size: 1rem"></i> -->
                    </p>
            <?php endif; ?>
 
            </section>

            <!-- Prêts trouvés -->
            <?php if(!empty($loans)): ?>
                <h1 class="text-center mb-4">Prêts trouvés</h1>
                <?php foreach ($loans as $loan): ?>
                    <section class="hidden">
                        <a href="<?php echo BASE_URL; ?>/Loan/show/<?php echo $loan['id']; ?>?referrer=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>" class="text-secondary">Prêt</a>
                    </section>
                <?php endforeach; ?>
            <?php endif; ?>   
            </section>
    </main>

    <?php include_once APPROOT . 'app/views/partials/footer.php'; ?>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>

</body>
</html>
