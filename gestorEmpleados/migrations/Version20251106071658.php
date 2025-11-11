<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20251106071658 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE empresa CHANGE numero_trabajadores numero_trabajadores INT NOT NULL');
        $this->addSql('ALTER TABLE trabajador CHANGE salario salario INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE empresa CHANGE numero_trabajadores numero_trabajadores VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE trabajador CHANGE salario salario VARCHAR(255) DEFAULT NULL');
    }
}
