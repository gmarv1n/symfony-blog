<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200507012206 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE post_like CHANGE id id BINARY(16) DEFAULT \'uuid_binary()\' NOT NULL COMMENT \'(DC2Type:uuid_binary)\'');
        $this->addSql('CREATE UNIQUE INDEX postlike_pair ON post_like (user_id, post_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP INDEX postlike_pair ON post_like');
        $this->addSql('ALTER TABLE post_like CHANGE id id BINARY(16) DEFAULT \'0x757569645F62696E6172792829\' NOT NULL COMMENT \'(DC2Type:uuid_binary)\'');
    }
}
