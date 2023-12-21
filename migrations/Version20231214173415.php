<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214173415 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F8B29B47E');
        $this->addSql('DROP INDEX IDX_6AAB231F8B29B47E ON animal');
        $this->addSql('ALTER TABLE animal CHANGE id_enclos_id enclos_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231FB1C0859 FOREIGN KEY (enclos_id) REFERENCES enclos (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231FB1C0859 ON animal (enclos_id)');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E8B29B47E');
        $this->addSql('DROP INDEX IDX_B26681E8B29B47E ON evenement');
        $this->addSql('ALTER TABLE evenement CHANGE id_enclos_id enclos_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681EB1C0859 FOREIGN KEY (enclos_id) REFERENCES enclos (id)');
        $this->addSql('CREATE INDEX IDX_B26681EB1C0859 ON evenement (enclos_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681EB1C0859');
        $this->addSql('DROP INDEX IDX_B26681EB1C0859 ON evenement');
        $this->addSql('ALTER TABLE evenement CHANGE enclos_id id_enclos_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E8B29B47E FOREIGN KEY (id_enclos_id) REFERENCES enclos (id)');
        $this->addSql('CREATE INDEX IDX_B26681E8B29B47E ON evenement (id_enclos_id)');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231FB1C0859');
        $this->addSql('DROP INDEX IDX_6AAB231FB1C0859 ON animal');
        $this->addSql('ALTER TABLE animal CHANGE enclos_id id_enclos_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F8B29B47E FOREIGN KEY (id_enclos_id) REFERENCES enclos (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F8B29B47E ON animal (id_enclos_id)');
    }
}
