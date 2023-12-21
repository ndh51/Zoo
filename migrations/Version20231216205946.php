<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231216205946 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE passage_evenement CHANGE h_deb_evenement h_deb_evenement VARCHAR(50) NOT NULL, CHANGE h_fin_evenement h_fin_evenement VARCHAR(50) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE passage_evenement CHANGE h_deb_evenement h_deb_evenement TIME NOT NULL, CHANGE h_fin_evenement h_fin_evenement TIME NOT NULL');
    }
}
