<?php
/**lớp sử lý kết nối CSDL**/
class db
{
  protected static $connection;
  public function connect(){
    if(!isset(self::$connection)){
      $config=parse_ini_file("config.ini");
      self::$connection=new mysqli("localhost",$config["username"],$config["password"],$config["databasename"]);

    }
    if(self::$connection==false){
      return false;
    }
    mysqli_set_charset(self::$connection,"utf8");
    return self::$connection;
  }
  public function query_execute($queryString){
    $connection= $this->connect();
    $connection->query("SET NAMES uf8");
    $result= $connection->query($queryString);
    //$connection->close();
    return $result;
  }
  public function select_to_array($queryString)
  {
    $row = array();
    $result = $this->query_execute($queryString);
    if($result == false) return false;
    while($item = mysqli_fetch_assoc($result)){
      $row[] = $item;
    }
    //mysqli_free_result($result);
    return $row;
  }
}
?>