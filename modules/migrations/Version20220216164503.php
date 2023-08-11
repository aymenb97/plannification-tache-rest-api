<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220216164503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet ADD chef_de_projet_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE projet ADD CONSTRAINT FK_50159CA92C9E1458 FOREIGN KEY (chef_de_projet_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_50159CA92C9E1458 ON projet (chef_de_projet_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE projet DROP FOREIGN KEY FK_50159CA92C9E1458');
        $this->addSql('DROP INDEX IDX_50159CA92C9E1458 ON projet');
        $this->addSql('ALTER TABLE projet DROP chef_de_projet_id');
    }
}
