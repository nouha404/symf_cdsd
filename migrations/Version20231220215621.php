<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231220215621 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours_true ADD semestre_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE cours_true ADD CONSTRAINT FK_2E8A73625577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('CREATE INDEX IDX_2E8A73625577AFDB ON cours_true (semestre_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours_true DROP FOREIGN KEY FK_2E8A73625577AFDB');
        $this->addSql('DROP INDEX IDX_2E8A73625577AFDB ON cours_true');
        $this->addSql('ALTER TABLE cours_true DROP semestre_id');
    }
}
