<?php
require_once './app/models/UserModel.php';
require_once './libs/jwt/jwt.php';

class AuthApiController {
    private $userModel;

    public function __construct() {
        $this->userModel = new UserModel();
    }

    public function login($req, $res) {
        $authorization = $_SERVER['HTTP_AUTHORIZATION'] ?? null;

        if (!$authorization) {
            header("WWW-Authenticate: Basic realm='Get a token'");
            return $res->json(['error' => 'Falta encabezado de autorización'], 401);
        }

        $auth = explode(' ', $authorization);
        if (count($auth) != 2 || $auth[0] !== 'Basic') {
            header("WWW-Authenticate: Basic realm='Get a token'");
            return $res->json(['error' => 'Autenticación no válida'], 401);
        }

        $decoded = base64_decode($auth[1]);
        $user_pass = explode(':', $decoded);

        if (count($user_pass) != 2) {
            return $res->json(['error' => 'Formato incorrecto en Authorization'], 401);
        }

        $email = $user_pass[0];
        $password = $user_pass[1];

        $user = $this->userModel->getByEmail($email);

        if (!$user || !password_verify($password, $user->password)) {
            return $res->json(['error' => 'Usuario o contraseña incorrectos'], 401);
        }

        $roles = [$user->role ?? 'user'];

        $payload = [
            'sub' => $user->id_user,
            'name' => $user->name,
            'email' => $user->email,
            'roles' => $roles,
            'exp' => time() + 3600 
        ];

        $jwt = createJWT($payload);

        return $res->json(['token' => $jwt], 200);
    }
}
