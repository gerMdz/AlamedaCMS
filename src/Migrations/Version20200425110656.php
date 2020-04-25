<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200425110656 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE page_index (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE index_alameda (id INT AUTO_INCREMENT NOT NULL, lema VARCHAR(255) NOT NULL, lema_principal VARCHAR(255) DEFAULT NULL, lema_sin_espacio VARCHAR(255) NOT NULL, horario1 VARCHAR(5) DEFAULT NULL, horario2 VARCHAR(5) DEFAULT NULL, texto_versiculo VARCHAR(255) DEFAULT NULL, versiculo VARCHAR(255) DEFAULT NULL, meta_descripcion VARCHAR(255) NOT NULL, meta_autor VARCHAR(255) NOT NULL, meta_title VARCHAR(255) NOT NULL, meta_type VARCHAR(255) NOT NULL, meta_url VARCHAR(255) NOT NULL, meta_image VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE page_index');
        $this->addSql('DROP TABLE index_alameda');
    }
}
