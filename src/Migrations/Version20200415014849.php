<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200415014849 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_post CHANGE image_name image_name VARCHAR(255) DEFAULT NULL, CHANGE image_size image_size INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE id id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid_binary)\', CHANGE roles roles JSON NOT NULL');
        $this->addSql('ALTER TABLE comment CHANGE id id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid_binary)\'');
        $this->addSql('ALTER TABLE blog_post_like CHANGE id id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid_binary)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_post CHANGE image_name image_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE image_size image_size INT DEFAULT NULL');
        $this->addSql('ALTER TABLE blog_post_like CHANGE id id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE comment CHANGE id id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE id id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
