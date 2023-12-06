<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206181941 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal ADD id_enclos_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F8B29B47E FOREIGN KEY (id_enclos_id) REFERENCES enclos (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F8B29B47E ON animal (id_enclos_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F8B29B47E');
        $this->addSql('DROP INDEX IDX_6AAB231F8B29B47E ON animal');
        $this->addSql('ALTER TABLE animal DROP id_enclos_id');
    }
}
