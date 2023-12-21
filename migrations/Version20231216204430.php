<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231216204430 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE passage_evenement (id INT AUTO_INCREMENT NOT NULL, id_evenement_id INT DEFAULT NULL, h_deb_evenement TIME NOT NULL, h_fin_evenement TIME NOT NULL, INDEX IDX_B04118C02C115A61 (id_evenement_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation_evenement (id_ticket_id INT NOT NULL, id_passage_evenement_id INT NOT NULL, INDEX IDX_11610981F035FBF5 (id_ticket_id), INDEX IDX_1161098178DE4B3B (id_passage_evenement_id), PRIMARY KEY(id_ticket_id, id_passage_evenement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE passage_evenement ADD CONSTRAINT FK_B04118C02C115A61 FOREIGN KEY (id_evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE reservation_evenement ADD CONSTRAINT FK_11610981F035FBF5 FOREIGN KEY (id_ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE reservation_evenement ADD CONSTRAINT FK_1161098178DE4B3B FOREIGN KEY (id_passage_evenement_id) REFERENCES passage_evenement (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE passage_evenement DROP FOREIGN KEY FK_B04118C02C115A61');
        $this->addSql('ALTER TABLE reservation_evenement DROP FOREIGN KEY FK_11610981F035FBF5');
        $this->addSql('ALTER TABLE reservation_evenement DROP FOREIGN KEY FK_1161098178DE4B3B');
        $this->addSql('DROP TABLE passage_evenement');
        $this->addSql('DROP TABLE reservation_evenement');
    }
}
