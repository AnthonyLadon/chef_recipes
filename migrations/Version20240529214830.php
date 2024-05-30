<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240529214830 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add category to recipe table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe ADD categ_id INT NOT NULL');
        $this->addSql('ALTER TABLE recipe ADD CONSTRAINT FK_DA88B137E8175B12 FOREIGN KEY (categ_id) REFERENCES category (id)');
        $this->addSql('CREATE INDEX IDX_DA88B137E8175B12 ON recipe (categ_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE recipe DROP FOREIGN KEY FK_DA88B137E8175B12');
        $this->addSql('DROP INDEX IDX_DA88B137E8175B12 ON recipe');
        $this->addSql('ALTER TABLE recipe DROP categ_id');
    }
}
