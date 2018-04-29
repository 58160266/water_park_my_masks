<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';


$app = new \Slim\App;

// Routes
$app->group('/api', function () use ($app) {

    // Version group
    $app->group('/v1', function () use ($app) {
        $app->get('/waterparks','getWaterparks');
        $app->get('/waterparks/{id}','getWaterpark');

        $app->post('/members', 'addMemberWp_mark');
	});
});

$app->get('/hello/{name}', function (Request $request, Response $response, array $args) {
    $name = $args['name'];
    $response->getBody()->write("Hello, $name");

    return $response;
});

$corsOptions = array(
    "origin" => "*",
    "exposeHeaders" => array("Content-Type", "X-Requested-With", "X-authentication", "X-client"),
    "allowMethods" => array('GET', 'POST', 'PUT', 'DELETE', 'OPTIONS')
);
$cors = new \CorsSlim\CorsSlim($corsOptions);

$app->add($cors);

$app->run();

// Connect Database Code
function getConnection() {
    $dbhost="db";
    $dbuser="myuser";
    $dbpass="mypasswd";
    $dbname="mydb";
    $dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
}


//get all waterpark
function getWaterparks($request, $response) {
    $sql = "SELECT * FROM waterpark";
    try {
        $db = getConnection();

        $result = null;

        $stmt = $db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($result){
            return $response->withJson(array('status' => 'true','result'=>$result),200);
        }else{
            return $response->withJson(array('status' => 'Waterpark Not Found'),422);
        }
        $db=null;

    }
    catch(\PDOException $ex){
        return $response->withJson(array('error' => $ex->getMessage()),422);
    }

}


//get one waterpark
function getWaterpark($request, $response) {
    $wp_id = 0;
    $wp_id =  $request->getAttribute('id');
    try {
        $db = getConnection();
        $sql = "SELECT * FROM waterpark WHERE wp_id=:wp_id";
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':wp_id' => $wp_id
        );
        $stmt->execute($values);
        $result = $stmt->fetchObject();

        if($result){
            return $response->withJson(array('status' => 'true','result'=>$result),200);
        }else{
            return $response->withJson(array('status' => 'Waterpark Not Found'),422);
        }
        $db=null;

    } catch(PDOException $e) {
      return $response->withJson(array('error' => $ex->getMessage()),422);
    }
}


// ถ้าสมัครสมาชิกแล้วจะส่งค่าผลลัพท์กลับไป แต่ถ้ายังจะสมัครสมาชิกให้แล้วก็ส่งผลลัพท์กลับไปให้
function addMemberWp_mark($request, $response) {
  try {
      $db = getConnection();
      $sql = "SELECT * FROM member_wp WHERE mb_email=:mb_email";
      $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
      $values = array(
          ':mb_email' => $request->getParam('email'),
      );
      $stmt->execute($values);
      $result = $stmt->fetchObject();

      if($result){
          return $response->withJson(array('status' => 'true','result'=>$result),200);
      }else{
          //return $response->withJson(array('status' => 'Members not Found'),422);
          $sql = "INSERT INTO member_wp VALUES (null, :mb_email, :mb_wp1, :mb_wp2, :mb_wp3, :mb_wp4, :mb_wp5,
                  :mb_wp6, :mb_wp7, :mb_wp8, :mb_wp9, :mb_wp10, :mb_wp11, :mb_wp12 )";
          try {
              $db = getConnection();
              $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
              $values = array(
                  ':mb_email' => $request->getParam('email'),
                  ':mb_wp1' => 0,
                  ':mb_wp2' => 0,
                  ':mb_wp3' => 0,
                  ':mb_wp4' => 0,
                  ':mb_wp5' => 0,
                  ':mb_wp6' => 0,
                  ':mb_wp7' => 0,
                  ':mb_wp8' => 0,
                  ':mb_wp9' => 0,
                  ':mb_wp10' => 0,
                  ':mb_wp11' => 0,
                  ':mb_wp12' => 0
              );
              $result = $stmt->execute($values);
              //return $response->withJson(array('status' => 'Member Created'),200);
                $sql = "SELECT * FROM member_wp WHERE mb_email=:mb_email";
                $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
                $values = array(
                    ':mb_email' => $request->getParam('email'),
                );
                $stmt->execute($values);
                $result = $stmt->fetchObject();

                if($result){
                    return $response->withJson(array('status' => 'true','result'=>$result),200);
                }else{
                    return $response->withJson(array('status' => 'Members not Found'),422);
                }
              }
              catch(\PDOException $ex){
                      return $response->withJson(array('error' => $ex->getMessage()),422);
              }
      }
      $db=null;

  } catch(PDOException $e) {
    return $response->withJson(array('error' => $ex->getMessage()),422);
  }

}
