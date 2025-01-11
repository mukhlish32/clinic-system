<?php

class SeedCommand extends CConsoleCommand
{
    public function run($args)
    {
        echo "Seeding data started...\n";
        $this->includeSeederCommands();
        $this->seedUser();
        $this->seedWilayah();
        echo "Seeding process completed.\n";
    }

    protected function includeSeederCommands()
    {
        $commandDirectory = Yii::getPathOfAlias('application.commands');
        $files = glob($commandDirectory . '/*SeederCommand.php');

        foreach ($files as $file) {
            require_once($file);
        }
    }

    protected function seedUser()
    {
        echo "Seeding user data...\n";
        $userSeeder = new UserSeederCommand('start', Yii::app()->commandRunner);
        $userSeeder->run([]);
    }

    protected function seedWilayah()
    {
        echo "Seeding wilayah data...\n";
        $wilayahSeeder = new WilayahSeederCommand('start', Yii::app()->commandRunner);;
        $wilayahSeeder->run([]);  // Pass empty array as arguments
    }
}
