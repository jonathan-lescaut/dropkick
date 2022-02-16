<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220210141057 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE products_menus DROP FOREIGN KEY FK_922CF61F14041B84');
        $this->addSql('DROP TABLE menus');
        $this->addSql('DROP TABLE products_menus');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menus (id INT AUTO_INCREMENT NOT NULL, pubs_id INT DEFAULT NULL, name_menu VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, price_menu NUMERIC(10, 0) NOT NULL, img_menu VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_727508CF2993A45A (pubs_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE products_menus (products_id INT NOT NULL, menus_id INT NOT NULL, INDEX IDX_922CF61F6C8A81A9 (products_id), INDEX IDX_922CF61F14041B84 (menus_id), PRIMARY KEY(products_id, menus_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE menus ADD CONSTRAINT FK_727508CF2993A45A FOREIGN KEY (pubs_id) REFERENCES pubs (id)');
        $this->addSql('ALTER TABLE products_menus ADD CONSTRAINT FK_922CF61F14041B84 FOREIGN KEY (menus_id) REFERENCES menus (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE products_menus ADD CONSTRAINT FK_922CF61F6C8A81A9 FOREIGN KEY (products_id) REFERENCES products (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart CHANGE content_cart content_cart LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE categories CHANGE name_category name_category VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE city CHANGE slug slug VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE events CHANGE name_event name_event VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE img_event img_event VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE content_event content_event LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE place_event place_event VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE fb_event fb_event VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE `order` CHANGE reference_order reference_order VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE stripe_token stripe_token VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE brand_stripe brand_stripe VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last4_stripe last4_stripe VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE id_charge_stripe id_charge_stripe VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE status_stripe status_stripe VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE presentation CHANGE title_left title_left VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE text_right text_right LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE title_right title_right VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE text_left text_left LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE products CHANGE name_product name_product VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE price_product price_product VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE content_product content_product LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE img_product img_product VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE pubs CHANGE name_pub name_pub VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE img_pub img_pub VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE content_pub content_pub LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE city_pub city_pub VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE card_pdf card_pdf VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE address_pub address_pub VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE phone_pub phone_pub VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE iframe_pub iframe_pub LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE schedule_pub schedule_pub LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE last_name_user last_name_user VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE first_name_user first_name_user VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE address_user address_user VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE city_user city_user VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
