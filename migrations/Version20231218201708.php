<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231218201708 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cours (id INT AUTO_INCREMENT NOT NULL, anne_scolaire_id INT DEFAULT NULL, professeur_id INT DEFAULT NULL, semestre_id INT DEFAULT NULL, module_id INT DEFAULT NULL, nombre_heure_eff_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', nombre_heure_global_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', nombre_heure_plannifier_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_FDCA8C9C83F4BD33 (anne_scolaire_id), INDEX IDX_FDCA8C9CBAB22EE9 (professeur_id), INDEX IDX_FDCA8C9C5577AFDB (semestre_id), INDEX IDX_FDCA8C9CAFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cours_classe (cours_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_E007AEFE7ECF78B0 (cours_id), INDEX IDX_E007AEFE8F5EA509 (classe_id), PRIMARY KEY(cours_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plannification (id INT AUTO_INCREMENT NOT NULL, cours_id INT DEFAULT NULL, date_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', heure_debut_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', heure_fin_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', is_actived TINYINT(1) NOT NULL, is_etat TINYINT(1) NOT NULL, INDEX IDX_E88A48127ECF78B0 (cours_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE semestre (id INT AUTO_INCREMENT NOT NULL, niveau_id INT DEFAULT NULL, libelle VARCHAR(30) NOT NULL, INDEX IDX_71688FBCB3E9C81 (niveau_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C83F4BD33 FOREIGN KEY (anne_scolaire_id) REFERENCES anne_scolaire (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CBAB22EE9 FOREIGN KEY (professeur_id) REFERENCES professeur (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9C5577AFDB FOREIGN KEY (semestre_id) REFERENCES semestre (id)');
        $this->addSql('ALTER TABLE cours ADD CONSTRAINT FK_FDCA8C9CAFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('ALTER TABLE cours_classe ADD CONSTRAINT FK_E007AEFE7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours_classe ADD CONSTRAINT FK_E007AEFE8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plannification ADD CONSTRAINT FK_E88A48127ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id)');
        $this->addSql('ALTER TABLE semestre ADD CONSTRAINT FK_71688FBCB3E9C81 FOREIGN KEY (niveau_id) REFERENCES niveau (id)');
        
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C83F4BD33');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CBAB22EE9');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9C5577AFDB');
        $this->addSql('ALTER TABLE cours DROP FOREIGN KEY FK_FDCA8C9CAFC2B591');
        $this->addSql('ALTER TABLE cours_classe DROP FOREIGN KEY FK_E007AEFE7ECF78B0');
        $this->addSql('ALTER TABLE cours_classe DROP FOREIGN KEY FK_E007AEFE8F5EA509');
        $this->addSql('ALTER TABLE plannification DROP FOREIGN KEY FK_E88A48127ECF78B0');
        $this->addSql('ALTER TABLE semestre DROP FOREIGN KEY FK_71688FBCB3E9C81');
        $this->addSql('DROP TABLE cours');
        $this->addSql('DROP TABLE cours_classe');
        $this->addSql('DROP TABLE plannification');
        $this->addSql('DROP TABLE semestre');
    }
}
