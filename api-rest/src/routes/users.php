<?php
$app->post('/api/users', function($req, $res) {
    require_once "src/config/db.php"; /***/
    $data = $req->getParsedBody();

    if (empty($data["msisdn"])
        || empty($data["name"])
        || empty($data["access_level"])
        || empty($data["password"])
        || ($data["access_level"] !== "free" && $data["access_level"] !== "premium"))
    {
        return $res->write('{"message":"Bad request"}')
        ->withHeader('Content-type', 'application/json')
        ->withStatus(400);
    }

    $stmt = $db->prepare("INSERT INTO users (msisdn, name, access_level, password) VALUES (:msisdn, :name, :access_level, :password)");
    $stmt->execute([
        'msisdn' => $data["msisdn"],
        'name' => $data["name"],
        'access_level' => $data["access_level"],
        'password' => $data["password"]
    ]);

    $data["external_id"] = $db->lastInsertId();
var_dump($data);
    require_once "src/config/headers.php";
    $url = "http://api2.mlearn.mobi/integrator/qualifica/users";
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_POST, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_exec($curl);
    curl_close($curl);
    
    return $res->write('{"message":"Success"}')
    ->withHeader('Content-type', 'application/json')
    ->withStatus(201);
});

$app->get('/api/users', function($req, $res) {
    require_once "src/config/db.php";
    $stmt = $db->query("SELECT id, msisdn, name, access_level FROM users");
    $users = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $users[] = [
            'id' => $row['id'],
            'msisdn' => $row['msisdn'],
            'name' => $row['name'],
            'access_level' => $row['access_level']
        ];
    }
    return $res->write(json_encode($users))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});

$app->get('/api/users/{id}', function($req, $res, $args) {
    require_once "src/config/db.php";
    $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $args["id"]]);
    $user = [];
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $user = [
            'id' => $row['id'],
            'msisdn' => $row['msisdn'],
            'name' => $row['name'],
            'access_level' => $row['access_level']
        ];
    }
    if (empty($user)) {
        return $res->write('{"message":"Not found"}')
        ->withHeader('Content-type', 'application/json')
        ->withStatus(404);
    }
    return $res->write(json_encode($user))
    ->withHeader('Content-type', 'application/json')
    ->withStatus(200);
});

$app->put('/api/users/{id}/upgrade', function($req, $res, $args) {
    require_once "src/config/db.php";
    $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $args["id"]]);
    $user = [];
    
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $user = ['id' => $row['id']];
    }

    if (empty($user)) {
        return $res->write('{"message":"User not found"}')
        ->withHeader('Content-type', 'application/json')
        ->withStatus(404);
    }

    require_once "src/config/headers.php";

    $read_url = "http://api2.mlearn.mobi/integrator/qualifica/users?external_id={$user["id"]}";
    $curl = curl_init($read_url); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $result = json_decode(curl_exec($curl));
    curl_close($curl);

    $data = $req->getParsedBody();
    $stmt = $db->prepare("UPDATE users SET access_level = 'premium' WHERE id = :id");
    $stmt->execute(['id' => $args["id"]]);

    $upgrade_url = "http://api2.mlearn.mobi/integrator/qualifica/users/{$result->data->id}/upgrade";
    $curl = curl_init($upgrade_url);
    curl_setopt($curl, CURLOPT_PUT, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_exec($curl);
    curl_close($curl);

    return $res->write('{"message":"Success"}')
    ->withHeader('Content-type', 'application/json')
    ->withStatus(201);
});

$app->put('/api/users/{id}/downgrade', function($req, $res, $args) {
    require_once "src/config/db.php";
    $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
    $stmt->execute(['id' => $args["id"]]);
    $user = [];
    
    while ($row = $stmt->fetch(\PDO::FETCH_ASSOC)) {
        $user = ['id' => $row['id']];
    }

    if (empty($user)) {
        return $res->write('{"message":"User not found"}')
        ->withHeader('Content-type', 'application/json')
        ->withStatus(404);
    }

    require_once "src/config/headers.php";

    $read_url = "http://api2.mlearn.mobi/integrator/qualifica/users?external_id={$user["id"]}";
    $curl = curl_init($read_url); 
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    $result = json_decode(curl_exec($curl));
    curl_close($curl);

    $data = $req->getParsedBody();
    $stmt = $db->prepare("UPDATE users SET access_level = 'free' WHERE id = :id");
    $stmt->execute(['id' => $args["id"]]);

    $downgrade_url = "http://api2.mlearn.mobi/integrator/qualifica/users/{$result->data->id}/downgrade";
    $curl = curl_init($downgrade_url);
    curl_setopt($curl, CURLOPT_PUT, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
    curl_exec($curl);
    curl_close($curl);

    return $res->write('{"message":"Success"}')
    ->withHeader('Content-type', 'application/json')
    ->withStatus(201);
});
