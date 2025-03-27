<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250327083350 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__review AS SELECT id, book_id, rating, body, publication_date FROM review
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE review
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE review (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, book_id INTEGER NOT NULL, rating INTEGER DEFAULT NULL, body VARCHAR(255) NOT NULL, publication_date DATETIME DEFAULT NULL, CONSTRAINT FK_794381C616A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON UPDATE NO ACTION ON DELETE NO ACTION NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO review (id, book_id, rating, body, publication_date) SELECT id, book_id, rating, body, publication_date FROM __temp__review
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__review
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_794381C616A2B381 ON review (book_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__review AS SELECT id, book_id, rating, body, publication_date FROM review
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE review
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE review (id VARCHAR(255) NOT NULL, book_id INTEGER NOT NULL, rating INTEGER DEFAULT NULL, body VARCHAR(255) NOT NULL, publication_date DATETIME DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_794381C616A2B381 FOREIGN KEY (book_id) REFERENCES book (id) NOT DEFERRABLE INITIALLY IMMEDIATE)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO review (id, book_id, rating, body, publication_date) SELECT id, book_id, rating, body, publication_date FROM __temp__review
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__review
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_794381C616A2B381 ON review (book_id)
        SQL);
    }
}
