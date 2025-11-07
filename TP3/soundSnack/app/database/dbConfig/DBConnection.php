<?php
require_once __DIR__ . '/DBConfig.php';

/* Clase encargada de manejar conexiones a la base de datos. */
final class DBConnection
{
    // patron Singleton 
    private static ?DBConnection $instance = null;
    private ?PDO $db = null;

    // Este constructor establece la conexión PDO y ejecuta el autodeploy si es necesario. */
    private function __construct()
    {
        try {
            // Conexión inicial con el servidor MySQL sin especificar base de datos
            $dsnWithoutDB = DBConfig::getDSNWithoutDB();
            $this->db = new PDO(
                $dsnWithoutDB,
                DBConfig::getUser(),
                DBConfig::getPassword(),
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
            //creacion de base de datos y tablas 
            $this->deploy();
            // Reconeccion con la base de datos recientemente creada
            $this->db = new PDO(
                DBConfig::getDSN(),
                DBConfig::getUser(),
                DBConfig::getPassword(),
                [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
            );
        } catch (PDOException $e) {
            error_log("No se pudo conectar a la base de datos: " . $e->getMessage());
        }
    }

    public static function getInstance(): DBConnection
    {
        if (self::$instance === null) {
            self::$instance = new DBConnection();
        }
        return self::$instance;
    }

    // Método para reconectar a la base de datos ya creada//Inicia una conexión a la base de datos y retorna un objeto PDO.
    private function openConnection(): PDO
    {
        return new PDO(
            DBConfig::getDSN(),
            DBConfig::getUser(),
            DBConfig::getPassword(),
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    //PHP cierra la conexión PDO automáticamente al destruir el objeto, no se requiere un método closeConnection

    // Autodeploy: crea la base de datos y tablas si es necesario.
    private function deploy(): void
    {
        $sqlFile = __DIR__ . '/../webII2025/soundSnack.sql';
        if (!file_exists($sqlFile)) {
            error_log("Archivo SQL no encontrado: $sqlFile");
            return;
        }

        $sql = file_get_contents($sqlFile);  // Lee todo el contenido del archivo SQL como un string.
        $statements = explode(';', $sql); // Cada comando SQL termina con ';', se separan las sentencias.

        foreach ($statements as $stmt) { // Itera sobre cada comando SQL.
            $stmt = trim($stmt); // Elimina espacios en blanco para evitar errores.
            if ($stmt) { // Evalúa que el string no esté vacío.
                try {
                    $this->db->exec($stmt); // Ejecuta el comando en la base de datos.
                } catch (PDOException $e) {
                    error_log("Error ejecutando SQL: " . $e->getMessage());
                }
            }
        }
        error_log("Base de datos desplegada automáticamente.");
    }

    public function getPDO(): ?PDO
    {
        return $this->db;
    }
}
