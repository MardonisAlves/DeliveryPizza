<?php
namespace App;
class pdo{
  public static $host ="localhost";
  public static $user = "root";
  public static $pass = "";
  public static $dbname = "pdo_mardonis";
  private static $Connect = null;


  private static function Connect()
  {
    try {
      if(self::$Connect == null):
          self::$Connect = new PDO('mysql:host=' . self::$host.'; dbname='.self::$dbname , self::$user, self::$pass);
      endif;

    } catch (\Exception $e) {
      echo "Message:" . $e->getMessage();
      die;
    }



     return self::$Connect;
  }

  public static function getConnect()
  {
    return   self::Connect();
  }
}
