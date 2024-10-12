[12-Oct-2024 13:42:23 Africa/Dakar] Database connection failed: could not find driver
[12-Oct-2024 13:42:23 Africa/Dakar] Database connection failed: could not find driver
[12-Oct-2024 13:42:23 Africa/Dakar] PHP Fatal error:  Uncaught Error: Call to a member function prepare() on null in /opt/lampp/htdocs/BookTracker/api/app/core/Model.php:35
Stack trace:
#0 /opt/lampp/htdocs/BookTracker/api/app/core/Model.php(52): Model->query()
#1 /opt/lampp/htdocs/BookTracker/api/app/models/Book.php(9): Model->getAll()
#2 /opt/lampp/htdocs/BookTracker/api/app/controllers/HomeController.php(13): Book->getAllBooks()
#3 /opt/lampp/htdocs/BookTracker/api/app/core/App.php(39): HomeController->index()
#4 /opt/lampp/htdocs/BookTracker/api/index.php(24): App->__construct()
#5 {main}
  thrown in /opt/lampp/htdocs/BookTracker/api/app/core/Model.php on line 35
