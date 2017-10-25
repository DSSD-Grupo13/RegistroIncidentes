<?php
require_once "./private/vendor/Twig/lib/Twig/Autoloader.php";

require_once "./private/controllers/Controller.php";
require_once "./private/controllers/Router.php";
require_once "./private/controllers/IndexController.php";
require_once "./private/controllers/UserController.php";
require_once "./private/controllers/LoginController.php";
require_once "./private/Session.php";

require_once "./private/models/PDORepository.php";
require_once "./private/models/UserRepository.php";
require_once "./private/models/User.php";

require_once "./private/views/TwigView.php";
require_once "./private/views/IndexView.php";
require_once "./private/views/LoginView.php";
require_once "./private/views/InvalidArgsView.php";
require_once "./private/views/ErrorMessageView.php";

require_once "./private/views/UserListView.php";
require_once "./private/views/UserAddedView.php";
require_once "./private/views/UserFormView.php";
require_once "./private/views/UserUpdatedView.php";
require_once "./private/views/UserDestroyedView.php";