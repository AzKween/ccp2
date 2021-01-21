<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210121193230 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles (id INT AUTO_INCREMENT NOT NULL, relation_kinds_id INT DEFAULT NULL, categories_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, price DOUBLE PRECISION NOT NULL, description LONGTEXT NOT NULL, picture VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, date_add DATETIME NOT NULL, INDEX IDX_BFDD31686F50FCFD (relation_kinds_id), INDEX IDX_BFDD3168A21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, relation_user_id INT DEFAULT NULL, articles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', total DOUBLE PRECISION NOT NULL, UNIQUE INDEX UNIQ_BA388B7BE15C1E4 (relation_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, category VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, full_name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, subject VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, reply LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE features (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, text LONGTEXT NOT NULL, feature_picture VARCHAR(255) NOT NULL, updated_at DATETIME NOT NULL, date_add DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gcsgcu (id INT AUTO_INCREMENT NOT NULL, text LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE kinds (id INT AUTO_INCREMENT NOT NULL, kind VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ordered (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, articles LONGTEXT NOT NULL, total DOUBLE PRECISION NOT NULL, date DATE NOT NULL, num_ordered INT NOT NULL, delivery_address LONGTEXT NOT NULL, billing_address LONGTEXT NOT NULL, INDEX IDX_C3121F99A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE site (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, home_picture VARCHAR(255) NOT NULL, first_category_picture VARCHAR(255) NOT NULL, second_category_picture VARCHAR(255) NOT NULL, home_blog LONGTEXT NOT NULL, updated_at DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, address VARCHAR(255) NOT NULL, zip INT NOT NULL, city VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31686F50FCFD FOREIGN KEY (relation_kinds_id) REFERENCES kinds (id)');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD3168A21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE cart ADD CONSTRAINT FK_BA388B7BE15C1E4 FOREIGN KEY (relation_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE ordered ADD CONSTRAINT FK_C3121F99A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD3168A21214B7');
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31686F50FCFD');
        $this->addSql('ALTER TABLE cart DROP FOREIGN KEY FK_BA388B7BE15C1E4');
        $this->addSql('ALTER TABLE ordered DROP FOREIGN KEY FK_C3121F99A76ED395');
        $this->addSql('DROP TABLE articles');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE features');
        $this->addSql('DROP TABLE gcsgcu');
        $this->addSql('DROP TABLE kinds');
        $this->addSql('DROP TABLE ordered');
        $this->addSql('DROP TABLE site');
        $this->addSql('DROP TABLE user');
    }
}
