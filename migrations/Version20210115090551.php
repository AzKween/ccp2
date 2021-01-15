<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210115090551 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE kinds_articles (kinds_id INT NOT NULL, articles_id INT NOT NULL, INDEX IDX_D03C1924484BC645 (kinds_id), INDEX IDX_D03C19241EBAF6CC (articles_id), PRIMARY KEY(kinds_id, articles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE kinds_articles ADD CONSTRAINT FK_D03C1924484BC645 FOREIGN KEY (kinds_id) REFERENCES kinds (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE kinds_articles ADD CONSTRAINT FK_D03C19241EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE articles_kinds');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE articles_kinds (articles_id INT NOT NULL, kinds_id INT NOT NULL, INDEX IDX_CD849331EBAF6CC (articles_id), INDEX IDX_CD84933484BC645 (kinds_id), PRIMARY KEY(articles_id, kinds_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE articles_kinds ADD CONSTRAINT FK_CD849331EBAF6CC FOREIGN KEY (articles_id) REFERENCES articles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE articles_kinds ADD CONSTRAINT FK_CD84933484BC645 FOREIGN KEY (kinds_id) REFERENCES kinds (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE kinds_articles');
    }
}
