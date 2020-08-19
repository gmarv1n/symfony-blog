<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200813015846 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE comment (id BYTEA NOT NULL, author_id BYTEA NOT NULL, post_id BYTEA NOT NULL, comment TEXT NOT NULL, is_approved BOOLEAN NOT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('COMMENT ON COLUMN comment.id IS \'(DC2Type:uuid_binary)\'');
        $this->addSql('COMMENT ON COLUMN comment.author_id IS \'(DC2Type:uuid_binary)\'');
        $this->addSql('COMMENT ON COLUMN comment.post_id IS \'(DC2Type:uuid_binary)\'');
        $this->addSql('CREATE TABLE post_like (id BYTEA DEFAULT \'uuid_binary()\' NOT NULL, user_id BYTEA NOT NULL, post_id BYTEA NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX postlike_pair ON post_like (user_id, post_id)');
        $this->addSql('COMMENT ON COLUMN post_like.id IS \'(DC2Type:uuid_binary)\'');
        $this->addSql('COMMENT ON COLUMN post_like.user_id IS \'(DC2Type:uuid_binary)\'');
        $this->addSql('COMMENT ON COLUMN post_like.post_id IS \'(DC2Type:uuid_binary)\'');
        $this->addSql('CREATE TABLE blog_post (id BYTEA NOT NULL, title VARCHAR(255) NOT NULL, slug VARCHAR(255) NOT NULL, image_name VARCHAR(255) DEFAULT NULL, image_size INT DEFAULT NULL, short_content VARCHAR(255) NOT NULL, content TEXT NOT NULL, category VARCHAR(255) NOT NULL, tags TEXT DEFAULT NULL, date TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, author_nick VARCHAR(255) NOT NULL, author_id BYTEA NOT NULL, likes_count INT DEFAULT 0, comments_count INT DEFAULT 0, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BA5AE01D989D9B62 ON blog_post (slug)');
        $this->addSql('COMMENT ON COLUMN blog_post.id IS \'(DC2Type:uuid_binary)\'');
        $this->addSql('COMMENT ON COLUMN blog_post.author_id IS \'(DC2Type:uuid_binary)\'');
        $this->addSql('CREATE TABLE "user" (id BYTEA NOT NULL, email VARCHAR(180) NOT NULL, user_nick_name VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649E7927C74 ON "user" (email)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_8D93D649A0A5280D ON "user" (user_nick_name)');
        $this->addSql('COMMENT ON COLUMN "user".id IS \'(DC2Type:uuid_binary)\'');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE comment');
        $this->addSql('DROP TABLE post_like');
        $this->addSql('DROP TABLE blog_post');
        $this->addSql('DROP TABLE "user"');
    }
}
