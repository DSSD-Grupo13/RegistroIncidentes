<?php
class AppConfig extends PDORepository
{
  private function queryValue($field)
  {
    $data = $this->getConnection()->query("SELECT * FROM app_settings")->fetch();
    return $data[$field];
  }

  public function getIsSiteEnabled()
  {
    return $this->queryValue("avaible");
  }

  public function getDescription()
  {
    return $this->queryValue("description");
  }

  public function getTitle()
  {
    return $this->queryValue("title");
  }

  public function getContact_mail()
  {
    return $this->queryValue("contact_mail");
  }

  public function getPage_row_size()
  {
    return $this->queryValue("page_row_size");
  }

  public function update($title, $description, $contact_mail, $page_row_size, $site_available)
  {
    $stmt = $this->newPreparedStmt(
      "UPDATE app_settings SET
        title = ?,
        description = ?,
        contact_mail = ?,
        page_row_size = ?,
        avaible = ?");

    return $stmt->execute([$title, $description, $contact_mail, $page_row_size, $site_available]);
  }
}
