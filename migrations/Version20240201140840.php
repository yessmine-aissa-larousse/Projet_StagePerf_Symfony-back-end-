<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240201140840 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emlpoitemps ADD idcl INT DEFAULT NULL, ADD idsl INT DEFAULT NULL');
        $this->addSql('ALTER TABLE emlpoitemps ADD CONSTRAINT FK_8C89C5D52260117E FOREIGN KEY (idcl) REFERENCES classe (id)');
        $this->addSql('ALTER TABLE emlpoitemps ADD CONSTRAINT FK_8C89C5D568A2032F FOREIGN KEY (idsl) REFERENCES salle (id)');
        $this->addSql('CREATE INDEX IDX_8C89C5D52260117E ON emlpoitemps (idcl)');
        $this->addSql('CREATE INDEX IDX_8C89C5D568A2032F ON emlpoitemps (idsl)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE emlpoitemps DROP FOREIGN KEY FK_8C89C5D52260117E');
        $this->addSql('ALTER TABLE emlpoitemps DROP FOREIGN KEY FK_8C89C5D568A2032F');
        $this->addSql('DROP INDEX IDX_8C89C5D52260117E ON emlpoitemps');
        $this->addSql('DROP INDEX IDX_8C89C5D568A2032F ON emlpoitemps');
        $this->addSql('ALTER TABLE emlpoitemps DROP idcl, DROP idsl');
    }
}
