<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214173002 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F6D7EC9F8');
        $this->addSql('DROP INDEX IDX_6AAB231F6D7EC9F8 ON animal');
        $this->addSql('ALTER TABLE animal CHANGE id_image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F3DA5256D ON animal (image_id)');
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E6D7EC9F8');
        $this->addSql('DROP INDEX IDX_B26681E6D7EC9F8 ON evenement');
        $this->addSql('ALTER TABLE evenement CHANGE id_image_id image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_B26681E3DA5256D ON evenement (image_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE evenement DROP FOREIGN KEY FK_B26681E3DA5256D');
        $this->addSql('DROP INDEX IDX_B26681E3DA5256D ON evenement');
        $this->addSql('ALTER TABLE evenement CHANGE image_id id_image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE evenement ADD CONSTRAINT FK_B26681E6D7EC9F8 FOREIGN KEY (id_image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_B26681E6D7EC9F8 ON evenement (id_image_id)');
        $this->addSql('ALTER TABLE animal DROP FOREIGN KEY FK_6AAB231F3DA5256D');
        $this->addSql('DROP INDEX IDX_6AAB231F3DA5256D ON animal');
        $this->addSql('ALTER TABLE animal CHANGE image_id id_image_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE animal ADD CONSTRAINT FK_6AAB231F6D7EC9F8 FOREIGN KEY (id_image_id) REFERENCES image (id)');
        $this->addSql('CREATE INDEX IDX_6AAB231F6D7EC9F8 ON animal (id_image_id)');
    }
}
