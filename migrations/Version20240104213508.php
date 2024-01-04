<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240104213508 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plannification CHANGE date_at date_at VARCHAR(255) NOT NULL, CHANGE heure_debut_at heure_debut_at VARCHAR(255) NOT NULL, CHANGE heure_fin_at heure_fin_at VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plannification CHANGE date_at date_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE heure_debut_at heure_debut_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', CHANGE heure_fin_at heure_fin_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\'');
    }
}
