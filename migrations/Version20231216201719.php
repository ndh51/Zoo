<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231216201719 extends AbstractMigration
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
        $this->addSql('CREATE TABLE voir (id INT AUTO_INCREMENT NOT NULL, animal_id INT NOT NULL, ticket_id INT NOT NULL, INDEX IDX_26AF6CBF8E962C16 (animal_id), INDEX IDX_26AF6CBF700047D2 (ticket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE passage_evenement ADD CONSTRAINT FK_B04118C02C115A61 FOREIGN KEY (id_evenement_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE reservation_evenement ADD CONSTRAINT FK_11610981F035FBF5 FOREIGN KEY (id_ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE reservation_evenement ADD CONSTRAINT FK_1161098178DE4B3B FOREIGN KEY (id_passage_evenement_id) REFERENCES passage_evenement (id)');
        $this->addSql('ALTER TABLE voir ADD CONSTRAINT FK_26AF6CBF8E962C168E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE voir ADD CONSTRAINT FK_26AF6CBF700047D2700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE date_evenement DROP FOREIGN KEY FK_34505BAAF035FBF5');
        $this->addSql('ALTER TABLE date_evenement DROP FOREIGN KEY FK_34505BAA212C041E');
        $this->addSql('DROP TABLE date_evenement');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F6D7EC9F8');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F8B29B47E');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F322DFB53');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F9F34925F');
        $this->addSql('DROP INDEX IDX_6AAB231F322DFB53 ON animal');
        $this->addSql('DROP INDEX IDX_6AAB231F6D7EC9F8 ON animal');
        $this->addSql('DROP INDEX IDX_6AAB231F9F34925F ON animal');
        $this->addSql('DROP INDEX IDX_6AAB231F8B29B47E ON animal');
        $this->addSql('ALTER TABLE animal ADD famille_id INT DEFAULT NULL, ADD categorie_id INT DEFAULT NULL, ADD image_id INT DEFAULT NULL, ADD enclos_id INT DEFAULT NULL, DROP id_famille_id, DROP id_categorie_id, DROP id_image_id, DROP id_enclos_id');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F97A77B84 FOREIGN KEY (famille_id) REFERENCES famille (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FBCF5E72D FOREIGN KEY (categorie_id) REFERENCES categorie (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FB1C0859 FOREIGN KEY (enclos_id) REFERENCES enclos (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F97A77B84 ON animal (famille_id)');
        $this->addSql('CREATE INDEX IDX_6AAB231FBCF5E72D ON animal (categorie_id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F3DA5256D ON animal (image_id)');
        $this->addSql('CREATE INDEX IDX_6AAB231FB1C0859 ON animal (enclos_id)');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E6D7EC9F8');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E8B29B47E');
        $this->addSql('DROP INDEX IDX_B26681E6D7EC9F8 ON evenement');
        $this->addSql('DROP INDEX IDX_B26681E8B29B47E ON evenement');
        $this->addSql('ALTER TABLE evenement ADD enclos_id INT DEFAULT NULL, ADD image_id INT DEFAULT NULL, DROP id_enclos_id, DROP id_image_id');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EB1C0859 FOREIGN KEY (enclos_id) REFERENCES enclos (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_B26681EB1C0859 ON evenement (enclos_id)');
        $this->addSql('CREATE INDEX IDX_B26681E3DA5256D ON evenement (image_id)');
        $this->addSql('ALTER TABLE participer DROP FOREIGN KEY FK_EDBE16F8EA39031');
        $this->addSql('ALTER TABLE participer DROP FOREIGN KEY FK_EDBE16F8212C041E');
        $this->addSql('DROP INDEX IDX_EDBE16F8212C041E ON participer');
        $this->addSql('DROP INDEX IDX_EDBE16F8EA39031 ON participer');
        $this->addSql('DROP INDEX `primary` ON participer');
        $this->addSql('ALTER TABLE participer ADD animal_id INT NOT NULL, ADD evenement_id INT NOT NULL, DROP id_animal_id, DROP id_event_id');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_EDBE16F88E962C16 FOREIGN KEY (animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_EDBE16F8FD02F13 FOREIGN KEY (evenement_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_EDBE16F88E962C16 ON participer (animal_id)');
        $this->addSql('CREATE INDEX IDX_EDBE16F8FD02F13 ON participer (evenement_id)');
        $this->addSql('ALTER TABLE participer ADD PRIMARY KEY (animal_id, evenement_id)');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA37F72333D');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA37F72333D7F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE date_evenement (id_event_id INT NOT NULL, id_ticket_id INT NOT NULL, INDEX IDX_34505BAAF035FBF5 (id_ticket_id), INDEX IDX_34505BAA212C041E (id_event_id), PRIMARY KEY(id_event_id, id_ticket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE date_evenement ADD CONSTRAINT FK_34505BAAF035FBF5 FOREIGN KEY (id_ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE date_evenement ADD CONSTRAINT FK_34505BAA212C041E FOREIGN KEY (id_event_id) REFERENCES evenement (id)');
        $this->addSql('ALTER TABLE passage_evenement DROP FOREIGN KEY FK_B04118C02C115A61');
        $this->addSql('ALTER TABLE reservation_evenement DROP FOREIGN KEY FK_11610981F035FBF5');
        $this->addSql('ALTER TABLE reservation_evenement DROP FOREIGN KEY FK_1161098178DE4B3B');
        $this->addSql('ALTER TABLE voir DROP FOREIGN KEY FK_26AF6CBF8E962C168E962C16');
        $this->addSql('ALTER TABLE voir DROP FOREIGN KEY FK_26AF6CBF700047D2700047D2');
        $this->addSql('DROP TABLE passage_evenement');
        $this->addSql('DROP TABLE reservation_evenement');
        $this->addSql('DROP TABLE voir');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F97A77B84');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FBCF5E72D');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F3DA5256D');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FB1C0859');
        $this->addSql('DROP INDEX IDX_6AAB231F97A77B84 ON animal');
        $this->addSql('DROP INDEX IDX_6AAB231FBCF5E72D ON animal');
        $this->addSql('DROP INDEX IDX_6AAB231F3DA5256D ON animal');
        $this->addSql('DROP INDEX IDX_6AAB231FB1C0859 ON animal');
        $this->addSql('ALTER TABLE animal ADD id_famille_id INT DEFAULT NULL, ADD id_categorie_id INT DEFAULT NULL, ADD id_image_id INT DEFAULT NULL, ADD id_enclos_id INT DEFAULT NULL, DROP famille_id, DROP categorie_id, DROP image_id, DROP enclos_id');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F6D7EC9F8 FOREIGN KEY (id_image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F8B29B47E FOREIGN KEY (id_enclos_id) REFERENCES enclos (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F322DFB53 FOREIGN KEY (id_famille_id) REFERENCES famille (id)');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F9F34925F FOREIGN KEY (id_categorie_id) REFERENCES categorie (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F322DFB53 ON animal (id_famille_id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F6D7EC9F8 ON animal (id_image_id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F9F34925F ON animal (id_categorie_id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F8B29B47E ON animal (id_enclos_id)');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EB1C0859');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E3DA5256D');
        $this->addSql('DROP INDEX IDX_B26681EB1C0859 ON evenement');
        $this->addSql('DROP INDEX IDX_B26681E3DA5256D ON evenement');
        $this->addSql('ALTER TABLE evenement ADD id_enclos_id INT DEFAULT NULL, ADD id_image_id INT DEFAULT NULL, DROP enclos_id, DROP image_id');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E6D7EC9F8 FOREIGN KEY (id_image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E8B29B47E FOREIGN KEY (id_enclos_id) REFERENCES enclos (id)');
        $this->addSql('CREATE INDEX IDX_B26681E6D7EC9F8 ON evenement (id_image_id)');
        $this->addSql('CREATE INDEX IDX_B26681E8B29B47E ON evenement (id_enclos_id)');
        $this->addSql('ALTER TABLE participer DROP FOREIGN KEY FK_EDBE16F88E962C16');
        $this->addSql('ALTER TABLE participer DROP FOREIGN KEY FK_EDBE16F8FD02F13');
        $this->addSql('DROP INDEX IDX_EDBE16F88E962C16 ON participer');
        $this->addSql('DROP INDEX IDX_EDBE16F8FD02F13 ON participer');
        $this->addSql('DROP INDEX `PRIMARY` ON participer');
        $this->addSql('ALTER TABLE participer ADD id_animal_id INT NOT NULL, ADD id_event_id INT NOT NULL, DROP animal_id, DROP evenement_id');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_EDBE16F8EA39031 FOREIGN KEY (id_animal_id) REFERENCES animal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE participer ADD CONSTRAINT FK_EDBE16F8212C041E FOREIGN KEY (id_event_id) REFERENCES evenement (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_EDBE16F8212C041E ON participer (id_event_id)');
        $this->addSql('CREATE INDEX IDX_EDBE16F8EA39031 ON participer (id_animal_id)');
        $this->addSql('ALTER TABLE participer ADD PRIMARY KEY (id_animal_id, id_event_id)');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA37F72333D7F72333D');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA37F72333D FOREIGN KEY (visiteur_id) REFERENCES visiteur (id)');
    }
}
