<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211026124638 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products_menus DROP FOREIGN KEY FK_922CF61F14041B84');
        $this->addSql('CREATE TABLE city (id INT AUTO_INCREMENT NOT NULL, slug VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, image VARCHAR(255) DEFAULT NULL, created DATETIME DEFAULT NULL, updated DATETIME DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE menus');
        $this->addSql('DROP TABLE products_menus');
        $this->addSql('DROP TABLE products_pubs');
        $this->addSql('ALTER TABLE pubs ADD card_pdf VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menus (id INT AUTO_INCREMENT NOT NULL, pubs_id INT DEFAULT NULL, name_menu VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, price_menu NUMERIC(10, 0) NOT NULL, img_menu VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_727508CF2993A45A (pubs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE products_menus (products_id INT NOT NULL, menus_id INT NOT NULL, INDEX IDX_922CF61F6C8A81A9 (products_id), INDEX IDX_922CF61F14041B84 (menus_id), PRIMARY KEY(products_id, menus_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE products_pubs (products_id INT NOT NULL, pubs_id INT NOT NULL, INDEX IDX_A9132926C8A81A9 (products_id), INDEX IDX_A9132922993A45A (pubs_id), PRIMARY KEY(products_id, pubs_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT FK_727508CF2993A45A FOREIGN KEY (pubs_id) REFERENCES pubs (id)');
        $this->addSql('ALTER TABLE products_menus ADD CONSTRAINT FK_922CF61F14041B84 FOREIGN KEY (menus_id) REFERENCES menus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products_menus ADD CONSTRAINT FK_922CF61F6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products_pubs ADD CONSTRAINT FK_A9132922993A45A FOREIGN KEY (pubs_id) REFERENCES pubs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products_pubs ADD CONSTRAINT FK_A9132926C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE city');
        $this->addSql('ALTER TABLE pubs DROP card_pdf');
    }
}
