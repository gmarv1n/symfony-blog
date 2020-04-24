<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200414022821 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE blog_post_like (id VARCHAR(255) NOT NULL, user_id VARCHAR(255) NOT NULL, post_id VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE like_connection');
        $this->addSql('ALTER TABLE blog_post CHANGE image_name image_name VARCHAR(255) DEFAULT NULL, CHANGE image_size image_size INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment CHANGE id id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE like_connection (id INT AUTO_INCREMENT NOT NULL, user_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, post_slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE blog_post_like');
        $this->addSql('ALTER TABLE blog_post CHANGE image_name image_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE image_size image_size INT DEFAULT NULL');
        $this->addSql('ALTER TABLE comment CHANGE id id INT AUTO_INCREMENT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
