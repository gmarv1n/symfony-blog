<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200422020939 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment ADD author_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid_binary)\', ADD post_id BINARY(16) NOT NULL COMMENT \'(DC2Type:uuid_binary)\', DROP user_name, DROP post_slug');
        $this->addSql('ALTER TABLE post_like CHANGE id id BINARY(16) DEFAULT \'uuid_binary()\' NOT NULL COMMENT \'(DC2Type:uuid_binary)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE comment ADD user_name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, ADD post_slug VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, DROP author_id, DROP post_id');
        $this->addSql('ALTER TABLE post_like CHANGE id id BINARY(16) DEFAULT \'0x757569645F62696E6172792829\' NOT NULL COMMENT \'(DC2Type:uuid_binary)\'');
    }
}
