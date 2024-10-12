<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?php echo BASE_URL?>/app/assets/images/logo.ico">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?php echo BASE_URL?>/app/assets/css/styles.css">
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Détails livre</title>
</head>
<body>
    <header>
        <?php include_once APPROOT . 'app/views/partials/nav.php'; ?>
    </header>

<div class="container my-5">
    <h2 class="text-center mb-4">Détails du livre</h2>
    
    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
    <?php else: ?>
        <div class="card shadow my-5">
            <div class="card-body row mx-center" style="display: flex; justify-content: center; align-items: center;  gap: 50px;">
                <div 
                    class="col-md-6 mt-1" 
                    style="width: 182px;
                            height: 304px;
                            border-radius: 20px;
                            position: relative;
                            overflow: hidden;"
                    >
                    <img 
                        style="width: 182px; height: 304px; border-radius: 20px;"
                        style="object-fit: cover" 
                        src="<?php echo BASE_URL . htmlspecialchars($book['cover']);?>" alt="bookCover1"
                    >
                </div>

                <div class="col-sm-12 col-md-6">
                    <h3 class="card-title"><?php echo htmlspecialchars($book['title']); ?></h3>
                    <p class="card-text"><strong>Auteur:</strong> <?php echo htmlspecialchars($book['author']); ?></p>
                    <p class="card-text"><strong>Année de publication:</strong> <?php echo htmlspecialchars($book['published_year']); ?></p>
                    <p class="card-text"><strong>Genre:</strong> <?php echo htmlspecialchars($book['genre']); ?></p>
                    <p class="card-text"><strong>Description:</strong> <?php echo htmlspecialchars($book['description']); ?></p>
                    <p class="card-text"><strong>Statut:</strong> <?php echo htmlspecialchars($book['status'] ?? 'Null'); ?></p>
                    
                    <div class=" mt-5 d-md-flex gap-2" >
                        <?php if (isLoggedIn() && $_SESSION['user_id'] === $book['owner_id']): ?>
                            <a href="<?php echo BASE_URL; ?>/Loan/create/<?php echo $book['id']; ?>" class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#1E124A"><path d="M840-680H600v-80h240v80ZM200-120v-640q0-33 23.5-56.5T280-840h240v80H280v518l200-86 200 86v-278h80v400L480-240 200-120Zm80-640h240-240Z"/></svg>
                                Prêter
                            </a>
                            <a href="<?php echo BASE_URL; ?>/Book/edit/<?php echo $book['id']; ?>" class="btn btn-warning">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M240-360h280l80-80H240v80Zm0-160h240v-80H240v80Zm-80-160v400h280l-80 80H80v-560h800v120h-80v-40H160Zm756 212q5 5 5 11t-5 11l-36 36-70-70 36-36q5-5 11-5t11 5l48 48ZM520-120v-70l266-266 70 70-266 266h-70ZM160-680v400-400Z"/></svg>                                
                                Modifier
                            </a>
                            <a href="<?php echo BASE_URL; ?>/Book/delete/<?php echo $book['id']; ?>" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce livre?');">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M280-120q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520ZM360-280h80v-360h-80v360Zm160 0h80v-360h-80v360ZM280-720v520-520Z"/></svg>                                
                                Supprimer
                            </a>
                        <?php else: ?>
                            <?php $DisableClass = "" ?>
                            <?php if (!isLoggedIn()){
                                $DisableClass = " text-muted disabled";
                            }
                            ?>
                            <a href="#" class="btn btn-warning <?php echo $DisableClass ?>  ">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M480-120 320-280l56-56 64 63v-167q0-33-23.5-56.5T360-520H120q-33 0-56.5-23.5T40-600v-240h80v240h240q36 0 67 14.5t53 39.5q22-25 53-39.5t67-14.5h240v-240h80v240q0 33-23.5 56.5T840-520H600q-33 0-56.5 23.5T520-440v167l63-63 57 56-160 160Z"/></svg>                                
                                Empreinter
                            </a>
                        <?php endif; ?> 
                            
                        <?php $referrer = isset($_GET['referrer']) ? $_GET['referrer'] : BASE_URL . '/Book'; ?>
                        <a href="<?php echo $referrer; ?>" class="btn btn-secondary">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000000"><path d="M400-80 0-480l400-400 71 71-329 329 329 329-71 71Z"/></svg>                            
                            Retour
                        </a>
                     </div>
                </div>

            </div>
        </div>
    <?php endif; ?>
</div>
    <?php include_once APPROOT . '/app/views/partials/footer.php'; ?>
</body>
</html>
