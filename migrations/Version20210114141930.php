<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210114141930 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE articles_kinds (articles_id INT NOT NULL, kinds_id INT NOT NULL, INDEX IDX_CD849331EBAF6CC (articles_id), INDEX IDX_CD84933484BC645 (kinds_id), PRIMARY KEY(articles_id, kinds_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, articles TINYTEXT NOT NULL, total DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_articles (cart_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_21427E031AD5CDBF (cart_id), INDEX IDX_21427E031EBAF6CC (articles_id), PRIMARY KEY(cart_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE features (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, feature_picture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gcsgcu (id INT AUTO_INCREMENT NOT NULL, text LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kinds (id INT AUTO_INCREMENT NOT NULL, kind VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordered (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, relation_cart_id INT DEFAULT NULL, articles LONGTEXT NOT NULL, total DOUBLE PRECISION NOT NULL, date DATE NOT NULL, num_ordered INT NOT NULL, delivery_address LONGTEXT NOT NULL, billing_address LONGTEXT NOT NULL, INDEX IDX_C3121F99A76ED395 (user_id), INDEX IDX_C3121F993AEDFCE (relation_cart_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles_kinds ADD CONSTRAINT FK_CD849331EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles_kinds ADD CONSTRAINT FK_CD84933484BC645 FOREIGN KEY (kinds_id) REFERENCES kinds (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_articles ADD CONSTRAINT FK_21427E031AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_articles ADD CONSTRAINT FK_21427E031EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ordered ADD CONSTRAINT FK_C3121F99A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ordered ADD CONSTRAINT FK_C3121F993AEDFCE FOREIGN KEY (relation_cart_id) REFERENCES cart (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles_kinds DROP FOREIGN KEY FK_CD849331EBAF6CC');
        $this->addSql('ALTER TABLE cart_articles DROP FOREIGN KEY FK_21427E031EBAF6CC');
        $this->addSql('ALTER TABLE cart_articles DROP FOREIGN KEY FK_21427E031AD5CDBF');
        $this->addSql('ALTER TABLE ordered DROP FOREIGN KEY FK_C3121F993AEDFCE');
        $this->addSql('ALTER TABLE articles_kinds DROP FOREIGN KEY FK_CD84933484BC645');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE articles_kinds');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_articles');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE features');
        $this->addSql('DROP TABLE gcsgcu');
        $this->addSql('DROP TABLE kinds');
        $this->addSql('DROP TABLE ordered');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
