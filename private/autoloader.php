<?php
require_once "./vendor/Twig/lib/Twig/Autoloader.php";

require_once "./controllers/Controller.php";
require_once "./controllers/Router.php";
require_once "./controllers/IndexController.php";
require_once "./controllers/UserController.php";
require_once "./controllers/LoginController.php";
require_once "./private/Session.php";

require_once "./models/PDORepository.php";
require_once "./models/UserRepository.php";
require_once "./models/User.php";

require_once "./views/TwigView.php";
require_once "./views/IndexView.php";
require_once "./views/LoginView.php";
require_once "./views/InvalidArgsView.php";
require_once "./views/ErrorMessageView.php";

require_once "./views/UserListView.php";
require_once "./views/UserAddedView.php";
require_once "./views/UserFormView.php";
require_once "./views/UserUpdatedView.php";
require_once "./views/UserDestroyedView.php";