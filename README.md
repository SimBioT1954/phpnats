Introduction
------------

A PHP client for the [NATS messaging system](https://nats.io).

Requirements
------------

* php 7.1+
* [gnatsd](https://github.com/apcera/gnatsd)

### Basic Usage

```php
$client = new \Nats\Connection();
$client->connect();

// Publish Subscribe

// Simple Subscriber.
$client->subscribe(
    'foo',
    function ($message) {
        printf("Data: %s\r\n", $message->getBody());
    }
);

// Simple Publisher.
$client->publish('foo', 'Marty McFly');

// Wait for 1 message.
$client->wait(1);

// Request Response

// Responding to requests.
$sid = $client->subscribe(
    'sayhello',
    function ($message) {
        $message->reply('Reply: Hello, '.$message->getBody().' !!!');
    }
);

// Request.
$client->request(
    'sayhello',
    'Marty McFly',
    function ($message) {
        echo $message->getBody();
    }
);
```

### Encoded Connections

```php
$encoder = new \Nats\Encoders\JSONEncoder();
$options = new \Nats\ConnectionOptions();
$client = new \Nats\EncodedConnection($options, $encoder);
$client->connect();

// Publish Subscribe

// Simple Subscriber.
$client->subscribe(
    'foo',
    function ($payload) {
        printf("Data: %s\r\n", $payload->getBody()[1]);
    }
);

// Simple Publisher.
$client->publish(
    'foo',
    [
     'Marty',
     'McFly',
    ]
);

// Wait for 1 message.
$client->wait(1);

// Request Response

// Responding to requests.
$sid = $client->subscribe(
    'sayhello',
    function ($message) {
        $message->reply('Reply: Hello, '.$message->getBody()[1].' !!!');
    }
);

// Request.
$client->request(
    'sayhello',
    [
     'Marty',
     'McFly',
    ],
    function ($message) {
        echo $message->getBody();
    }
);
```

