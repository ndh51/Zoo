<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231206174424 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, path_image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F8B29B47E');
        $this->addSql('DROP INDEX IDX_6AAB231F8B29B47E ON animal');
        $this->addSql('ALTER TABLE animal CHANGE id_enclos_id id_image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F6D7EC9F8 FOREIGN KEY (id_image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F6D7EC9F8 ON animal (id_image_id)');
        $this->addSql('ALTER TABLE evenement ADD id_image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E6D7EC9F8 FOREIGN KEY (id_image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_B26681E6D7EC9F8 ON evenement (id_image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F6D7EC9F8');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E6D7EC9F8');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP INDEX IDX_B26681E6D7EC9F8 ON evenement');
        $this->addSql('ALTER TABLE evenement DROP id_image_id');
        $this->addSql('DROP INDEX IDX_6AAB231F6D7EC9F8 ON animal');
        $this->addSql('ALTER TABLE animal CHANGE id_image_id id_enclos_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F8B29B47E FOREIGN KEY (id_enclos_id) REFERENCES enclos (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F8B29B47E ON animal (id_enclos_id)');
    }
}
