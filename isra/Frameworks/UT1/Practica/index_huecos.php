<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ObjectType;
use GraphQL\Type\Definition\InterfaceType;
use GraphQL\Type\Schema;
use GraphQL\Server\StandardServer;

// Datos de ejemplo
$authors = [
    ['firstName' => 'Miguel', 'lastName' => 'de Cervantes'],
    ['firstName' => 'Jane', 'lastName' => 'Austen'],
    ['firstName' => 'Gabriel', 'lastName' => 'García Márquez'],
];

$books = [
    ['id' => '1', 'title' => 'Don Quijote de la Mancha', 'authors' => [$authors[0]]],
    ['id' => '2', 'title' => 'Orgullo y Prejuicio', 'authors' => [$authors[1]]],
    ['id' => '3', 'title' => 'Cien Años de Soledad', 'authors' => [$authors[2]]],
];

$boardGames = [
    ['id' => '1', 'title' => 'Catan', 'pub' => ['name' => 'Kosmos']],
    ['id' => '2', 'title' => 'Carcassonne', 'pub' => ['name' => 'Hans im Glück']],
    ['id' => '3', 'title' => 'Ticket to Ride', 'pub' => ['name' => 'Days of Wonder']],
];

$rootValue = [
    'libItems' => array_merge($books, $boardGames)
];

// Tipos
class AuthorType extends ObjectType {
    public function __construct() {
        parent::__construct([
            'name' => 'Author',
            'fields' => [
                'firstName' => Type::nonNull(Type::string()),
                'lastName'  => Type::nonNull(Type::string()),
            ],
        ]);
    }
}

class PublisherType extends ObjectType {
    public function __construct() {
        parent::__construct([
            'name' => 'Publisher',
            'fields' => [
                'name' => Type::nonNull(Type::string()),
            ],
        ]);
    }
}

class LibItemInterface extends InterfaceType {
    public function __construct() {
        parent::__construct([
            'name' => 'LibItem',
            'fields' => [
                'id' => Type::nonNull(Type::id()),
                'title' => Type::nonNull(Type::string()),
            ],
            'resolveType' => function($value) {
                if (isset($value['authors'])) {
                    return MyTypes::book();
                }
                if (isset($value['pub'])) {
                    return MyTypes::boardGame();
                }
                return null;
            }
        ]);
    }
}

class BookType extends ObjectType {
    public function __construct() {
        parent::__construct([
            'name' => 'Book',
            'interfaces' => function() { return [ MyTypes::libItem() ]; },
            'fields' => function() {
                return [
                    'id' => Type::nonNull(Type::id()),
                    'title' => Type::nonNull(Type::string()),
                    'authors' => [
                        'type' => Type::listOf(MyTypes::author())
                    ],
                ];
            }
        ]);
    }
}

class BoardGameType extends ObjectType {
    public function __construct() {
        parent::__construct([
            'name' => 'BoardGame',
            'interfaces' => function() { return [ MyTypes::libItem() ]; },
            'fields' => function() {
                return [
                    'id' => Type::nonNull(Type::id()),
                    'title' => Type::nonNull(Type::string()),
                    'pub' => [
                        'type' => MyTypes::publisher()
                    ],
                ];
            }
        ]);
    }
}

class MyTypes {
    private static $libItem = null;
    private static $book = null;
    private static $boardGame = null;
    private static $author = null;
    private static $publisher = null;

    public static function libItem(): LibItemInterface {
        return self::$libItem ?: (self::$libItem = new LibItemInterface());
    }
    public static function book(): BookType {
        return self::$book ?: (self::$book = new BookType());
    }
    public static function boardGame(): BoardGameType {
        return self::$boardGame ?: (self::$boardGame = new BoardGameType());
    }
    public static function author(): AuthorType {
        return self::$author ?: (self::$author = new AuthorType());
    }
    public static function publisher(): PublisherType {
        return self::$publisher ?: (self::$publisher = new PublisherType());
    }
}

// Schema
$schema = new Schema([
    'query' => new ObjectType([
        'name' => 'Query',
        'fields' => [
            'libItems' => [
                'type' => Type::listOf(MyTypes::libItem()),
                'resolve' => function($root) {
                    return $root['libItems'] ?? [];
                }
            ]
        ]
    ]),
    'types' => [
        MyTypes::book(),
        MyTypes::boardGame(),
        MyTypes::author(),
        MyTypes::publisher(),
    ],
]);

$server = new StandardServer([
    'schema' => $schema,
    'rootValue' => $rootValue,
]);

$server->handleRequest();
