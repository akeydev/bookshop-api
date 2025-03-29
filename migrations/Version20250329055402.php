<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250329055402 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TEMPORARY TABLE __temp__order AS SELECT id, status, order_status, book_id, quantity, price FROM "order"
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "order"
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE "order" (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, status VARCHAR(32) NOT NULL, order_status VARCHAR(128) NOT NULL, book_id INTEGER NOT NULL, quantity INTEGER NOT NULL, price INTEGER NOT NULL)
        SQL);
        $this->addSql(<<<'SQL'
            INSERT INTO "order" (id, status, order_status, book_id, quantity, price) SELECT id, status, order_status, book_id, quantity, price FROM __temp__order
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE __temp__order
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE "order" ADD COLUMN order_id INTEGER NOT NULL
        SQL);
    }
}
