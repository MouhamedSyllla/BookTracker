<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/hover.css/2.3.1/css/hover-min.css">
    <link rel="icon" href="<?php echo BASE_URL?>/app/assets/images/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/app/assets/css/styles.css">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/app/assets/css/hero_section.css">

</head>
<body>
    <header>
        <!-- Navbar -->
        <?php include_once APPROOT . 'app/views/partials/nav.php'; ?>
    </header>

    <main class="main">
       <?php if(isLoggedIn()): ?>
            <!-- User hero section -->
            <section class="hero">
                <div class="container ">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 mx-md-auto ml-md-4 col-sm-12 order-sm-1 order-lg-2" data-aos="fade-up" data-aos-duration="3000">
                            <img class="img-fluid" src="<?php echo BASE_URL ?>/app/assets/images/user_hero_image.png" alt="">
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 order-sm-2 order-lg-1">
                            <div class="cpoy" data-aos="fade-up" data-aos-duration="3000">
                                <div class="text-hero-bold text-center">
                                    Bienvenue, <span id="dynamic_name"><?php echo $_SESSION['user_name'] ?></span>!
                                </div>
                                <div class="text-hero-regular text-center">
                                    Nous sommes ravis de vous retrouver sur votre plateforme
                                    de <span>gestion de livres</span>. 
                                    Ici, vous pouvez facilement <span>ajouter</span> de nouveaux
                                    titres à votre collection, <span>modifier</span> les
                                    informations de vos ouvrages existants, ou <span>supprimer</span>
                                    ceux dont vous n'avez plus besoin. En quelques clics, consultez
                                    l'historique des prêts, et explorez votre bibliothèque à travers 
                                    des <span>recherches ciblées</span>. Tout est pensé pour vous offrir 
                                    une expérience de gestion intuitive et agréable.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </section>

        <?php else: ?>
            
            <!-- Visitor hero section -->
            <section class="hero">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 col-md-8 mx-md-auto col-sm-12 order-sm-1 order-lg-2" data-aos="fade-up" data-aos-duration="3000">
                            <img style="border-radius: 100% 150px 0px 0px;" class="img-fluid " src="<?php echo BASE_URL ?>/app/assets/images/bookshelf2.jpg" alt="">
                        </div>
                        <div class="col-lg-6 col-md-12 col-sm-12 order-sm-2 order-lg-1">
                            <div class="cpoy" data-aos="fade-up" data-aos-duration="3000">
                                <div class="text-hero-bold text-center">
                                    Bienvenue dans <span id="dynamic_name">BookTracker</span>
                                    Votre gestionnaire de livre par excellence
                                </div>
                                <div class="text-hero-regular text-center">
                                    Bienvenue sur notre plateforme de gestion de collections de livres,
                                    conçue pour vous offrir un contrôle total sur votre bibliothèque personnelle.
                                    Que vous soyez un passionné de lecture ou un collectionneur avide, notre outil
                                    vous permet d'organiser facilement vos livres, de suivre vos emprunts, et d'éviter
                                    les doublons lors de vos achats. Avec une interface intuitive et des fonctionnalités
                                    avancées, vous pouvez désormais gérer votre collection en toute simplicité et profiter
                                    pleinement de votre passion pour la lecture.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </section>

        <?php endif ?>     

            <!-- Derniers livres ajoutés -->
            <h1 class="text-center" data-aos="fade-up" data-aos-duration="3000">Explorer les livres y compris ceux ajoutés par les autres</h1>
            <?php if(!empty($books)): ?>
                
                <div class="container mx-auto" style="margin-top: 100px; display: flex; flex-direction: column; gap: 70px">

                    <div style="margin: auto" class="book_row row justify-content-center ">
                        <?php $i = 0 ?>
                        <?php foreach ($books as $book): $i++?>
                            <!--  -->
                            <div class=" book mb-4" style="width: 200px;" data-aos="fade-up" data-aos-duration="<?php echo $i * 1000 ?>" >
                                <a style="width: 150px;" class="hvr-grow" href="<?php echo BASE_URL; ?>/Book/show/<?php echo $book['id']; ?>?referrer=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">
                                    <div class="info text-center">
                                        <img 
                                            style="width: 100%; height:250px; border-radius: 20px;"
                                            src="<?php echo BASE_URL . htmlspecialchars($book['cover']); ?>" 
                                            alt="bookCover1">
                                        <h1 class="h5"><?php echo htmlspecialchars($book['title']) ?></h1>
                                        <p><?php echo htmlspecialchars($book['author']) ?></p>
                                    </div>
                                </a>
                            </div>
                            <div class=" book mb-4" style="width: 200px;" data-aos="fade-up" data-aos-duration="<?php echo $i * 1000 ?>" >
                                <a style="width: 150px;" class="hvr-grow" href="<?php echo BASE_URL; ?>/Book/show/<?php echo $book['id']; ?>?referrer=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">
                                    <div class="info text-center">
                                        <img 
                                            style="width: 100%; height:250px; border-radius: 20px;"
                                            src="<?php echo BASE_URL . htmlspecialchars($book['cover']); ?>" 
                                            alt="bookCover1">
                                        <h1 class="h5"><?php echo htmlspecialchars($book['title']) ?></h1>
                                        <p><?php echo htmlspecialchars($book['author']) ?></p>
                                    </div>
                                </a>
                            </div>
                            <div class=" book mb-4" style="width: 200px;" data-aos="fade-up" data-aos-duration="<?php echo $i * 1000 ?>" >
                                <a style="width: 150px;" class="hvr-grow" href="<?php echo BASE_URL; ?>/Book/show/<?php echo $book['id']; ?>?referrer=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">
                                    <div class="info text-center">
                                        <img 
                                            style="width: 100%; height:250px; border-radius: 20px;"
                                            src="<?php echo BASE_URL . htmlspecialchars($book['cover']); ?>" 
                                            alt="bookCover1">
                                        <h1 class="h5"><?php echo htmlspecialchars($book['title']) ?></h1>
                                        <p><?php echo htmlspecialchars($book['author']) ?></p>
                                    </div>
                                </a>
                            </div>
                            <div class=" book mb-4" style="width: 200px;" data-aos="fade-up" data-aos-duration="<?php echo $i * 1000 ?>" >
                                <a style="width: 150px;" class="hvr-grow" href="<?php echo BASE_URL; ?>/Book/show/<?php echo $book['id']; ?>?referrer=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>">
                                    <div class="info text-center">
                                        <img 
                                            style="width: 100%; height:250px; border-radius: 20px;"
                                            src="<?php echo BASE_URL . htmlspecialchars($book['cover']); ?>" 
                                            alt="bookCover1">
                                        <h1 class="h5"><?php echo htmlspecialchars($book['title']) ?></h1>
                                        <p><?php echo htmlspecialchars($book['author']) ?></p>
                                    </div>
                                </a>
                            </div>
                            
                            <!--  -->
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php else: ?>
                <p class="text-center text-danger"> Aucun livre disponible </p>
            <?php endif; ?>   
            </section>
            

    </main>

    <?php include_once APPROOT . 'app/views/partials/footer.php'; ?>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
