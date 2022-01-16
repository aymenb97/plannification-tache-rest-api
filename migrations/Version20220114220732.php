<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220114220732 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message ADD id INT AUTO_INCREMENT NOT NULL, CHANGE timestamp timestamp DATETIME DEFAULT CURRENT_TIMESTAMP, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE message MODIFY id INT NOT NULL');
        $this->addSql('ALTER TABLE message DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE message DROP id, CHANGE timestamp timestamp DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL');
        $this->addSql('ALTER TABLE message ADD PRIMARY KEY (timestamp, user1, user2)');
    }
}
