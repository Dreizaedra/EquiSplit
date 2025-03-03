<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250303155635 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE business_links (id INT AUTO_INCREMENT NOT NULL, expense_id INT NOT NULL, url VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, INDEX IDX_AF6346A7F395DB7B (expense_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contact (id INT AUTO_INCREMENT NOT NULL, expense_id INT NOT NULL, email VARCHAR(100) DEFAULT NULL, phone_number VARCHAR(22) DEFAULT NULL, INDEX IDX_4C62E638F395DB7B (expense_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE expense (id INT AUTO_INCREMENT NOT NULL, travel_id INT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, price INT DEFAULT NULL, INDEX IDX_2D3A8DA6ECAB15B3 (travel_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lodging (expense_id INT NOT NULL, address VARCHAR(255) NOT NULL, postal_code VARCHAR(5) NOT NULL, town VARCHAR(50) NOT NULL, type VARCHAR(255) NOT NULL, is_meal_included TINYINT(1) NOT NULL, PRIMARY KEY(expense_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE media (id INT AUTO_INCREMENT NOT NULL, travel_id INT NOT NULL, expense_id INT DEFAULT NULL, data_blob LONGBLOB NOT NULL, extension VARCHAR(4) NOT NULL, INDEX IDX_6A2CA10CECAB15B3 (travel_id), INDEX IDX_6A2CA10CF395DB7B (expense_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE opening_hours (id INT AUTO_INCREMENT NOT NULL, lodging_id INT NOT NULL, opening_time TIME NOT NULL, closing_time TIME NOT NULL, day_of_week VARCHAR(255) NOT NULL, INDEX IDX_2640C10B87335AF1 (lodging_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE travel (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, description LONGTEXT DEFAULT NULL, start_date DATE DEFAULT NULL, end_date DATE DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, pseudo VARCHAR(50) NOT NULL, email VARCHAR(100) NOT NULL, password VARCHAR(60) NOT NULL, UNIQUE INDEX UNIQ_8D93D64986CC499D (pseudo), UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_expense (user_id INT NOT NULL, expense_id INT NOT NULL, paid_amount INT DEFAULT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_753793ACA76ED395 (user_id), INDEX IDX_753793ACF395DB7B (expense_id), PRIMARY KEY(user_id, expense_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_travel (user_id INT NOT NULL, travel_id INT NOT NULL, status VARCHAR(255) NOT NULL, INDEX IDX_485970F3A76ED395 (user_id), INDEX IDX_485970F3ECAB15B3 (travel_id), PRIMARY KEY(user_id, travel_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE business_links ADD CONSTRAINT FK_AF6346A7F395DB7B FOREIGN KEY (expense_id) REFERENCES expense (id)');
        $this->addSql('ALTER TABLE contact ADD CONSTRAINT FK_4C62E638F395DB7B FOREIGN KEY (expense_id) REFERENCES expense (id)');
        $this->addSql('ALTER TABLE expense ADD CONSTRAINT FK_2D3A8DA6ECAB15B3 FOREIGN KEY (travel_id) REFERENCES travel (id)');
        $this->addSql('ALTER TABLE lodging ADD CONSTRAINT FK_8D35182AF395DB7B FOREIGN KEY (expense_id) REFERENCES expense (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CECAB15B3 FOREIGN KEY (travel_id) REFERENCES travel (id)');
        $this->addSql('ALTER TABLE media ADD CONSTRAINT FK_6A2CA10CF395DB7B FOREIGN KEY (expense_id) REFERENCES expense (id)');
        $this->addSql('ALTER TABLE opening_hours ADD CONSTRAINT FK_2640C10B87335AF1 FOREIGN KEY (lodging_id) REFERENCES lodging (expense_id)');
        $this->addSql('ALTER TABLE user_expense ADD CONSTRAINT FK_753793ACA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_expense ADD CONSTRAINT FK_753793ACF395DB7B FOREIGN KEY (expense_id) REFERENCES expense (id)');
        $this->addSql('ALTER TABLE user_travel ADD CONSTRAINT FK_485970F3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE user_travel ADD CONSTRAINT FK_485970F3ECAB15B3 FOREIGN KEY (travel_id) REFERENCES travel (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE business_links DROP FOREIGN KEY FK_AF6346A7F395DB7B');
        $this->addSql('ALTER TABLE contact DROP FOREIGN KEY FK_4C62E638F395DB7B');
        $this->addSql('ALTER TABLE expense DROP FOREIGN KEY FK_2D3A8DA6ECAB15B3');
        $this->addSql('ALTER TABLE lodging DROP FOREIGN KEY FK_8D35182AF395DB7B');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CECAB15B3');
        $this->addSql('ALTER TABLE media DROP FOREIGN KEY FK_6A2CA10CF395DB7B');
        $this->addSql('ALTER TABLE opening_hours DROP FOREIGN KEY FK_2640C10B87335AF1');
        $this->addSql('ALTER TABLE user_expense DROP FOREIGN KEY FK_753793ACA76ED395');
        $this->addSql('ALTER TABLE user_expense DROP FOREIGN KEY FK_753793ACF395DB7B');
        $this->addSql('ALTER TABLE user_travel DROP FOREIGN KEY FK_485970F3A76ED395');
        $this->addSql('ALTER TABLE user_travel DROP FOREIGN KEY FK_485970F3ECAB15B3');
        $this->addSql('DROP TABLE business_links');
        $this->addSql('DROP TABLE contact');
        $this->addSql('DROP TABLE expense');
        $this->addSql('DROP TABLE lodging');
        $this->addSql('DROP TABLE media');
        $this->addSql('DROP TABLE opening_hours');
        $this->addSql('DROP TABLE travel');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE user_expense');
        $this->addSql('DROP TABLE user_travel');
    }
}
