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
         
         $this->addSql("CREATE TABLE `user` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `email` varchar(180) NOT NULL,
            `roles` json NOT NULL,
            `password` varchar(255) NOT NULL,
            `nombre` varchar(60) NOT NULL
          )");
         $this->addSql("ALTER TABLE user ADD PRIMARY KEY (id)");
         
         $this->addSql("INSERT INTO `user` (`email`, `roles`, `password`, `nombre`) VALUES
            ('jose@cliente.com', '[\"ROLE_CLIENTE\"]', '1234', 'Jose'),
            ('guille@admin.com', '[\"ROLE_ADMIN\"]', '\$argon2id\$v=19\$m=65536,t=4,p=1\$ujMbnz4qGQi/YeWhtuwA/g\$VzmEOhSfeuvXXJNn6J8VVTrsEDN7fXktLtzeVeKoIEY', 'Guillermo'),
            ('belen@cliente.com', '[\"ROLE_CLIENTE\"]', '1234', 'Belen Risco'),
            ('estefi@cliente.com', '[\"ROLE_CLIENTE\"]', '\$argon2id\$v=19\$m=65536,t=4,p=1\$yY+lfzZVTF8nQPH8D9EJrA\$hZOrxMUjzWMlVkWKu9q8J0za9s9R+zt+oE12CxBjVaA', 'Estefania');");
         
         $this->addSql("CREATE TABLE `cliente_sector` (
            `id` int(11) NOT NULL AUTO_INCREMENT,
            `id_user_id` int(11) NOT NULL,
            `id_sector_id` int(11) NOT NULL)");
        $this->addSql("ALTER TABLE cliente_sector ADD PRIMARY KEY (id)");
        $this->addSql("ALTER TABLE `cliente_sector`
        ADD CONSTRAINT `FK_sector` FOREIGN KEY (`id_sector_id`) REFERENCES `sector` (`id`),
        ADD CONSTRAINT `FK_user` FOREIGN KEY (`id_user_id`) REFERENCES `user` (`id`);");
         
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE empresa');
    }
}
