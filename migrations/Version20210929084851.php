<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210929084851 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE products_menus (products_id INT NOT NULL, menus_id INT NOT NULL, INDEX IDX_922CF61F6C8A81A9 (products_id), INDEX IDX_922CF61F14041B84 (menus_id), PRIMARY KEY(products_id, menus_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pubs_products (pubs_id INT NOT NULL, products_id INT NOT NULL, INDEX IDX_67DCD6142993A45A (pubs_id), INDEX IDX_67DCD6146C8A81A9 (products_id), PRIMARY KEY(pubs_id, products_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE products_menus ADD CONSTRAINT FK_922CF61F6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products_menus ADD CONSTRAINT FK_922CF61F14041B84 FOREIGN KEY (menus_id) REFERENCES menus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pubs_products ADD CONSTRAINT FK_67DCD6142993A45A FOREIGN KEY (pubs_id) REFERENCES pubs (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE pubs_products ADD CONSTRAINT FK_67DCD6146C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE events ADD pubs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE events ADD CONSTRAINT FK_5387574A2993A45A FOREIGN KEY (pubs_id) REFERENCES pubs (id)');
        $this->addSql('CREATE INDEX IDX_5387574A2993A45A ON events (pubs_id)');
        $this->addSql('ALTER TABLE products ADD categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE products ADD CONSTRAINT FK_B3BA5A5AA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE INDEX IDX_B3BA5A5AA21214B7 ON products (categories_id)');
        $this->addSql('ALTER TABLE user ADD pubs_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D6492993A45A FOREIGN KEY (pubs_id) REFERENCES pubs (id)');
        $this->addSql('CREATE INDEX IDX_8D93D6492993A45A ON user (pubs_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE products_menus');
        $this->addSql('DROP TABLE pubs_products');
        $this->addSql('ALTER TABLE events DROP FOREIGN KEY FK_5387574A2993A45A');
        $this->addSql('DROP INDEX IDX_5387574A2993A45A ON events');
        $this->addSql('ALTER TABLE events DROP pubs_id');
        $this->addSql('ALTER TABLE products DROP FOREIGN KEY FK_B3BA5A5AA21214B7');
        $this->addSql('DROP INDEX IDX_B3BA5A5AA21214B7 ON products');
        $this->addSql('ALTER TABLE products DROP categories_id');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D6492993A45A');
        $this->addSql('DROP INDEX IDX_8D93D6492993A45A ON user');
        $this->addSql('ALTER TABLE user DROP pubs_id');
    }
}
