<?php
// Routes

$app->get('/getAllGuitars', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("getAllGuitars '/' route");

    $sth = $this->db->prepare("SELECT * FROM GUITARS"); 
    $sth->execute();
    $result = $sth->fetchAll();
    return $this->response->withJson($result);

    // Render index view
    //return $this->renderer->render($response, 'route2.phtml', $args);
});

$app->get('/getGuitarsById/[{id}]', function ($request, $response, $args) {
   //Sample log getGuitarById
	$this->logger->info("getGuitarById '/' route");

	$sth = $this->db->prepare("SELECT * FROM GUITARS WHERE FK_SERIES = :id");
	$sth->bindParam("id",$args['id']);
	$sth->execute();
	$result = $sth->fetchObject();
	return $this->response->withJson($result);
});

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});