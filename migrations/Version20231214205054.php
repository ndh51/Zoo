<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214205054 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA37F72333D');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA37F72333D7F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA37F72333D7F72333D');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA37F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id)');
    }
}
