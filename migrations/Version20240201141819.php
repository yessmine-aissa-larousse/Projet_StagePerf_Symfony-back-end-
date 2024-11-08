<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201141819 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emlpoitemps ADD idform INT DEFAULT NULL');
        $this->addSql('ALTER TABLE emlpoitemps ADD CONSTRAINT FK_8C89C5D581470CEF FOREIGN KEY (idform) REFERENCES formateur (codef)');
        $this->addSql('CREATE INDEX IDX_8C89C5D581470CEF ON emlpoitemps (idform)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emlpoitemps DROP FOREIGN KEY FK_8C89C5D581470CEF');
        $this->addSql('DROP INDEX IDX_8C89C5D581470CEF ON emlpoitemps');
        $this->addSql('ALTER TABLE emlpoitemps DROP idform');
    }
}
