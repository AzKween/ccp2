<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210121102637 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cart (id INT AUTO_INCREMENT NOT NULL, articles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', total DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE cart_articles (cart_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_21427E031AD5CDBF (cart_id), INDEX IDX_21427E031EBAF6CC (articles_id), PRIMARY KEY(cart_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cart_articles ADD CONSTRAINT FK_21427E031AD5CDBF FOREIGN KEY (cart_id) REFERENCES cart (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cart_articles ADD CONSTRAINT FK_21427E031EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ordered DROP FOREIGN KEY FK_C3121F993AEDFCE');
        $this->addSql('DROP INDEX IDX_C3121F993AEDFCE ON ordered');
        $this->addSql('ALTER TABLE ordered DROP relation_cart_id');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cart_articles DROP FOREIGN KEY FK_21427E031AD5CDBF');
        $this->addSql('DROP TABLE cart');
        $this->addSql('DROP TABLE cart_articles');
        $this->addSql('ALTER TABLE ordered ADD relation_cart_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ordered ADD CONSTRAINT FK_C3121F993AEDFCE FOREIGN KEY (relation_cart_id) REFERENCES cart (id)');
        $this->addSql('CREATE INDEX IDX_C3121F993AEDFCE ON ordered (relation_cart_id)');
    }
}
