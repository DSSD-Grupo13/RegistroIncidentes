<?php
require_once "./vendor/Twig/lib/Twig/Autoloader.php";

require_once "./controllers/Controller.php";
require_once "./controllers/FrontEndController.php";
require_once "./controllers/IndexController.php";
require_once "./controllers/UserController.php";
require_once "./controllers/LoginController.php";
require_once "./controllers/AdminController.php";
require_once "./controllers/PacientsController.php";
require_once "./controllers/DisabledSiteController.php";
require_once "./controllers/NonAuthorizedController.php";

require_once "./models/PDORepository.php";
require_once "./models/UserRepository.php";
require_once "./models/PacientsRepository.php";
require_once "./models/ReferenceData.php";
require_once "./models/ReferenceDataRepository.php";
require_once "./models/DocumentTypeRepository.php";
require_once "./models/HomeTypeRepository.php";
require_once "./models/HeatingTypeRepository.php";
require_once "./models/WaterTypeRepository.php";
require_once "./models/SocialInsuranceRepository.php";
require_once "./models/ReferenceDataService.php";
require_once "./models/User.php";
require_once "./models/Pacient.php";
require_once "./models/AppConfig.php";

require_once "./private/Session.php";
require_once "./private/UserSession.php";

require_once "./views/TwigView.php";
require_once "./views/IndexView.php";
require_once "./views/LoginView.php";
require_once "./views/AdminView.php";
require_once "./views/DisabledSiteView.php";
require_once "./views/NonAuthorizedView.php";
require_once "./views/InvalidArgsView.php";
require_once "./views/ErrorMessageView.php";

require_once "./views/UserListView.php";
require_once "./views/UserAddedView.php";
require_once "./views/UserFormView.php";
require_once "./views/UserUpdatedView.php";
require_once "./views/UserDestroyedView.php";

require_once "./views/PacientListView.php";
require_once "./views/PacientAddedView.php";
require_once "./views/PacientFormView.php";
require_once "./views/PacientUpdatedView.php";
require_once "./views/PacientDestroyedView.php";
require_once "./views/PacientDemographicDataView.php";
