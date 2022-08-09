<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220809210846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE source_api (id INT AUTO_INCREMENT NOT NULL, identifier VARCHAR(100) NOT NULL, base_uri VARCHAR(255) NOT NULL, auth_basic VARCHAR(255) DEFAULT NULL, auth_bearer VARCHAR(510) DEFAULT NULL, auth_ntlm VARCHAR(255) DEFAULT NULL, base_auth VARCHAR(510) DEFAULT NULL, auth_username VARCHAR(255) DEFAULT NULL, auth_pass VARCHAR(255) DEFAULT NULL, base_endpoint VARCHAR(510) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE blocs_fixes ADD css_style VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE entrada ADD css_style VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE item_menu ADD css_style VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE menu ADD css_style VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE principal ADD css_style VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE section ADD css_style VARCHAR(255) DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE source_api');
        $this->addSql('ALTER TABLE blocs_fixes DROP css_style');
        $this->addSql('ALTER TABLE entrada DROP css_style');
        $this->addSql('ALTER TABLE item_menu DROP css_style');
        $this->addSql('ALTER TABLE menu DROP css_style');
        $this->addSql('ALTER TABLE principal DROP css_style');
        $this->addSql('ALTER TABLE section DROP css_style');
    }
}
