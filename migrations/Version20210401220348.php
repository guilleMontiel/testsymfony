<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210401220348 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
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

    }
}
