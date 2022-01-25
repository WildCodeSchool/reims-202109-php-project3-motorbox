<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220125104509 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE part CHANGE part_use_time part_use_time NUMERIC(7, 2) NOT NULL');
        $this->addSql('ALTER TABLE vehicle ADD owner_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE vehicle ADD CONSTRAINT FK_1B80E4867E3C61F9 FOREIGN KEY (owner_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_1B80E4867E3C61F9 ON vehicle (owner_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE part CHANGE part_use_time part_use_time NUMERIC(10, 2) NOT NULL');
        $this->addSql('ALTER TABLE vehicle DROP FOREIGN KEY FK_1B80E4867E3C61F9');
        $this->addSql('DROP INDEX IDX_1B80E4867E3C61F9 ON vehicle');
        $this->addSql('ALTER TABLE vehicle DROP owner_id');
    }
}
