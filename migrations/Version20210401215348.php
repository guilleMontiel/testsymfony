<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401215348 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("CREATE TABLE sector('id' int(11) NOT NULL AUTO_INCREMENT,'nombre' varchar(100) NOT NULL)");
        $this->addSql("ALTER TABLE sector ADD PRIMARY KEY (id)");
        
        $this->addSql("CREATE TABLE empresa('id' int(11) NOT NULL AUTO_INCREMENT, 'nombre' varchar(100) NOT NULL,telefono varchar(30), email varchar(60), sector int(11) NOT NULL");
        $this->addSql("ALTER TABLE empresa ADD PRIMARY KEY (id)");
        $this->addSql('ALTER TABLE empresa ADD CONSTRAINT fk_sector FOREIGN KEY (sector) REFERENCES sector (id)');
        
         $this->addSql("INSERT INTO sector(nombre) "
                . "VALUES ('Informatica'),"
                . "('Sistemas'),"
                . "('Transporte'),"
                . "('Finanzas'),"
                . "('Marketing'),"
                . "('Turismo'),"
                . "('Seguros');");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE empresa');
    }
}
