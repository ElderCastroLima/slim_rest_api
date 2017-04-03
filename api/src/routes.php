<?php
// Routes
// GET ------------------------------------------------------------
$app->get('/getAllGuitars', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("getAllGuitars");

    $stmt = $this->db->prepare("SELECT * FROM GUITARS"); 
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $this->response->withJson($result);

    // Render index view
    //return $this->renderer->render($response, 'route2.phtml', $args);
});

$app->get('/getGuitarsById/[{id}]', function ($request, $response, $args) {
   //Sample log getGuitarById
	$this->logger->info("getGuitarById");

	$stmt = $this->db->prepare("SELECT * FROM GUITARS WHERE id = :id");
	$stmt->bindParam("id",$args['id']);
	$stmt->execute();
	$result = $stmt->fetchObject();
	return $this->response->withJson($result);
});

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});

// POST --------------------------------------------------
$app->post('/insertGuitars',function($request, $response){
    //Sample log InsertGuitars
    $this->logger->info("InsertGuitars");
    //get data body request
    $input = $request->getParsedBody();
    //Sample log data
    $this->logger->info("InsertGuitars param:" .$input['id']
                                       .', '.$input['fk_brands']
                                       .', '.$input['fk_series']
                                       .', '.$input['description']
                                       .', '.$input['created_at']
                                       .', '.$input['updated_at']
                                      );
    $sql = "INSERT INTO GUITARS (ID, FK_BRANDS, FK_SERIES, DESCRIPTION, CREATED_AT, UPDATED_AT) 
                   VALUES (:id,:fk_brands,:fk_series,:description,:created_at,:updated_at)";
    $stmt = $this->db->prepare($sql);
    $stmt->bindParam(":id",$input['id']);
    $stmt->bindParam(":fk_brands",$input['fk_brands']);
    $stmt->bindParam(":fk_series",$input['fk_series']);
    $stmt->bindParam(":description",$input['description']);
    $stmt->bindParam(":created_at",$input['created_at']);
    $stmt->bindParam(":updated_at",$input['updated_at']);
    $stmt->execute();

    //Retornar alguma mensagem?   
});

// DELETE---------------------------------------------------------------------
$app->delete('/deleteGuitarsById/[{id}]',function($request, $response, $args){ 
    //Sample log DeleteGuitarsById
    $this->logger->info("deleteGuitarsById");

   $stmt = $this->db->prepare("DELETE FROM GUITARS WHERE id = :id");
   $stmt->bindParam("id",$args["id"]);
   $stmt->execute();

});

// PUT---------------------------------------------------------------------
$app->put('/updateGuitarsById/[{id}]',function($request, $response, $args){
  $this->logger->info("updateGuitarsById Código =>".$args["id"]);
  //get data body request 
  $input = $request->getParsedBody(); 

  $sql = "UPDATE GUITARS SET FK_BRANDS = :fk_brands, 
                             FK_SERIES = :fk_series, 
                             DESCRIPTION = :description, 
                             UPDATED_AT = :updated_at
                         WHERE ID = :id";
  //Sample log data
  $this->logger->info("updateGuitarsById param:" .$input['fk_brands']
                                         .', '.$input['fk_series']
                                         .', '.$input['description']
                                         .', '.$input['created_at']
                                         .', '.$input['updated_at']
                                         );
  $stmt = $this->db->prepare($sql);
  $stmt->bindParam(":id",$args["id"]);
  $stmt->bindParam(":fk_brands",$input['fk_brands']);
  $stmt->bindParam(":fk_series",$input['fk_series']);
  $stmt->bindParam(":description",$input['description']);
  $stmt->bindParam(":updated_at",$input['updated_at']);
  $stmt->execute();
});
