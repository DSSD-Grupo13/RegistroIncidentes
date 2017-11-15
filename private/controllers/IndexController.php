<?php
class IndexController extends Controller
{
  private $indexView;
  private $incidentsRepository;

  public function __construct($indexView, $incidentsRepository)
  {
    $this->indexView = $indexView;
    $this->incidentsRepository= $incidentsRepository;
  }

  protected function doShowView($args)
  {
    $this->indexView->show(
      $this->incidentsRepository->getIncidentesUsuario($this->getSession()->getUserId())
    );
  }
}
