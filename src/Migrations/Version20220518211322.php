<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220518211322 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
//        $this->addSql('ALTER TABLE brote_entrada DROP FOREIGN KEY FK_5BF3296BEC13593E');
//        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E702EC13593E');
//        $this->addSql('DROP TABLE brote');
//        $this->addSql('DROP TABLE brote_entrada');
//        $this->addSql('DROP INDEX IDX_4B91E702EC13593E ON comentario');
//        $this->addSql('ALTER TABLE comentario DROP brote_id');
//        $this->addSql('ALTER TABLE index_alameda DROP horario1, DROP horario2, DROP texto_versiculo, DROP versiculo');
//        $this->addSql('ALTER TABLE item_menu ADD orderitem INT DEFAULT NULL');
//        $this->addSql('ALTER TABLE menu CHANGE identificador identificador VARCHAR(150) NOT NULL');
//        $this->addSql('CREATE UNIQUE INDEX UNIQ_7D053A93A8255881 ON menu (identificador)');
        $this->addSql('ALTER TABLE meta_base ADD favicon LONGTEXT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE brote (id INT AUTO_INCREMENT NOT NULL, autor_id VARCHAR(40) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, principal_id INT DEFAULT NULL, titulo VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, contenido VARCHAR(2550) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, link_route VARCHAR(150) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, image_filename VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, likes INT DEFAULT NULL, publicado_at DATETIME DEFAULT NULL, activa TINYINT(1) DEFAULT NULL, evento_at DATETIME DEFAULT NULL, link_posting VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, disponible_at DATETIME DEFAULT NULL, disponible_hasta_at DATETIME DEFAULT NULL, INDEX IDX_D1E61E1F14D45BBE (autor_id), INDEX IDX_D1E61E1F474870EE (principal_id), UNIQUE INDEX UNIQ_D1E61E1FAD7F7CA7 (link_route), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE brote_entrada (brote_id INT NOT NULL, entrada_id INT NOT NULL, INDEX IDX_5BF3296BA688222A (entrada_id), INDEX IDX_5BF3296BEC13593E (brote_id), PRIMARY KEY(brote_id, entrada_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE brote ADD CONSTRAINT FK_D1E61E1F14D45BBE FOREIGN KEY (autor_id) REFERENCES user (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE brote ADD CONSTRAINT FK_D1E61E1F474870EE FOREIGN KEY (principal_id) REFERENCES principal (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE brote_entrada ADD CONSTRAINT FK_5BF3296BA688222A FOREIGN KEY (entrada_id) REFERENCES entrada (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE brote_entrada ADD CONSTRAINT FK_5BF3296BEC13593E FOREIGN KEY (brote_id) REFERENCES brote (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE api_token CHANGE user_id user_id VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE token token VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE blocs_fixes CHANGE id id CHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\', CHANGE fixes_type_id fixes_type_id CHAR(36) DEFAULT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\', CHANGE description description VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE css_class css_class VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_filename image_filename VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE identificador identificador VARCHAR(150) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE blocs_fixes_principal CHANGE blocs_fixes_id blocs_fixes_id CHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE blocs_fixes_section CHANGE blocs_fixes_id blocs_fixes_id CHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\'');
        $this->addSql('ALTER TABLE button_link CHANGE css_class css_class VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link_route link_route VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE text_button text_button VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE celebracion CHANGE id id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE crea_evento_id crea_evento_id VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nombre nombre VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE descripcion descripcion VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_qr image_qr VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE channel_feed CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE autor autor VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE owner owner VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE descripcion descripcion VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image image VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link link VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE comentario ADD brote_id INT DEFAULT NULL, CHANGE autor_id autor_id VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE contenido contenido VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E702EC13593E FOREIGN KEY (brote_id) REFERENCES brote (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4B91E702EC13593E ON comentario (brote_id)');
        $this->addSql('ALTER TABLE contacto CHANGE link_route link_route VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE texto_mensaje texto_mensaje VARCHAR(510) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE texto_pagina texto_pagina VARCHAR(510) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nombre nombre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE enlace_corto CHANGE usuario_id usuario_id VARCHAR(40) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link_route link_route VARCHAR(150) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE url_destino url_destino VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE entrada CHANGE autor_id autor_id VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE titulo titulo VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE contenido contenido TEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_filename image_filename VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type_origin type_origin VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE type_carry type_carry VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE footer footer VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE identificador identificador VARCHAR(150) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link_posting link_posting VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link_route link_route VARCHAR(150) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE css_class css_class VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE entrada_reference CHANGE filename filename VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE original_filename original_filename VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE mime_type mime_type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE group_celebration CHANGE id id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE base_css base_css VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE bton_css bton_css VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_bg image_bg VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_filename image_filename VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE group_celebration_celebracion CHANGE group_celebration_id group_celebration_id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE celebracion_id celebracion_id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE index_alameda ADD horario1 VARCHAR(5) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD horario2 VARCHAR(5) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD texto_versiculo VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD versiculo VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lema lema VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lema_principal lema_principal VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lema_sin_espacio lema_sin_espacio VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE meta_descripcion meta_descripcion VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE meta_autor meta_autor VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE meta_title meta_title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE meta_type meta_type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE meta_url meta_url VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE meta_image meta_image VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE base base VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE invitado CHANGE id id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE enlace_id enlace_id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE celebracion_id celebracion_id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE telefono telefono VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE dni dni VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nombre nombre VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE apellido apellido VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE item_feed CHANGE title title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE descripcion descripcion VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link_url link_url VARCHAR(510) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link_type link_type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link_length link_length VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE guid guid VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE item_menu DROP orderitem, CHANGE id id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE parent_id parent_id VARCHAR(36) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE `label` `label` VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE badge badge VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE icon icon VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE path_libre path_libre VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE css_class css_class VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE identificador identificador VARCHAR(150) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE item_menu_menu CHANGE item_menu_id item_menu_id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE menu_id menu_id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE item_menu_roles CHANGE item_menu_id item_menu_id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('DROP INDEX UNIQ_7D053A93A8255881 ON menu');
        $this->addSql('ALTER TABLE menu CHANGE id id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nombre nombre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE css_class css_class VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE identificador identificador VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE meta_base DROP favicon, CHANGE lema lema VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE lema_principal lema_principal VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE meta_descripcion meta_descripcion VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE meta_autor meta_autor VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE meta_title meta_title VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE meta_type meta_type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE meta_url meta_url VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE site_name site_name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE base base VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE ministerio CHANGE nombre nombre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE referente referente VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE model_template CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE identifier identifier VARCHAR(150) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_filename image_filename VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE news_site CHANGE id id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE src_site src_site VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE src_codigo src_codigo VARCHAR(510) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE src_type src_type VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE src_parameters src_parameters VARCHAR(510) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE identificador identificador VARCHAR(155) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE page_index CHANGE autor_id autor_id VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE principal CHANGE autor_id autor_id VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE titulo titulo VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE contenido contenido VARCHAR(2550) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link_route link_route VARCHAR(150) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link_posting link_posting VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_filename image_filename VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE css_class css_class VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE reservante CHANGE id id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE celebracion_id celebracion_id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE apellido apellido VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nombre nombre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE telefono telefono VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE documento documento VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE roles CHANGE nombre nombre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE identificador identificador VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE descripcion descripcion VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE section CHANGE autor_id autor_id VARCHAR(40) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE identificador identificador VARCHAR(100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description LONGTEXT DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE template template VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE contenido contenido VARCHAR(5100) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE title title VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE footer footer VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE image_filename image_filename VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link_posting link_posting VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE link_route link_route VARCHAR(150) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE css_class css_class VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE tipo_contacto CHANGE tipo tipo VARCHAR(50) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE referencia referencia VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE icon icon VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE texto_referencia texto_referencia VARCHAR(510) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE type_block CHANGE name name VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE description description VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE identifier identifier VARCHAR(150) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE entity entity VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE type_fixe CHANGE id id CHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:uuid)\', CHANGE description description VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE identificador identificador VARCHAR(150) NOT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE user CHANGE id id VARCHAR(40) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(180) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE roles roles LONGTEXT NOT NULL COLLATE `utf8mb4_unicode_ci` COMMENT \'(DC2Type:json)\', CHANGE primer_nombre primer_nombre VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE password password VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE twitter_username twitter_username VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE avatar_url avatar_url VARCHAR(255) DEFAULT NULL COLLATE `utf8mb4_unicode_ci`');
        $this->addSql('ALTER TABLE waiting_list CHANGE id id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE celebracion_id celebracion_id VARCHAR(36) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE apellido apellido VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE nombre nombre VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE email email VARCHAR(255) NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}