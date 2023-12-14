<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214174458 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participer DROP FOREIGN KEY FK_EDBE16F8212C041E');
        $this->addSql('DROP INDEX IDX_EDBE16F8212C041E ON participer');
        $this->addSql('DROP INDEX `primary` ON participer');
        $this->addSql('ALTER TABLE participer CHANGE id_event_id evenement_id INT NOT NULL');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_EDBE16F8FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_EDBE16F8FD02F13 ON participer (evenement_id)');
        $this->addSql('ALTER TABLE participer ADD PRIMARY KEY (animal_id, evenement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE participer DROP FOREIGN KEY FK_EDBE16F8FD02F13');
        $this->addSql('DROP INDEX IDX_EDBE16F8FD02F13 ON participer');
        $this->addSql('DROP INDEX `PRIMARY` ON participer');
        $this->addSql('ALTER TABLE participer CHANGE evenement_id id_event_id INT NOT NULL');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_EDBE16F8212C041E FOREIGN KEY (id_event_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_EDBE16F8212C041E ON participer (id_event_id)');
        $this->addSql('ALTER TABLE participer ADD PRIMARY KEY (animal_id, id_event_id)');
    }
}
