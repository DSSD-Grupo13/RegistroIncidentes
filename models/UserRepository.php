<?php
class UserRepository extends PDORepository
{
  private $stmtToggleActive;
  private $stmtDelete;
  private $stmtCreate;
  private $stmtUpdate;
  private $appConfig;

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

  public function __construct($appConfig)
  {
    $this->stmtToggleActive = $this->newPreparedStmt("UPDATE users SET active = not active WHERE id = ?");
    $this->stmtDelete = $this->newPreparedStmt("DELETE FROM users WHERE id = ?");
    $this->stmtCreate = $this->newPreparedStmt("INSERT INTO users (username, email, password, first_name, last_name,
                                                active, updated_at, created_at)
                                                VALUES (?, ?, ?, ?, ?, 1, NOW(), NOW())");
    $this->stmtUpdate = $this->newPreparedStmt("UPDATE users SET email = ?, password = ?, first_name = ?, last_name = ?,
                                                updated_at = NOW()
                                                WHERE Id = ?");
    $this->appConfig = $appConfig;
  }

  public function getAll($page, $users_state)
  {
    $count = $this->appConfig->getPage_row_size();
    $offset = ($page - 1) * $count;
    return $this->queryToUserArray($this->queryList("SELECT * FROM users WHERE active = ? LIMIT $count OFFSET $offset", [$users_state]));
  }

  public function getAllByFilter($filter, $page, $users_state)
  {
    $count = $this->appConfig->getPage_row_size();
    $offset = ($page - 1) * $count;
    return $this->queryToUserArray($this->queryList(
        "SELECT * FROM users WHERE (first_name LIKE ? OR last_name LIKE ? OR email LIKE ? OR username LIKE ?) AND active = ?
        ORDER BY last_name, first_name ASC
        LIMIT $count OFFSET $offset", ['%'.$filter.'%','%'.$filter.'%','%'.$filter.'%','%'.$filter.'%', $users_state]));
  }

  public function toggleActive($userId)
  {
    return $this->stmtToggleActive->execute([$userId]);
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
    return $this->queryToUserArray($this->queryList("SELECT * FROM users where username = ? AND password = ? and active = 1", [$username, $password]));
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

  private function queryUserPermission($userId, $permissionName)
  {
    return $this->queryList("SELECT * FROM users_has_role UR
                            INNER JOIN role_has_permission RP ON (UR.role_id = RP.role_id)
                            INNER JOIN user_permission P ON (P.id = RP.permission_id)
                            WHERE (UR.user_id = ?) AND P.name = ?", [$userId, $permissionName]);
  }

  private function queryUserRole($userId, $roleName)
  {
    return $this->queryList("SELECT * FROM users_has_role UR
                            INNER JOIN user_role R ON (R.id = UR.role_id)
                            WHERE (UR.user_id = ?) AND R.name = ?", [$userId, $roleName]);
  }


  public function hasPermission($userId, $action)
  {
    return count($this->queryUserPermission($userId, $action)) > 0;
  }

  public function hasRole($userId, $roleName)
  {
    return count($this->queryUserRole($userId, $roleName)) > 0;
  }

  public function getUserCount()
  {
    $stmt = $this->newPreparedStmt("SELECT COUNT(*) FROM users");
    $stmt->execute();
    return $stmt->fetchColumn();
  }

  public function getPageCount()
  {
    return round($this->getPacientCount() / $this->appConfig->getPage_row_size());
  }
}

