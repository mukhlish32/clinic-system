<?php

class WilayahSeederCommand extends CConsoleCommand
{
    public function run($args)
    {
        $this->seedWilayah();
        echo "WilayahSeeder process completed.\n";
    }

    public function seedWilayah()
    {
        $sqlFilePath = Yii::getPathOfAlias('application.data') . '/wilayah.sql';

        if (file_exists($sqlFilePath)) {
            $sql = file_get_contents($sqlFilePath);
            $queries = explode(";", $sql);

            $connection = Yii::app()->db;

            try {
                foreach ($queries as $query) {
                    $query = trim($query);
                    if ($query) {
                        $connection->createCommand($query)->execute();
                    }
                }
                echo "Seed data from wilayah.sql successfully executed.\n";
            } catch (Exception $e) {
                echo "Error executing the SQL file: " . $e->getMessage() . "\n";
            }
        } else {
            echo "The file 'wilayah.sql' does not exist in the 'protected/data/' directory.\n";
        }
    }
}
