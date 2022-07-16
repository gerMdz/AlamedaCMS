<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220515231617 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE item_menu_roles (item_menu_id VARCHAR(36) NOT NULL, roles_id INT NOT NULL, INDEX IDX_9A2325AAC78ACF46 (item_menu_id), INDEX IDX_9A2325AA38C751C4 (roles_id), PRIMARY KEY(item_menu_id, roles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE item_menu_roles ADD CONSTRAINT FK_9A2325AAC78ACF46 FOREIGN KEY (item_menu_id) REFERENCES item_menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_menu_roles ADD CONSTRAINT FK_9A2325AA38C751C4 FOREIGN KEY (roles_id) REFERENCES roles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_menu DROP role');
        $this->addSql('ALTER TABLE menu CHANGE identificador identificador VARCHAR(150) NOT NULL');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D053A93A8255881 ON menu (identificador)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE item_menu_roles');
        $this->addSql('ALTER TABLE item_menu ADD role VARCHAR(255) DEFAULT NULL');
        $this->addSql('DROP INDEX UNIQ_7D053A93A8255881 ON menu');
        $this->addSql('ALTER TABLE menu CHANGE identificador identificador VARCHAR(255) NOT NULL');
    }
}
