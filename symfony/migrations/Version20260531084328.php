<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260531084328 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchase_order_line ADD purchase_order_id INT NOT NULL');
        $this->addSql('ALTER TABLE purchase_order_line ADD CONSTRAINT FK_90D6D92BA45D7E6A FOREIGN KEY (purchase_order_id) REFERENCES purchase_order (id)');
        $this->addSql('CREATE INDEX IDX_90D6D92BA45D7E6A ON purchase_order_line (purchase_order_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchase_order_line DROP FOREIGN KEY FK_90D6D92BA45D7E6A');
        $this->addSql('DROP INDEX IDX_90D6D92BA45D7E6A ON purchase_order_line');
        $this->addSql('ALTER TABLE purchase_order_line DROP purchase_order_id');
    }
}
