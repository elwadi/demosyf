<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20260531084525 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchase_order ADD client_id INT NOT NULL');
        $this->addSql('ALTER TABLE purchase_order ADD CONSTRAINT FK_21E210B219EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('CREATE INDEX IDX_21E210B219EB6921 ON purchase_order (client_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE purchase_order DROP FOREIGN KEY FK_21E210B219EB6921');
        $this->addSql('DROP INDEX IDX_21E210B219EB6921 ON purchase_order');
        $this->addSql('ALTER TABLE purchase_order DROP client_id');
    }
}
