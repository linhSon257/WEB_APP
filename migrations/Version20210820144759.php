<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210820144759 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brand (id INT AUTO_INCREMENT NOT NULL, brand_name VARCHAR(50) NOT NULL, brand_description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE laptop (id INT AUTO_INCREMENT NOT NULL, size_id INT NOT NULL, brand_id INT NOT NULL, name VARCHAR(100) NOT NULL, color VARCHAR(50) NOT NULL, amount INT NOT NULL, madein VARCHAR(50) NOT NULL, price INT NOT NULL, price_discount INT NOT NULL, image VARCHAR(255) NOT NULL, INDEX IDX_E001563B498DA827 (size_id), INDEX IDX_E001563B44F5D008 (brand_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE size (id INT AUTO_INCREMENT NOT NULL, size_name VARCHAR(50) NOT NULL, size_description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE laptop ADD CONSTRAINT FK_E001563B498DA827 FOREIGN KEY (size_id) REFERENCES size (id)');
        $this->addSql('ALTER TABLE laptop ADD CONSTRAINT FK_E001563B44F5D008 FOREIGN KEY (brand_id) REFERENCES brand (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE laptop DROP FOREIGN KEY FK_E001563B44F5D008');
        $this->addSql('ALTER TABLE laptop DROP FOREIGN KEY FK_E001563B498DA827');
        $this->addSql('DROP TABLE brand');
        $this->addSql('DROP TABLE laptop');
        $this->addSql('DROP TABLE size');
    }
}
