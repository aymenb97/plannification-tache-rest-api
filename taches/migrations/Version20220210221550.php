<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220210221550 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache ADD description VARCHAR(255) NOT NULL, CHANGE projet_id projet_id INT DEFAULT NULL, CHANGE module_id module_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075C18272 FOREIGN KEY (projet_id) REFERENCES projet (id)');
        $this->addSql('ALTER TABLE tache ADD CONSTRAINT FK_93872075AFC2B591 FOREIGN KEY (module_id) REFERENCES module (id)');
        $this->addSql('CREATE INDEX IDX_93872075C18272 ON tache (projet_id)');
        $this->addSql('CREATE INDEX IDX_93872075AFC2B591 ON tache (module_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075C18272');
        $this->addSql('ALTER TABLE tache DROP FOREIGN KEY FK_93872075AFC2B591');
        $this->addSql('DROP INDEX IDX_93872075C18272 ON tache');
        $this->addSql('DROP INDEX IDX_93872075AFC2B591 ON tache');
        $this->addSql('ALTER TABLE tache DROP description, CHANGE projet_id projet_id INT NOT NULL, CHANGE module_id module_id INT NOT NULL');
    }
}
