<?php
class UserRepository extends PDORepository
{
  private $stmtDelete;
  private $stmtCreate;
  private $stmtUpdate;

  private function queryToUserArray($query)
  {
    $answer = [];
    foreach ($query as &$element) {
      $answer[] = new User(
        $element['id'],
        $element['username'],
        $element['password'],
        $element['email'],
        $element['active'],
        $element['updated_at'],
        $element['created_at'],
        $element['first_name'],
        $element['last_name']
      );
    }
    return $answer;
  }

  public function __construct()
  {
    $this->stmtToggleActive = $this->newPreparedStmt("UPDATE users SET active = not active WHERE id = ?");
    $this->stmtDelete = $this->newPreparedStmt("DELETE FROM users WHERE id = ?");
    $this->stmtCreate = $this->newPreparedStmt("INSERT INTO users (username, email, password, first_name, last_name,
                                                active, updated_at, created_at)
                                                VALUES (?, ?, ?, ?, ?, 1, NOW(), NOW())");
    $this->stmtUpdate = $this->newPreparedStmt("UPDATE users SET email = ?, password = ?, first_name = ?, last_name = ?,
                                                updated_at = NOW()
                                                WHERE Id = ?");
  }

  public function getAll()
  {
    return $this->queryToUserArray($this->queryList("SELECT * FROM users"));
  }

  public function delete($userId)
  {
    return $this->stmtDelete->execute([$userId]);
  }

  public function create($username, $email, $password, $first_name, $last_name)
  {
    return $this->stmtCreate->execute([$username, $email, $password, $first_name, $last_name]);
  }

  public function update($email, $password, $first_name, $last_name, $userId)
  {
    return $this->stmtUpdate->execute([$email, $password, $first_name, $last_name, $userId]);
  }

  public function getUser($userId)
  {
    return $this->queryToUserArray($this->queryList("SELECT * FROM users where id = ?", [$userId]))[0];
  }

  private function queryUser($username, $password)
  {
    return $this->queryToUserArray($this->queryList("SELECT * FROM users where username = ? AND password = ?", [$username, $password]));
  }

  public function containsUser($username, $password)
  {
    return count($this->queryUser($username, $password)) > 0;
  }

  public function findUser($username, $password)
  {
    return $this->queryUser($username, $password)[0];
  }

  public function userNameExists($username)
  {
    return count($this->queryList("SELECT * FROM users where username = ?", [$username]));
  }
}

