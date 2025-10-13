<?php
require_once __DIR__ . '/../../../../vendor/autoload.php';

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Utils\BuildSchema;
use GraphQL\Server\StandardServer;

// Datos simulados
$peliculas = [
    ["id" => "1", "titulo" => "Matrix", "anio" => 1999, "actores" => ["1", "2"]],
    ["id" => "2", "titulo" => "John Wick", "anio" => 2014, "actores" => ["1"]],
    ["id" => "3", "titulo" => "Titanic", "anio" => 1997, "actores" => ["3"]],
];

$actores = [
    ["id" => "1", "nombre" => "Keanu Reeves", "peliculas" => ["1", "2"]],
    ["id" => "2", "nombre" => "Carrie-Anne Moss", "peliculas" => ["1"]],
    ["id" => "3", "nombre" => "Leonardo DiCaprio", "peliculas" => ["3"]],
];

// Clases de tipos
class PeliculaType extends ObjectType {
    public function __construct() {
        parent::__construct([
            'name' => 'Pelicula',
            'fields' => [
                'id' => Type::nonNull(Type::id()),
                'titulo' => Type::nonNull(Type::string()),
                'anio' => Type::nonNull(Type::int()),
                'actores' => [
                    'type' => Type::listOf(MyTypes::actor()),
                    'resolve' => function($pelicula) {
                        global $actores;
                        return array_filter($actores, fn($a) => in_array($a['id'], $pelicula['actores']));
                    }
                ]
            ]
        ]);
    }
}

class ActorType extends ObjectType {
    public function __construct() {
        parent::__construct([
            'name' => 'Actor',
            'fields' => [
                'id' => Type::nonNull(Type::id()),
                'nombre' => Type::nonNull(Type::string()),
                'peliculas' => [
                    'type' => Type::listOf(MyTypes::pelicula()),
                    'resolve' => function($actor) {
                        global $peliculas;
                        return array_filter($peliculas, fn($p) => in_array($p['id'], $actor['peliculas']));
                    }
                ]
            ]
        ]);
    }
}

class MyTypes {
    private static ?ActorType $actor = null;
    private static ?PeliculaType $pelicula = null;

    public static function actor(): ActorType {
        return self::$actor ??= new ActorType();
    }

    public static function pelicula(): PeliculaType {
        return self::$pelicula ??= new PeliculaType();
    }
}

// Root resolvers
$rValue = [
    'peliculas' => fn() => $peliculas,
    'peliculaPorId' => fn($root, $args) => array_values(array_filter($peliculas, fn($p) => $p['id'] === $args['id']))[0] ?? null,
    'actores' => fn() => $actores,
    'actorPorId' => fn($root, $args) => array_values(array_filter($actores, fn($a) => $a['id'] === $args['id']))[0] ?? null,
];

// Cargar esquema SDL
$schemaSDL = file_get_contents(__DIR__ . '/schema.graphql');
$schema = BuildSchema::build($schemaSDL);

// Servidor GraphQL
$server = new StandardServer([
    'schema' => $schema,
    'rootValue' => $rValue
]);

try {
    $server->handleRequest();
} catch (Exception $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
