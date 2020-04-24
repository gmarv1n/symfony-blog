<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200410015903 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_post DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE blog_post CHANGE image_name image_name VARCHAR(255) DEFAULT NULL, CHANGE image_size image_size INT DEFAULT NULL, CHANGE blog_post_id id VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE blog_post ADD PRIMARY KEY (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE blog_post DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE blog_post CHANGE image_name image_name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT \'NULL\' COLLATE `utf8mb4_unicode_ci`, CHANGE image_size image_size INT DEFAULT NULL, CHANGE id blog_post_id VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE blog_post ADD PRIMARY KEY (blog_post_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`');
    }
}
