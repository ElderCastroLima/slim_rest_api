<?php
// Routes

$app->get('/teste', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Teste '/' route");

    // Render index view
    return $this->renderer->render($response, 'route2.phtml', $args);
});

$app->get('/[{name}]', function ($request, $response, $args) {
    // Sample log message
    $this->logger->info("Slim-Skeleton '/' route");

    // Render index view
    return $this->renderer->render($response, 'index.phtml', $args);
});