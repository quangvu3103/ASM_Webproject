<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220701115522 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product ADD type_product_id INT NOT NULL');
        $this->addSql('ALTER TABLE product ADD CONSTRAINT FK_D34A04AD5887B07F FOREIGN KEY (type_product_id) REFERENCES type_product (id)');
        $this->addSql('CREATE INDEX IDX_D34A04AD5887B07F ON product (type_product_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE product DROP FOREIGN KEY FK_D34A04AD5887B07F');
        $this->addSql('DROP INDEX IDX_D34A04AD5887B07F ON product');
        $this->addSql('ALTER TABLE product DROP type_product_id');
    }
}
