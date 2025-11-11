<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251104081036 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE empresa (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, nºtrabajadores INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE trabajador ADD empresa_id INT DEFAULT NULL, DROP empresa');
        $this->addSql('ALTER TABLE trabajador ADD CONSTRAINT FK_42157CDF521E1991 FOREIGN KEY (empresa_id) REFERENCES empresa (id)');
        $this->addSql('CREATE INDEX IDX_42157CDF521E1991 ON trabajador (empresa_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE trabajador DROP FOREIGN KEY FK_42157CDF521E1991');
        $this->addSql('DROP TABLE empresa');
        $this->addSql('DROP INDEX IDX_42157CDF521E1991 ON trabajador');
        $this->addSql('ALTER TABLE trabajador ADD empresa VARCHAR(255) DEFAULT NULL, DROP empresa_id');
    }
}
