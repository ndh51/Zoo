<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214203204 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voir DROP FOREIGN KEY FK_26AF6CBF8E962C16');
        $this->addSql('ALTER TABLE voir DROP FOREIGN KEY FK_26AF6CBF700047D2');
        $this->addSql('ALTER TABLE voir ADD CONSTRAINT FK_26AF6CBF8E962C168E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voir ADD CONSTRAINT FK_26AF6CBF700047D2700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voir DROP FOREIGN KEY FK_26AF6CBF8E962C168E962C16');
        $this->addSql('ALTER TABLE voir DROP FOREIGN KEY FK_26AF6CBF700047D2700047D2');
        $this->addSql('ALTER TABLE voir ADD CONSTRAINT FK_26AF6CBF8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE voir ADD CONSTRAINT FK_26AF6CBF700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
    }
}
