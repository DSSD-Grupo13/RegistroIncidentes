<?php
ini_set('display_startup_errors', 1);
ini_set('display_errors', 1);
error_reporting(-1);

require_once "./private/autoloader.php";

session_start();
$frontEndController = NULL;

function getFrontEndController()
{
  if (!isset($frontEndController)) {
    $appConfig = new AppConfig;
    $userRepository = new UserRepository($appConfig);
    $pacientsRepository = new PacientsRepository($appConfig);
    $referenceDataService = new ReferenceDataService(
      new WaterTypeRepository,
      new HeatingTypeRepository,
      new DocumentTypeRepository,
      new SocialInsuranceRepository,
      new HomeTypeRepository
    );

    $indexView = new IndexView;
    $loginView = new LoginView;
    $indexController = new IndexController($indexView);

    TwigView::setAppConfig($appConfig);
    $frontEndController = new FrontEndController($appConfig, $userRepository);

    $frontEndController->addController('index', $indexController);
    $frontEndController->addController('login', new LoginController($loginView));
    $frontEndController->addController('do-login', new DoLoginController(new $indexView, $loginView, $userRepository));
    $frontEndController->addController('do-logout', new DoLogoutController($indexController));
    $frontEndController->addController('admin', new AdminController(new AdminView));
    $frontEndController->addController('admin_updated', new AdminUpdateController($indexView, $appConfig));

    $userListController = new UserListController(new UserListView, $userRepository, $appConfig);
    $frontEndController->addController('users_index', $userListController);
    $frontEndController->addController('user_new', new UserNewController(new NewUserView, $userRepository));
    $frontEndController->addController('user_added', new UserAddedController(new UserAddedView, $userRepository));
    $frontEndController->addController('user_form_update', new UserFormController(new EditUserView, $userRepository));
    $frontEndController->addController('user_updated', new UserUpdatedController(new UserUpdatedView, $userRepository));
    $frontEndController->addController('user_destroy', new UserDestroyedController(new UserDestroyedView, $userRepository));
    $frontEndController->addController('user_toggle_status', new UserToggleStatusController($userListController, $userRepository));

    $frontEndController->addController('pacients_index', new PacientListController(new PacientListView($referenceDataService), $pacientsRepository, $appConfig));
    $frontEndController->addController('pacient_new', new PacientNewController(new NewPacientView($referenceDataService), $pacientsRepository));
    $frontEndController->addController('pacient_added', new PacientAddedController(new PacientAddedView, $pacientsRepository));
    $frontEndController->addController('pacient_form_update', new PacientEditController(new EditPacientView($referenceDataService), $pacientsRepository));
    $frontEndController->addController('pacient_updated', new PacientUpdatedController(new PacientUpdatedView, $pacientsRepository));
    $frontEndController->addController('pacient_destroy', new PacientDestroyedController(new PacientDestroyedView, $pacientsRepository));
    $frontEndController->addController('pacient_demographic_data', new PacientEditController(new PacientDemographicDataView($referenceDataService), $pacientsRepository));
  }

  return $frontEndController;
}


if (isset($_GET['action']))
  getFrontEndController()->getController($_GET['action'])->showView($_POST);
else
  getFrontEndController()->getController('index')->showView($_POST);