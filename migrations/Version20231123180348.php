<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231123180348 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE participer (id_animal_id INT NOT NULL, id_event_id INT NOT NULL, INDEX IDX_EDBE16F8EA39031 (id_animal_id), INDEX IDX_EDBE16F8212C041E (id_event_id), PRIMARY KEY(id_animal_id, id_event_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_EDBE16F8EA39031 FOREIGN KEY (id_animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_EDBE16F8212C041E FOREIGN KEY (id_event_id) REFERENCES evenement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participer DROP FOREIGN KEY FK_EDBE16F8EA39031');
        $this->addSql('ALTER TABLE participer DROP FOREIGN KEY FK_EDBE16F8212C041E');
        $this->addSql('DROP TABLE participer');
    }
}
