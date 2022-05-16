<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220516202934 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE index_alameda DROP horario1, DROP horario2, DROP texto_versiculo, DROP versiculo');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE index_alameda ADD horario1 VARCHAR(5) DEFAULT NULL, ADD horario2 VARCHAR(5) DEFAULT NULL, ADD texto_versiculo VARCHAR(255) DEFAULT NULL, ADD versiculo VARCHAR(255) DEFAULT NULL');
    }
}
