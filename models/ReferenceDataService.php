<?php
class ReferenceDataService
{
  private $waterTypeRepository;
  private $heatingTypeRepository;
  private $documentTypeRepository;
  private $socialInsuranceRepository;
  private $homeTypeRepository;

  public function __construct(
    $waterTypeRepository,
    $heatingTypeRepository,
    $documentTypeRepository,
    $socialInsuranceRepository,
    $homeTypeRepository
  )
  {
    $this->waterTypeRepository = $waterTypeRepository;
    $this->heatingTypeRepository = $heatingTypeRepository;
    $this->documentTypeRepository = $documentTypeRepository;
    $this->socialInsuranceRepository = $socialInsuranceRepository;
    $this->homeTypeRepository = $homeTypeRepository;
  }

  public function getAllWaterTypes()
  {
    return $this->waterTypeRepository->getAll();
  }

  public function getWaterTypeById($id)
  {
    return $this->waterTypeRepository->getById($id);
  }

  public function getAllHeatingTypes()
  {
    return $this->heatingTypeRepository->getAll();
  }

  public function getHeatingTypeById($id)
  {
    return $this->heatingTypeRepository->getById($id);
  }

  public function getAllDocumentTypes()
  {
    return $this->documentTypeRepository->getAll();
  }

  public function getDocumentTypeById($id)
  {
    return $this->documentTypeRepository->getById($id);
  }

  public function getAllSocialInsurances()
  {
    return $this->socialInsuranceRepository->getAll();
  }

  public function getSocialInsuranceById($id)
  {
    return $this->socialInsuranceRepository->getById($id);
  }

  public function getAllHomeTypes()
  {
    return $this->homeTypeRepository->getAll();
  }

  public function getHomeTypeById($id)
  {
    return $this->homeTypeRepository->getById($id);
  }
}