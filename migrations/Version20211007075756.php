<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211007075756 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menus ADD pubs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT FK_727508CF2993A45A FOREIGN KEY (pubs_id) REFERENCES pubs (id)');
        $this->addSql('CREATE INDEX IDX_727508CF2993A45A ON menus (pubs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE menus DROP FOREIGN KEY FK_727508CF2993A45A');
        $this->addSql('DROP INDEX IDX_727508CF2993A45A ON menus');
        $this->addSql('ALTER TABLE menus DROP pubs_id');
    }
}
