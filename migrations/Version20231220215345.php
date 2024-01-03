<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231220215345 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cours_true (id INT AUTO_INCREMENT NOT NULL, professeur_id INT DEFAULT NULL, module_id INT DEFAULT NULL, anne_scolaire_id INT DEFAULT NULL, nombre_heure_eff_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', nombre_heure_global_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', nombre_heure_plannifier_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_2E8A7362BAB22EE9 (professeur_id), INDEX IDX_2E8A7362AFC2B591 (module_id), INDEX IDX_2E8A736283F4BD33 (anne_scolaire_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours_true_classe (cours_true_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_5C900A88246D9A5B (cours_true_id), INDEX IDX_5C900A888F5EA509 (classe_id), PRIMARY KEY(cours_true_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours_true ADD CONSTRAINT FK_2E8A7362BAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE cours_true ADD CONSTRAINT FK_2E8A7362AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE cours_true ADD CONSTRAINT FK_2E8A736283F4BD33 FOREIGN KEY (anne_scolaire_id) REFERENCES anne_scolaire (id)');
        $this->addSql('ALTER TABLE cours_true_classe ADD CONSTRAINT FK_5C900A88246D9A5B FOREIGN KEY (cours_true_id) REFERENCES cours_true (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours_true_classe ADD CONSTRAINT FK_5C900A888F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plannification ADD plannification_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE plannification ADD CONSTRAINT FK_E88A48124C2E1DF5 FOREIGN KEY (plannification_id) REFERENCES cours_true (id)');
        $this->addSql('CREATE INDEX IDX_E88A48124C2E1DF5 ON plannification (plannification_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE plannification DROP FOREIGN KEY FK_E88A48124C2E1DF5');
        $this->addSql('ALTER TABLE cours_true DROP FOREIGN KEY FK_2E8A7362BAB22EE9');
        $this->addSql('ALTER TABLE cours_true DROP FOREIGN KEY FK_2E8A7362AFC2B591');
        $this->addSql('ALTER TABLE cours_true DROP FOREIGN KEY FK_2E8A736283F4BD33');
        $this->addSql('ALTER TABLE cours_true_classe DROP FOREIGN KEY FK_5C900A88246D9A5B');
        $this->addSql('ALTER TABLE cours_true_classe DROP FOREIGN KEY FK_5C900A888F5EA509');
        $this->addSql('DROP TABLE cours_true');
        $this->addSql('DROP TABLE cours_true_classe');
        $this->addSql('DROP INDEX IDX_E88A48124C2E1DF5 ON plannification');
        $this->addSql('ALTER TABLE plannification DROP plannification_id');
    }
}
