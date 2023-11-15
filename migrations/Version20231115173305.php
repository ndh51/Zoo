<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231115173305 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement ADD id_enclos_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E8B29B47E FOREIGN KEY (id_enclos_id) REFERENCES enclos (id)');
        $this->addSql('CREATE INDEX IDX_B26681E8B29B47E ON evenement (id_enclos_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E8B29B47E');
        $this->addSql('DROP INDEX IDX_B26681E8B29B47E ON evenement');
        $this->addSql('ALTER TABLE evenement DROP id_enclos_id');
    }
}
