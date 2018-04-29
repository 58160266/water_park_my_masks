<?php

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';


$app = new \Slim\App;

// Routes
$app->group('/api', function () use ($app) {

    // Version group
    $app->group('/v1', function () use ($app) {
/*
    $app->get('/subjects', 'getSubjects');
		$app->get('/subjects/{id}', 'getSubject');
		$app->post('/subjects', 'addSubject');
		$app->put('/subjects/{id}', 'updateSubject');
        $app->delete('/subjects/{id}', 'deleteSubject');

        //////////////// student
        $app->get('/students', 'getStudents');
		$app->get('/students/{id}', 'getStudent');
		$app->post('/students', 'addStudent');
		$app->put('/students/{id}', 'updateStudent');
        $app->delete('/students/{id}', 'deleteStudent');

        ///////////////majors
        $app->get('/majors', 'getMajors');
		$app->get('/majors/{id}', 'getMajor');
		$app->post('/majors', 'addMajor');
		$app->put('/majors/{id}', 'updateMajor');
        $app->delete('/majors/{id}', 'deleteMajor');

        ///////////////faculty
        $app->get('/faculties', 'getFaculties');
		$app->get('/faculties/{id}', 'getFaculty');
		$app->post('/faculties', 'addFaculty');
		$app->put('/faculties/{id}', 'updateFaculty');
        $app->delete('/faculties/{id}', 'deleteFaculty');

        //////////////////
        $app->get('/faculty/{id}/majors', 'getMajorsInFaculty');
        $app->get('/faculty/{fac_id}/majors/{maj_id}/students', 'getStudentsInMajors');
        $app->post('/faculty/{fac_id}/majors', 'addMajorsInFaculty');
        $app->post('/faculty/{fac_id}/majors/{maj_id}/students', 'addStudentsInMajors');
        */
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


/*
function getSubjects($request, $response) {
    $sql = "SELECT * FROM subjects";
    try {
        $db = getConnection();

        $result = null;

        $stmt = $db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($result){
            return $response->withJson(array('status' => 'true','result'=>$result),200);
        }else{
            return $response->withJson(array('status' => 'Subject Not Found'),422);
        }
        $db=null;

    }
    catch(\PDOException $ex){
        return $response->withJson(array('error' => $ex->getMessage()),422);
    }

}


function getSubject($request, $response) {
    $sub_id = 0;;
    $sub_id =  $request->getAttribute('id');
    try {
        $db = getConnection();
        $sql = "SELECT * FROM subjects WHERE sub_id=:sub_id";
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':sub_id' => $sub_id
        );
        $stmt->execute($values);
        $result = $stmt->fetchObject();

        if($result){
            return $response->withJson(array('status' => 'true','result'=>$result),200);
        }else{
            return $response->withJson(array('status' => 'Subject Not Found'),422);
        }
        $db=null;

    } catch(PDOException $e) {
      return $response->withJson(array('error' => $ex->getMessage()),422);
    }
}

function addSubject($request, $response) {

    $sql = "INSERT INTO subjects VALUES (:sub_id, :sub_name, :sub_credit, :sub_hour)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':sub_id' => $request->getParam('id'),
            ':sub_name' => $request->getParam('name'),
            ':sub_credit' => $request->getParam('credit'),
            ':sub_hour' => $request->getParam('hour')
        );
        $result = $stmt->execute($values);
        return $response->withJson(array('status' => 'Subject Created'),200);
        $db=null;
        }
        catch(\PDOException $ex){
                return $response->withJson(array('error' => $ex->getMessage()),422);
        }
}

function updateSubject($request, $response) {

    $sub_id = $request->getAttribute('id');
    $sql = "UPDATE subjects SET sub_name=:sub_name, sub_credit=:sub_credit, sub_hour=:sub_hour WHERE sub_id=:sub_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':sub_name' => $request->getParam('name'),
            ':sub_credit' => $request->getParam('credit'),
            ':sub_hour' => $request->getParam('hour'),
            ':sub_id' => $sub_id
        );
        $result = $stmt->execute($values);
        if($result){
            return $response->withJson(array('status' => 'Subject Updated'),200);
        }else{
            return $response->withJson(array('status' => 'Subject Not Found'),422);
        }
        $db=null;
        }
        catch(\PDOException $ex){
                return $response->withJson(array('error' => $ex->getMessage()),422);
        }
}

function deleteSubject($request, $response) {

    $sub_id = $request->getAttribute('id');
    $sql = "DELETE FROM subjects WHERE sub_id=:sub_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':sub_id' => $sub_id
        );
        $result = $stmt->execute($values);
        if($result){
            return $response->withJson(array('status' => 'Subject Deleted'),200);
        }else{
            return $response->withJson(array('status' => 'Subject Not Found'),422);
        }
        $db=null;
        }
        catch(\PDOException $ex){
                return $response->withJson(array('error' => $ex->getMessage()),422);
        }
}


/////// make student api /////////////

function getStudents($request, $response) {
    $sql = "SELECT * FROM students";
    try {
        $db = getConnection();

        $result = null;

        $stmt = $db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($result){
            return $response->withJson(array('status' => 'true','result'=>$result),200);
        }else{
            return $response->withJson(array('status' => 'Student Not Found'),422);
        }
        $db=null;

    }
    catch(\PDOException $ex){
        return $response->withJson(array('error' => $ex->getMessage()),422);
    }

}


function getStudent($request, $response) {
    $stu_id = 0;;
    $stu_id =  $request->getAttribute('id');
    try {
        $db = getConnection();
        $sql = "SELECT * FROM students WHERE stu_id=:stu_id";
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':stu_id' => $stu_id
        );
        $stmt->execute($values);
        $result = $stmt->fetchObject();

        if($result){
            return $response->withJson(array('status' => 'true','result'=>$result),200);
        }else{
            return $response->withJson(array('status' => 'Student Not Found'),422);
        }
        $db=null;

    } catch(PDOException $e) {
      return $response->withJson(array('error' => $ex->getMessage()),422);
    }
}

function addStudent($request, $response) {

    $sql = "INSERT INTO students VALUES (:stu_id, :stu_fullname, :maj_id, :fac_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':stu_id' => $request->getParam('id'),
            ':stu_fullname' => $request->getParam('fullname'),
            ':maj_id' => $request->getParam('major'),
            ':fac_id' => $request->getParam('faculty')
        );
        $result = $stmt->execute($values);
        return $response->withJson(array('status' => 'Student Created'),200);
        $db=null;
        }
        catch(\PDOException $ex){
                return $response->withJson(array('error' => $ex->getMessage()),422);
        }
}

function updateStudent($request, $response) {

    $sub_id = $request->getAttribute('id');
    $sql = "UPDATE students SET stu_fullname=:stu_fullname, maj_id=:maj_id, fac_id=:fac_id WHERE stu_id=:stu_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':stu_fullname' => $request->getParam('fullname'),
            ':maj_id' => $request->getParam('major'),
            ':fac_id' => $request->getParam('faculty'),
            ':stu_id' => $stu_id
        );
        $result = $stmt->execute($values);
        if($result){
            return $response->withJson(array('status' => 'Student Updated'),200);
        }else{
            return $response->withJson(array('status' => 'Student Not Found'),422);
        }
        $db=null;
        }
        catch(\PDOException $ex){
                return $response->withJson(array('error' => $ex->getMessage()),422);
        }
}

function deleteStudent($request, $response) {

    $sub_id = $request->getAttribute('id');
    $sql = "DELETE FROM students WHERE stu_id=:stu_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':stu_id' => $sub_id
        );
        $result = $stmt->execute($values);
        if($result){
            return $response->withJson(array('status' => 'Student Deleted'),200);
        }else{
            return $response->withJson(array('status' => 'Student Not Found'),422);
        }
        $db=null;
        }
        catch(\PDOException $ex){
                return $response->withJson(array('error' => $ex->getMessage()),422);
        }
}

/////// make majors api /////////////

function getMajors($request, $response) {
    $sql = "SELECT * FROM majors";
    try {
        $db = getConnection();

        $result = null;

        $stmt = $db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($result){
            return $response->withJson(array('status' => 'true','result'=>$result),200);
        }else{
            return $response->withJson(array('status' => 'Majors Not Found'),422);
        }
        $db=null;

    }
    catch(\PDOException $ex){
        return $response->withJson(array('error' => $ex->getMessage()),422);
    }

}


function getMajor($request, $response) {
    $maj_id = 0;;
    $maj_id =  $request->getAttribute('id');
    try {
        $db = getConnection();
        $sql = "SELECT * FROM majors WHERE maj_id=:maj_id";
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':maj_id' => $maj_id
        );
        $stmt->execute($values);
        $result = $stmt->fetchObject();

        if($result){
            return $response->withJson(array('status' => 'true','result'=>$result),200);
        }else{
            return $response->withJson(array('status' => 'Student Not Found'),422);
        }
        $db=null;

    } catch(PDOException $e) {
      return $response->withJson(array('error' => $ex->getMessage()),422);
    }
}

function addMajor($request, $response) {

    $sql = "INSERT INTO majors VALUES (:maj_id, :maj_name, :fac_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':maj_id' => $request->getParam('id'),
            ':maj_name' => $request->getParam('name'),
            ':fac_id' => $request->getParam('faculty')
        );
        $result = $stmt->execute($values);
        return $response->withJson(array('status' => 'Major Created'),200);
        $db=null;
        }
        catch(\PDOException $ex){
                return $response->withJson(array('error' => $ex->getMessage()),422);
        }
}

function updateMajor($request, $response) {

    $maj_id = $request->getAttribute('id');
    $sql = "UPDATE majors SET maj_name=:maj_name, fac_id=:fac_id WHERE maj_id=:maj_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':maj_name' => $request->getParam('name'),
            ':fac_id' => $request->getParam('faculty'),
            ':maj_id' => $maj_id
        );
        $result = $stmt->execute($values);
        if($result){
            return $response->withJson(array('status' => 'Major Updated'),200);
        }else{
            return $response->withJson(array('status' => 'Major Not Found'),422);
        }
        $db=null;
        }
        catch(\PDOException $ex){
                return $response->withJson(array('error' => $ex->getMessage()),422);
        }
}

function deleteMajor($request, $response) {

    $maj_id = $request->getAttribute('id');
    $sql = "DELETE FROM majors WHERE maj_id=:maj_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':maj_id' => $maj_id
        );
        $result = $stmt->execute($values);
        if($result){
            return $response->withJson(array('status' => 'Major Deleted'),200);
        }else{
            return $response->withJson(array('status' => 'Major Not Found'),422);
        }
        $db=null;
        }
        catch(\PDOException $ex){
                return $response->withJson(array('error' => $ex->getMessage()),422);
        }
}


/////// make faculties api /////////////

function getfaculties($request, $response) {
    $sql = "SELECT * FROM faculty";
    try {
        $db = getConnection();

        $result = null;

        $stmt = $db->query($sql);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);
        if($result){
            return $response->withJson(array('status' => 'true','result'=>$result),200);
        }else{
            return $response->withJson(array('status' => 'faculty Not Found'),422);
        }
        $db=null;

    }
    catch(\PDOException $ex){
        return $response->withJson(array('error' => $ex->getMessage()),422);
    }

}


function getFaculty($request, $response) {
    $fac_id = 0;;
    $fac_id =  $request->getAttribute('id');
    try {
        $db = getConnection();
        $sql = "SELECT * FROM faculty WHERE fac_id=:fac_id";
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':fac_id' => $fac_id
        );
        $stmt->execute($values);
        $result = $stmt->fetchObject();

        if($result){
            return $response->withJson(array('status' => 'true','result'=>$result),200);
        }else{
            return $response->withJson(array('status' => 'Faculty Not Found'),422);
        }
        $db=null;

    } catch(PDOException $e) {
      return $response->withJson(array('error' => $ex->getMessage()),422);
    }
}

function addFaculty($request, $response) {

    $sql = "INSERT INTO faculty VALUES (:fac_id, :fac_name)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':fac_id' => $request->getParam('id'),
            ':fac_name' => $request->getParam('name')
        );
        $result = $stmt->execute($values);
        return $response->withJson(array('status' => 'Faculty Created'),200);
        $db=null;
        }
        catch(\PDOException $ex){
                return $response->withJson(array('error' => $ex->getMessage()),422);
        }
}

function updateFaculty($request, $response) {

    $fac_id = $request->getAttribute('id');
    $sql = "UPDATE faculty SET fac_name=:fac_name WHERE fac_id=:fac_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':fac_name' => $request->getParam('name'),
            ':fac_id' => $fac_id
        );
        $result = $stmt->execute($values);
        if($result){
            return $response->withJson(array('status' => 'Faculty Updated'),200);
        }else{
            return $response->withJson(array('status' => 'Faculty Not Found'),422);
        }
        $db=null;
        }
        catch(\PDOException $ex){
                return $response->withJson(array('error' => $ex->getMessage()),422);
        }
}

function deleteFaculty($request, $response) {

    $sub_id = $request->getAttribute('id');
    $sql = "DELETE FROM faculty WHERE fac_id=:fac_id";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':fac_id' => $sub_id
        );
        $result = $stmt->execute($values);
        if($result){
            return $response->withJson(array('status' => 'Faculty Deleted'),200);
        }else{
            return $response->withJson(array('status' => 'Faculty Not Found'),422);
        }
        $db=null;
        }
        catch(\PDOException $ex){
                return $response->withJson(array('error' => $ex->getMessage()),422);
        }
}

/////////////////////

function getMajorsInFaculty($request, $response) {
    $fac_id = 0;;
    $fac_id =  $request->getAttribute('id');
    try {
        $db = getConnection();
        $sql = "SELECT maj_id FROM majors WHERE fac_id=:fac_id";
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':fac_id' => $fac_id
        );
        $stmt->execute($values);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        if($result){
            return $response->withJson(array('status' => 'true','result'=>$result),200);
        }else{
            return $response->withJson(array('status' => 'Subject Not Found'),422);
        }
        $db=null;

    } catch(PDOException $e) {
      return $response->withJson(array('error' => $ex->getMessage()),422);
    }
}


function getStudentsInMajors($request, $response) {
    $fac_id = 0;;
    $fac_id =  $request->getAttribute('fac_id');
    $maj_id = 0;;
    $maj_id =  $request->getAttribute('maj_id');
    try {
        $db = getConnection();
        $sql = "SELECT stu_id,stu_fullname FROM students WHERE fac_id=:fac_id AND maj_id=:maj_id";
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':fac_id' => $fac_id,
            ':maj_id' => $maj_id
        );
        $stmt->execute($values);
        $result = $stmt->fetchAll(PDO::FETCH_OBJ);

        if($result){
            return $response->withJson(array('status' => 'true','result'=>$result),200);
        }else{
            return $response->withJson(array('status' => 'Subject Not Found'),422);
        }
        $db=null;

    } catch(PDOException $e) {
      return $response->withJson(array('error' => $ex->getMessage()),422);
    }
}

function addMajorsInFaculty($request, $response) {
    $fac_id = 0;;
    $fac_id =  $request->getAttribute('fac_id');

    $sql = "INSERT INTO majors VALUES (:maj_id, :maj_name, :fac_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':maj_id' => $request->getParam('id'),
            ':maj_name' => $request->getParam('name'),
            ':fac_id' => $fac_id

        );
        $result = $stmt->execute($values);
        return $response->withJson(array('status' => 'Majors Created'),200);
        $db=null;
        }
        catch(\PDOException $ex){
                return $response->withJson(array('error' => $ex->getMessage()),422);
        }
}

function addStudentsInMajors($request, $response) {
    $fac_id = 0;
    $fac_id =  $request->getAttribute('fac_id');
    $maj_id = 0;
    $maj_id =  $request->getAttribute('maj_id');

    $sql = "INSERT INTO students VALUES (:stu_id, :stu_fullname ,:maj_id ,:fac_id)";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $values = array(
            ':stu_id' => $request->getParam('id'),
            ':stu_fullname' => $request->getParam('name'),
            ':maj_id' => $maj_id,
            ':fac_id' => $fac_id

        );
        $result = $stmt->execute($values);
        return $response->withJson(array('status' => 'Student Created'),200);
        $db=null;
        }
        catch(\PDOException $ex){
                return $response->withJson(array('error' => $ex->getMessage()),422);
        }
}

*/
