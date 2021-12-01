<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211201172039 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE module (id INT AUTO_INCREMENT NOT NULL, titre_module VARCHAR(255) NOT NULL, date_debut_module VARCHAR(255) NOT NULL, date_fin_module DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE projet (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, titre VARCHAR(255) NOT NULL, date_debut_projet DATE NOT NULL, date_fin_projet DATE NOT NULL, description VARCHAR(255) DEFAULT NULL, etat VARCHAR(255) NOT NULL, INDEX IDX_50159CA9642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tache (id INT AUTO_INCREMENT NOT NULL, membre_equipe_id INT DEFAULT NULL, projet_id INT DEFAULT NULL, module_id INT DEFAULT NULL, titre_tache VARCHAR(255) NOT NULL, date_debut_tache DATE NOT NULL, date_fin_tache DATE NOT NULL, priorite INT NOT NULL, etat_tache VARCHAR(50) NOT NULL, taux_avancement INT NOT NULL, INDEX IDX_93872075D2E31877 (membre_equipe_id), INDEX IDX_93872075C18272 (projet_id), INDEX IDX_93872075AFC2B591 (module_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA9642B8210 FOREIGN KEY (admin_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075D2E31877 FOREIGN KEY (membre_equipe_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075AFC2B591');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075C18272');
        $this->addSql('DROP TABLE module');
        $this->addSql('DROP TABLE projet');
        $this->addSql('DROP TABLE tache');
    }
}
