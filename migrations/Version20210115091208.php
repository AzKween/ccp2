<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210115091208 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles ADD relation_kinds_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE articles ADD CONSTRAINT FK_BFDD31686F50FCFD FOREIGN KEY (relation_kinds_id) REFERENCES kinds (id)');
        $this->addSql('CREATE INDEX IDX_BFDD31686F50FCFD ON articles (relation_kinds_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE articles DROP FOREIGN KEY FK_BFDD31686F50FCFD');
        $this->addSql('DROP INDEX IDX_BFDD31686F50FCFD ON articles');
        $this->addSql('ALTER TABLE articles DROP relation_kinds_id');
    }
}
