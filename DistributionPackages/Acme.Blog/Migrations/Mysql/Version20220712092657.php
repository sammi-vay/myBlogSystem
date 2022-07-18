<?php

declare(strict_types=1);

namespace Neos\Flow\Persistence\Doctrine\Migrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220712092657 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1027Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1027Platform'."
        );

        $this->addSql('CREATE TABLE acme_blog_domain_model_post_comments_join (blog_post VARCHAR(40) NOT NULL, blog_comment VARCHAR(40) NOT NULL, INDEX IDX_333C7466BA5AE01D (blog_post), UNIQUE INDEX UNIQ_333C74667882EFEF (blog_comment), PRIMARY KEY(blog_post, blog_comment)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE acme_blog_domain_model_post_tags_join (blog_post VARCHAR(40) NOT NULL, blog_tag VARCHAR(40) NOT NULL, INDEX IDX_D8BEFB2ABA5AE01D (blog_post), INDEX IDX_D8BEFB2A6EC3989 (blog_tag), PRIMARY KEY(blog_post, blog_tag)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE acme_blog_domain_model_post_comments_join ADD CONSTRAINT FK_333C7466BA5AE01D FOREIGN KEY (blog_post) REFERENCES acme_blog_domain_model_post (persistence_object_identifier) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acme_blog_domain_model_post_comments_join ADD CONSTRAINT FK_333C74667882EFEF FOREIGN KEY (blog_comment) REFERENCES acme_blog_domain_model_comment (persistence_object_identifier) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE acme_blog_domain_model_post_tags_join ADD CONSTRAINT FK_D8BEFB2ABA5AE01D FOREIGN KEY (blog_post) REFERENCES acme_blog_domain_model_post (persistence_object_identifier)');
        $this->addSql('ALTER TABLE acme_blog_domain_model_post_tags_join ADD CONSTRAINT FK_D8BEFB2A6EC3989 FOREIGN KEY (blog_tag) REFERENCES acme_blog_domain_model_tag (persistence_object_identifier)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf(
            !$this->connection->getDatabasePlatform() instanceof \Doctrine\DBAL\Platforms\MariaDb1027Platform,
            "Migration can only be executed safely on '\Doctrine\DBAL\Platforms\MariaDb1027Platform'."
        );

        $this->addSql('DROP TABLE acme_blog_domain_model_post_comments_join');
        $this->addSql('DROP TABLE acme_blog_domain_model_post_tags_join');
    }
}
