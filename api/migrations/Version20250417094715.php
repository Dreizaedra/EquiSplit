<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250417094715 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_expense ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE UNIQUE INDEX user_expense_unique ON user_expense (user_id, expense_id)');
        $this->addSql('ALTER TABLE user_travel ADD id INT AUTO_INCREMENT NOT NULL, DROP PRIMARY KEY, ADD PRIMARY KEY (id)');
        $this->addSql('CREATE UNIQUE INDEX user_travel_unique ON user_travel (user_id, travel_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user_expense MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX user_expense_unique ON user_expense');
        $this->addSql('DROP INDEX `PRIMARY` ON user_expense');
        $this->addSql('ALTER TABLE user_expense DROP id');
        $this->addSql('ALTER TABLE user_expense ADD PRIMARY KEY (user_id, expense_id)');
        $this->addSql('ALTER TABLE user_travel MODIFY id INT NOT NULL');
        $this->addSql('DROP INDEX user_travel_unique ON user_travel');
        $this->addSql('DROP INDEX `PRIMARY` ON user_travel');
        $this->addSql('ALTER TABLE user_travel DROP id');
        $this->addSql('ALTER TABLE user_travel ADD PRIMARY KEY (user_id, travel_id)');
    }
}
