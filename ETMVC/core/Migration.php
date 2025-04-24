<?php

class Migration {
    private $db;
    private $migrations = [];

    public function __construct() {
        $this->db = new Database();
    }

    public function createMigrationsTable() {
        $sql = "CREATE TABLE IF NOT EXISTS migrations (
            id INT AUTO_INCREMENT PRIMARY KEY,
            migration VARCHAR(255),
            created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        )";
        
        try {
            $this->db->query($sql);
            $this->db->execute();
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
        return true;
    }

    public function getMigratedFiles() {
        $this->db->query("SELECT migration FROM migrations");
        return $this->db->resultSet();
    }

    public function addMigration($migrationFile) {
        $this->db->query("INSERT INTO migrations (migration) VALUES (:migration)");
        $this->db->bind(':migration', $migrationFile);
        return $this->db->execute();
    }

    public function applyMigration() {
        // Migrations tablosunu oluştur
        $this->createMigrationsTable();

        // Daha önce çalıştırılan migrationları al
        $appliedMigrations = $this->getMigratedFiles();
        $appliedMigrationsArr = array_map(fn($m) => $m->migration, $appliedMigrations);

        // database/migrations klasöründeki tüm migration dosyalarını al
        $files = scandir(dirname(__DIR__) . '/database/migrations');
        $toApplyMigrations = array_diff($files, ['.', '..', 'migrations.php']);

        // Henüz uygulanmamış migrationları uygula
        foreach ($toApplyMigrations as $migration) {
            if (!in_array($migration, $appliedMigrationsArr)) {
                require_once dirname(__DIR__) . '/database/migrations/' . $migration;
                $className = pathinfo($migration, PATHINFO_FILENAME);
                $instance = new $className();
                
                echo "Applying migration $migration" . PHP_EOL;
                $instance->up();
                echo "Applied migration $migration" . PHP_EOL;

                // Migration'ı kaydet
                $this->addMigration($migration);
            }
        }
    }
} 