<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211005095200 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE products_pubs');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE products_pubs (products_id INT NOT NULL, pubs_id INT NOT NULL, INDEX IDX_A9132926C8A81A9 (products_id), INDEX IDX_A9132922993A45A (pubs_id), PRIMARY KEY(products_id, pubs_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE products_pubs ADD CONSTRAINT FK_A9132922993A45A FOREIGN KEY (pubs_id) REFERENCES pubs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products_pubs ADD CONSTRAINT FK_A9132926C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
    }
}
