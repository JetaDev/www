<?php

declare(strict_types=1);
global $root_fields_Resolver;
require_once __DIR__ . '/../../../../vendor/autoload.php';
include_once __DIR__ . '/rootresolver.php';

use GraphQL\Utils\BuildSchema;
use GraphQL\Server\StandardServer;

$contents = file_get_contents(__DIR__ . '/schema.graphql');
$schema= BuildSchema::build($contents);
$server= new StandardServer([
'schema'=> $schema,
'rootValue'=> $root_fields_Resolver,
]);
try {
    $server->handleRequest();
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
