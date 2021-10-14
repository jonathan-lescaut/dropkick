<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211014075713 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name_category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE events (id INT AUTO_INCREMENT NOT NULL, pubs_id INT DEFAULT NULL, name_event VARCHAR(255) NOT NULL, img_event VARCHAR(255) NOT NULL, date_event DATETIME NOT NULL, content_event LONGTEXT NOT NULL, place_event VARCHAR(255) NOT NULL, INDEX IDX_5387574A2993A45A (pubs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE products (id INT AUTO_INCREMENT NOT NULL, categories_id INT DEFAULT NULL, pub_id INT DEFAULT NULL, name_product VARCHAR(255) NOT NULL, price_product VARCHAR(255) NOT NULL, content_product LONGTEXT NOT NULL, img_product VARCHAR(255) NOT NULL, INDEX IDX_B3BA5A5AA21214B7 (categories_id), INDEX IDX_B3BA5A5A83FDE077 (pub_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pubs (id INT AUTO_INCREMENT NOT NULL, name_pub VARCHAR(255) NOT NULL, img_pub VARCHAR(255) NOT NULL, content_pub LONGTEXT NOT NULL, city_pub VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, pubs_id INT DEFAULT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, last_name_user VARCHAR(255) NOT NULL, first_name_user VARCHAR(255) NOT NULL, address_user VARCHAR(255) NOT NULL, city_user VARCHAR(255) NOT NULL, cp_user INT NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D6492993A45A (pubs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574A2993A45A FOREIGN KEY (pubs_id) REFERENCES pubs (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5A83FDE077 FOREIGN KEY (pub_id) REFERENCES pubs (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492993A45A FOREIGN KEY (pubs_id) REFERENCES pubs (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AA21214B7');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574A2993A45A');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5A83FDE077');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492993A45A');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE events');
        $this->addSql('DROP TABLE products');
        $this->addSql('DROP TABLE pubs');
        $this->addSql('DROP TABLE user');
    }
}
