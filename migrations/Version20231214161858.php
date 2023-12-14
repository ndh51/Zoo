<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231214161858 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE voir (id INT AUTO_INCREMENT NOT NULL, id_animal_id INT NOT NULL, id_ticket_id INT NOT NULL, INDEX IDX_26AF6CBFEA39031 (id_animal_id), INDEX IDX_26AF6CBFF035FBF5 (id_ticket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE voir ADD CONSTRAINT FK_26AF6CBFEA39031 FOREIGN KEY (id_animal_id) REFERENCES animal (id)');
        $this->addSql('ALTER TABLE voir ADD CONSTRAINT FK_26AF6CBFF035FBF5 FOREIGN KEY (id_ticket_id) REFERENCES ticket (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE voir DROP FOREIGN KEY FK_26AF6CBFEA39031');
        $this->addSql('ALTER TABLE voir DROP FOREIGN KEY FK_26AF6CBFF035FBF5');
        $this->addSql('DROP TABLE voir');
    }
}
