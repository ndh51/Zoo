<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231217093620 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE passage_evenement DROP FOREIGN KEY FK_B04118C02C115A61');
        $this->addSql('DROP INDEX IDX_B04118C02C115A61 ON passage_evenement');
        $this->addSql('ALTER TABLE passage_evenement CHANGE id_evenement_id evenement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE passage_evenement ADD CONSTRAINT FK_B04118C0FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_B04118C0FD02F13 ON passage_evenement (evenement_id)');
        $this->addSql('ALTER TABLE reservation_evenement DROP FOREIGN KEY FK_11610981F035FBF5');
        $this->addSql('ALTER TABLE reservation_evenement DROP FOREIGN KEY FK_1161098178DE4B3B');
        $this->addSql('DROP INDEX IDX_11610981F035FBF5 ON reservation_evenement');
        $this->addSql('DROP INDEX IDX_1161098178DE4B3B ON reservation_evenement');
        $this->addSql('DROP INDEX `primary` ON reservation_evenement');
        $this->addSql('ALTER TABLE reservation_evenement ADD ticket_id INT NOT NULL, ADD passage_evenement_id INT NOT NULL, DROP id_ticket_id, DROP id_passage_evenement_id');
        $this->addSql('ALTER TABLE reservation_evenement ADD CONSTRAINT FK_11610981700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE reservation_evenement ADD CONSTRAINT FK_11610981742EBA9F FOREIGN KEY (passage_evenement_id) REFERENCES passage_evenement (id)');
        $this->addSql('CREATE INDEX IDX_11610981700047D2 ON reservation_evenement (ticket_id)');
        $this->addSql('CREATE INDEX IDX_11610981742EBA9F ON reservation_evenement (passage_evenement_id)');
        $this->addSql('ALTER TABLE reservation_evenement ADD PRIMARY KEY (ticket_id, passage_evenement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation_evenement DROP FOREIGN KEY FK_11610981700047D2');
        $this->addSql('ALTER TABLE reservation_evenement DROP FOREIGN KEY FK_11610981742EBA9F');
        $this->addSql('DROP INDEX IDX_11610981700047D2 ON reservation_evenement');
        $this->addSql('DROP INDEX IDX_11610981742EBA9F ON reservation_evenement');
        $this->addSql('DROP INDEX `PRIMARY` ON reservation_evenement');
        $this->addSql('ALTER TABLE reservation_evenement ADD id_ticket_id INT NOT NULL, ADD id_passage_evenement_id INT NOT NULL, DROP ticket_id, DROP passage_evenement_id');
        $this->addSql('ALTER TABLE reservation_evenement ADD CONSTRAINT FK_11610981F035FBF5 FOREIGN KEY (id_ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE reservation_evenement ADD CONSTRAINT FK_1161098178DE4B3B FOREIGN KEY (id_passage_evenement_id) REFERENCES passage_evenement (id)');
        $this->addSql('CREATE INDEX IDX_11610981F035FBF5 ON reservation_evenement (id_ticket_id)');
        $this->addSql('CREATE INDEX IDX_1161098178DE4B3B ON reservation_evenement (id_passage_evenement_id)');
        $this->addSql('ALTER TABLE reservation_evenement ADD PRIMARY KEY (id_ticket_id, id_passage_evenement_id)');
        $this->addSql('ALTER TABLE passage_evenement DROP FOREIGN KEY FK_B04118C0FD02F13');
        $this->addSql('DROP INDEX IDX_B04118C0FD02F13 ON passage_evenement');
        $this->addSql('ALTER TABLE passage_evenement CHANGE evenement_id id_evenement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE passage_evenement ADD CONSTRAINT FK_B04118C02C115A61 FOREIGN KEY (id_evenement_id) REFERENCES evenement (id)');
        $this->addSql('CREATE INDEX IDX_B04118C02C115A61 ON passage_evenement (id_evenement_id)');
    }
}
