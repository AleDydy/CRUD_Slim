<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class AlunniController {
  public function index(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $result = $mysqli_connection->query("SELECT * FROM alunni");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function show(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $id = $args["id"];
    $result = $mysqli_connection->query("SELECT * FROM alunni WHERE id = $id");
    $results = $result->fetch_all(MYSQLI_ASSOC);

    $response->getBody()->write(json_encode($results));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function alunniPOST(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $req = json_decode($request->getBody(), true);
    $nome = $req["nome"];
    $cognome = $req["cognome"];
    $result = $mysqli_connection->query("INSERT INTO alunni VALUES('$nome', '$cognome')");

    $response->getBody()->write(json_encode($req));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function alunniPUT(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $req = json_decode($request->getBody(), true);
    $id = $args["id"];
    $nome = $req["nome"];
    $cognome = $req["cognome"];
    $result = $mysqli_connection->query("UPDATE alunni SET nome = $nome, cognome = $cognome WHERE id = $id");

    $response->getBody()->write(json_encode($req));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }

  public function alunniDELETE(Request $request, Response $response, $args){
    $mysqli_connection = new MySQLi('my_mariadb', 'root', 'ciccio', 'scuola');
    $req = json_decode($request->getBody(), true);
    $id = $args["id"];
    $result = $mysqli_connection->query("DELETE FROM alunni WHERE id = $id");

    $response->getBody()->write(json_encode($req));
    return $response->withHeader("Content-type", "application/json")->withStatus(200);
  }
}