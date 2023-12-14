<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214182145 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voir DROP FOREIGN KEY FK_26AF6CBFEA39031');
        $this->addSql('ALTER TABLE voir DROP FOREIGN KEY FK_26AF6CBFF035FBF5');
        $this->addSql('DROP INDEX IDX_26AF6CBFEA39031 ON voir');
        $this->addSql('DROP INDEX IDX_26AF6CBFF035FBF5 ON voir');
        $this->addSql('ALTER TABLE voir ADD animal_id INT NOT NULL, ADD ticket_id INT NOT NULL, DROP id_animal_id, DROP id_ticket_id');
        $this->addSql('ALTER TABLE voir ADD CONSTRAINT FK_26AF6CBF8E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE voir ADD CONSTRAINT FK_26AF6CBF700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('CREATE INDEX IDX_26AF6CBF8E962C16 ON voir (animal_id)');
        $this->addSql('CREATE INDEX IDX_26AF6CBF700047D2 ON voir (ticket_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voir DROP FOREIGN KEY FK_26AF6CBF8E962C16');
        $this->addSql('ALTER TABLE voir DROP FOREIGN KEY FK_26AF6CBF700047D2');
        $this->addSql('DROP INDEX IDX_26AF6CBF8E962C16 ON voir');
        $this->addSql('DROP INDEX IDX_26AF6CBF700047D2 ON voir');
        $this->addSql('ALTER TABLE voir ADD id_animal_id INT NOT NULL, ADD id_ticket_id INT NOT NULL, DROP animal_id, DROP ticket_id');
        $this->addSql('ALTER TABLE voir ADD CONSTRAINT FK_26AF6CBFEA39031 FOREIGN KEY (id_animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE voir ADD CONSTRAINT FK_26AF6CBFF035FBF5 FOREIGN KEY (id_ticket_id) REFERENCES ticket (id)');
        $this->addSql('CREATE INDEX IDX_26AF6CBFEA39031 ON voir (id_animal_id)');
        $this->addSql('CREATE INDEX IDX_26AF6CBFF035FBF5 ON voir (id_ticket_id)');
    }
}
