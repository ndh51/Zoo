<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231204213457 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participer DROP FOREIGN KEY FK_EDBE16F8EA39031');
        $this->addSql('ALTER TABLE participer DROP FOREIGN KEY FK_EDBE16F8212C041E');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_EDBE16F8EA39031 FOREIGN KEY (id_animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_EDBE16F8212C041E FOREIGN KEY (id_event_id) REFERENCES evenement (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participer DROP FOREIGN KEY FK_EDBE16F8EA39031');
        $this->addSql('ALTER TABLE participer DROP FOREIGN KEY FK_EDBE16F8212C041E');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_EDBE16F8EA39031 FOREIGN KEY (id_animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_EDBE16F8212C041E FOREIGN KEY (id_event_id) REFERENCES evenement (id)');
    }
}
