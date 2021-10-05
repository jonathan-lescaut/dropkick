<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005095454 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products ADD pub_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A83FDE077 FOREIGN KEY (pub_id) REFERENCES pubs (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5A83FDE077 ON products (pub_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A83FDE077');
        $this->addSql('DROP INDEX IDX_B3BA5A5A83FDE077 ON products');
        $this->addSql('ALTER TABLE products DROP pub_id');
    }
}
