<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220514205344 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE api_token (id INT AUTO_INCREMENT NOT NULL, user_id VARCHAR(40) NOT NULL, token VARCHAR(255) NOT NULL, expira_at DATETIME NOT NULL, INDEX IDX_7BA2F5EBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blocs_fixes (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', fixes_type_id CHAR(36) DEFAULT NULL COMMENT \'(DC2Type:uuid)\', index_alameda_id INT DEFAULT NULL, description VARCHAR(255) DEFAULT NULL, css_class VARCHAR(255) DEFAULT NULL, image_filename VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, identificador VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_8E3A5FBAA8255881 (identificador), INDEX IDX_8E3A5FBA7ABE248D (fixes_type_id), INDEX IDX_8E3A5FBAB42271D3 (index_alameda_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blocs_fixes_principal (blocs_fixes_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', principal_id INT NOT NULL, INDEX IDX_9527660B55A72651 (blocs_fixes_id), INDEX IDX_9527660B474870EE (principal_id), PRIMARY KEY(blocs_fixes_id, principal_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE blocs_fixes_section (blocs_fixes_id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', section_id INT NOT NULL, INDEX IDX_60A7E29B55A72651 (blocs_fixes_id), INDEX IDX_60A7E29BD823E37A (section_id), PRIMARY KEY(blocs_fixes_id, section_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE button_link (id INT AUTO_INCREMENT NOT NULL, css_class VARCHAR(255) DEFAULT NULL, link_route VARCHAR(255) NOT NULL, is_link_externo TINYINT(1) DEFAULT NULL, text_button VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE celebracion (id VARCHAR(36) NOT NULL, crea_evento_id VARCHAR(40) NOT NULL, fecha_celebracion_at DATETIME NOT NULL, nombre VARCHAR(255) DEFAULT NULL, capacidad INT NOT NULL, descripcion VARCHAR(255) DEFAULT NULL, is_habilitada TINYINT(1) DEFAULT NULL, image_qr VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, disponible_at DATETIME DEFAULT NULL, disponible_hasta_at DATETIME DEFAULT NULL, INDEX IDX_6F486E00F3B77933 (crea_evento_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE channel_feed (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, autor VARCHAR(255) NOT NULL, owner VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, image VARCHAR(255) DEFAULT NULL, link VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE comentario (id INT AUTO_INCREMENT NOT NULL, autor_id VARCHAR(40) NOT NULL, entrada_id INT DEFAULT NULL, principal_id INT DEFAULT NULL, contenido VARCHAR(255) NOT NULL, is_deleted TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_4B91E70214D45BBE (autor_id), INDEX IDX_4B91E702A688222A (entrada_id), INDEX IDX_4B91E702474870EE (principal_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contacto (id INT AUTO_INCREMENT NOT NULL, tipo_id INT NOT NULL, link_route VARCHAR(255) NOT NULL, texto_mensaje VARCHAR(510) DEFAULT NULL, texto_pagina VARCHAR(510) DEFAULT NULL, nombre VARCHAR(255) NOT NULL, INDEX IDX_2741493CA9276E6C (tipo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE contacto_ministerio (contacto_id INT NOT NULL, ministerio_id INT NOT NULL, INDEX IDX_46893C7C6B505CA9 (contacto_id), INDEX IDX_46893C7CCC377906 (ministerio_id), PRIMARY KEY(contacto_id, ministerio_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE enlace_corto (id INT AUTO_INCREMENT NOT NULL, usuario_id VARCHAR(40) DEFAULT NULL, link_route VARCHAR(150) DEFAULT NULL, url_destino VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_4F8BF9A5AD7F7CA7 (link_route), INDEX IDX_4F8BF9A5DB38439E (usuario_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entrada (id INT AUTO_INCREMENT NOT NULL, autor_id VARCHAR(40) NOT NULL, model_template_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, contenido TEXT DEFAULT NULL, image_filename VARCHAR(255) DEFAULT NULL, publicado_at DATETIME DEFAULT NULL, likes INT NOT NULL, evento_at DATETIME DEFAULT NULL, type_origin VARCHAR(255) DEFAULT NULL, type_carry VARCHAR(255) DEFAULT NULL, orden INT DEFAULT NULL, encabezado TINYINT(1) DEFAULT NULL, destacado TINYINT(1) DEFAULT NULL, is_sin_titulo TINYINT(1) DEFAULT NULL, is_permanente TINYINT(1) DEFAULT NULL, footer VARCHAR(255) DEFAULT NULL, identificador VARCHAR(150) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, disponible_at DATETIME DEFAULT NULL, disponible_hasta_at DATETIME DEFAULT NULL, is_link_externo TINYINT(1) DEFAULT NULL, link_posting VARCHAR(255) DEFAULT NULL, link_route VARCHAR(150) DEFAULT NULL, css_class VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_C949A274A8255881 (identificador), INDEX IDX_C949A27414D45BBE (autor_id), INDEX IDX_C949A2746BD83654 (model_template_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entrada_contacto (entrada_id INT NOT NULL, contacto_id INT NOT NULL, INDEX IDX_ABD201A2A688222A (entrada_id), INDEX IDX_ABD201A26B505CA9 (contacto_id), PRIMARY KEY(entrada_id, contacto_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entrada_button_link (entrada_id INT NOT NULL, button_link_id INT NOT NULL, INDEX IDX_B28A032EA688222A (entrada_id), INDEX IDX_B28A032E7AE75F80 (button_link_id), PRIMARY KEY(entrada_id, button_link_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section_entrada (entrada_id INT NOT NULL, section_id INT NOT NULL, INDEX IDX_1B0E6F7BA688222A (entrada_id), INDEX IDX_1B0E6F7BD823E37A (section_id), PRIMARY KEY(entrada_id, section_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE entrada_reference (id INT AUTO_INCREMENT NOT NULL, entrada_id INT DEFAULT NULL, filename VARCHAR(255) NOT NULL, original_filename VARCHAR(255) NOT NULL, mime_type VARCHAR(255) NOT NULL, posicion INT DEFAULT NULL, INDEX IDX_B9986418A688222A (entrada_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_celebration (id VARCHAR(36) NOT NULL, is_activo TINYINT(1) DEFAULT NULL, base_css VARCHAR(255) DEFAULT NULL, bton_css VARCHAR(255) DEFAULT NULL, image_bg VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, orden INT DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, image_filename VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE group_celebration_celebracion (group_celebration_id VARCHAR(36) NOT NULL, celebracion_id VARCHAR(36) NOT NULL, INDEX IDX_85760659DFCC21E6 (group_celebration_id), INDEX IDX_85760659E5384AD4 (celebracion_id), PRIMARY KEY(group_celebration_id, celebracion_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE index_alameda (id INT AUTO_INCREMENT NOT NULL, template_id INT DEFAULT NULL, lema VARCHAR(255) NOT NULL, lema_principal VARCHAR(255) DEFAULT NULL, lema_sin_espacio VARCHAR(255) NOT NULL, horario1 VARCHAR(5) DEFAULT NULL, horario2 VARCHAR(5) DEFAULT NULL, texto_versiculo VARCHAR(255) DEFAULT NULL, versiculo VARCHAR(255) DEFAULT NULL, meta_descripcion VARCHAR(255) NOT NULL, meta_autor VARCHAR(255) NOT NULL, meta_title VARCHAR(255) NOT NULL, meta_type VARCHAR(255) NOT NULL, meta_url VARCHAR(255) NOT NULL, meta_image VARCHAR(255) NOT NULL, base VARCHAR(255) NOT NULL, INDEX IDX_1D1E8CFE5DA0FB8 (template_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE index_alameda_section (index_alameda_id INT NOT NULL, section_id INT NOT NULL, INDEX IDX_5DC02DB4B42271D3 (index_alameda_id), INDEX IDX_5DC02DB4D823E37A (section_id), PRIMARY KEY(index_alameda_id, section_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE invitado (id VARCHAR(36) NOT NULL, enlace_id VARCHAR(36) NOT NULL, celebracion_id VARCHAR(36) NOT NULL, telefono VARCHAR(255) DEFAULT NULL, dni VARCHAR(255) DEFAULT NULL, nombre VARCHAR(255) DEFAULT NULL, apellido VARCHAR(255) DEFAULT NULL, email VARCHAR(255) DEFAULT NULL, is_enlace TINYINT(1) DEFAULT NULL, is_presente TINYINT(1) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_4982EC17F1488E2C (enlace_id), INDEX IDX_4982EC17E5384AD4 (celebracion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_feed (id INT AUTO_INCREMENT NOT NULL, channel_feed_id INT NOT NULL, title VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, pub_date_at DATETIME NOT NULL, link_url VARCHAR(510) NOT NULL, link_type VARCHAR(255) NOT NULL, link_length VARCHAR(255) NOT NULL, link_longitud INT NOT NULL, duracion TIME NOT NULL, guid VARCHAR(255) NOT NULL, INDEX IDX_EB700050E6E68302 (channel_feed_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_menu (id VARCHAR(36) NOT NULL, parent_id VARCHAR(36) DEFAULT NULL, path_interno_id INT DEFAULT NULL, `label` VARCHAR(255) NOT NULL, badge VARCHAR(255) DEFAULT NULL, icon VARCHAR(255) DEFAULT NULL, is_externo TINYINT(1) DEFAULT NULL, is_activo TINYINT(1) DEFAULT NULL, path_libre VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, css_class VARCHAR(255) DEFAULT NULL, identificador VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_B5357E68A8255881 (identificador), INDEX IDX_B5357E68727ACA70 (parent_id), INDEX IDX_B5357E68AD628527 (path_interno_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_menu_roles (item_menu_id VARCHAR(36) NOT NULL, roles_id INT NOT NULL, INDEX IDX_9A2325AAC78ACF46 (item_menu_id), INDEX IDX_9A2325AA38C751C4 (roles_id), PRIMARY KEY(item_menu_id, roles_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE item_menu_menu (item_menu_id VARCHAR(36) NOT NULL, menu_id VARCHAR(36) NOT NULL, INDEX IDX_B990DC2DC78ACF46 (item_menu_id), INDEX IDX_B990DC2DCCD7E912 (menu_id), PRIMARY KEY(item_menu_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id VARCHAR(36) NOT NULL, nombre VARCHAR(255) NOT NULL, identificador VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, css_class VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meta_base (id INT AUTO_INCREMENT NOT NULL, lema VARCHAR(255) DEFAULT NULL, lema_principal VARCHAR(255) NOT NULL, meta_descripcion VARCHAR(255) NOT NULL, meta_autor VARCHAR(255) DEFAULT NULL, meta_title VARCHAR(255) NOT NULL, meta_type VARCHAR(255) NOT NULL, meta_url VARCHAR(255) NOT NULL, site_name VARCHAR(255) NOT NULL, base VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ministerio (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, referente VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE model_template (id INT AUTO_INCREMENT NOT NULL, block_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, identifier VARCHAR(150) NOT NULL, image_filename VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_5DBA4E60772E836A (identifier), INDEX IDX_5DBA4E60E9ED820C (block_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE news_site (id VARCHAR(36) NOT NULL, src_site VARCHAR(255) NOT NULL, src_codigo VARCHAR(510) NOT NULL, is_enabled TINYINT(1) DEFAULT NULL, src_type VARCHAR(255) NOT NULL, src_parameters VARCHAR(510) DEFAULT NULL, identificador VARCHAR(155) NOT NULL, UNIQUE INDEX UNIQ_BC9EFF6FA8255881 (identificador), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE page_index (id INT AUTO_INCREMENT NOT NULL, autor_id VARCHAR(40) NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_E6F298D714D45BBE (autor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE principal (id INT AUTO_INCREMENT NOT NULL, autor_id VARCHAR(40) NOT NULL, principal_id INT DEFAULT NULL, model_template_id INT DEFAULT NULL, ministerio_id INT DEFAULT NULL, titulo VARCHAR(255) NOT NULL, contenido VARCHAR(2550) NOT NULL, link_route VARCHAR(150) DEFAULT NULL, likes INT DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, is_link_externo TINYINT(1) DEFAULT NULL, link_posting VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, image_filename VARCHAR(255) DEFAULT NULL, css_class VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_20A08C5BAD7F7CA7 (link_route), INDEX IDX_20A08C5B14D45BBE (autor_id), INDEX IDX_20A08C5B474870EE (principal_id), INDEX IDX_20A08C5B6BD83654 (model_template_id), INDEX IDX_20A08C5BCC377906 (ministerio_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE principal_entrada (principal_id INT NOT NULL, entrada_id INT NOT NULL, INDEX IDX_222612F5474870EE (principal_id), INDEX IDX_222612F5A688222A (entrada_id), PRIMARY KEY(principal_id, entrada_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE principal_section (principal_id INT NOT NULL, section_id INT NOT NULL, INDEX IDX_C61CCA6E474870EE (principal_id), INDEX IDX_C61CCA6ED823E37A (section_id), PRIMARY KEY(principal_id, section_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE principal_button_link (principal_id INT NOT NULL, button_link_id INT NOT NULL, INDEX IDX_51A7F27D474870EE (principal_id), INDEX IDX_51A7F27D7AE75F80 (button_link_id), PRIMARY KEY(principal_id, button_link_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE relacion_section_entrada (id INT AUTO_INCREMENT NOT NULL, section_id INT DEFAULT NULL, entrada_id INT DEFAULT NULL, orden INT DEFAULT NULL, INDEX IDX_862276D5D823E37A (section_id), INDEX IDX_862276D5A688222A (entrada_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservante (id VARCHAR(36) NOT NULL, celebracion_id VARCHAR(36) NOT NULL, email VARCHAR(255) NOT NULL, apellido VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, telefono VARCHAR(255) DEFAULT NULL, is_presente TINYINT(1) DEFAULT NULL, documento VARCHAR(255) NOT NULL, INDEX IDX_7BB3EAC5E5384AD4 (celebracion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE roles (id INT AUTO_INCREMENT NOT NULL, nombre VARCHAR(255) NOT NULL, identificador VARCHAR(255) NOT NULL, descripcion VARCHAR(255) NOT NULL, is_activo TINYINT(1) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section (id INT AUTO_INCREMENT NOT NULL, autor_id VARCHAR(40) DEFAULT NULL, principal_id INT DEFAULT NULL, model_template_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, identificador VARCHAR(100) DEFAULT NULL, disponible TINYINT(1) DEFAULT NULL, columns INT DEFAULT NULL, description LONGTEXT DEFAULT NULL, disponible_at DATETIME DEFAULT NULL, template VARCHAR(255) DEFAULT NULL, contenido VARCHAR(5100) DEFAULT NULL, orden INT DEFAULT NULL, title VARCHAR(255) DEFAULT NULL, footer VARCHAR(255) DEFAULT NULL, disponible_hasta_at DATETIME DEFAULT NULL, image_filename VARCHAR(255) DEFAULT NULL, is_link_externo TINYINT(1) DEFAULT NULL, link_posting VARCHAR(255) DEFAULT NULL, link_route VARCHAR(150) DEFAULT NULL, css_class VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, INDEX IDX_2D737AEF14D45BBE (autor_id), INDEX IDX_2D737AEF474870EE (principal_id), INDEX IDX_2D737AEF6BD83654 (model_template_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE section_button_link (section_id INT NOT NULL, button_link_id INT NOT NULL, INDEX IDX_250EED4D823E37A (section_id), INDEX IDX_250EED47AE75F80 (button_link_id), PRIMARY KEY(section_id, button_link_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tipo_contacto (id INT AUTO_INCREMENT NOT NULL, tipo VARCHAR(50) NOT NULL, referencia VARCHAR(255) NOT NULL, icon VARCHAR(255) NOT NULL, texto_referencia VARCHAR(510) DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_block (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) DEFAULT NULL, identifier VARCHAR(150) NOT NULL, is_active TINYINT(1) DEFAULT NULL, entity VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D1710D5772E836A (identifier), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_fixe (id CHAR(36) NOT NULL COMMENT \'(DC2Type:uuid)\', description VARCHAR(255) DEFAULT NULL, created_at DATETIME NOT NULL, updated_at DATETIME NOT NULL, identificador VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_753E244DA8255881 (identificador), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id VARCHAR(40) NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', primer_nombre VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, twitter_username VARCHAR(255) DEFAULT NULL, avatar_url VARCHAR(255) DEFAULT NULL, acepta_terminos_at DATETIME NOT NULL, is_deleted TINYINT(1) DEFAULT NULL, is_active TINYINT(1) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE waiting_list (id VARCHAR(36) NOT NULL, celebracion_id VARCHAR(36) NOT NULL, apellido VARCHAR(255) NOT NULL, nombre VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, INDEX IDX_E4F3965BE5384AD4 (celebracion_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE api_token ADD CONSTRAINT FK_7BA2F5EBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE blocs_fixes ADD CONSTRAINT FK_8E3A5FBA7ABE248D FOREIGN KEY (fixes_type_id) REFERENCES type_fixe (id)');
        $this->addSql('ALTER TABLE blocs_fixes ADD CONSTRAINT FK_8E3A5FBAB42271D3 FOREIGN KEY (index_alameda_id) REFERENCES index_alameda (id)');
        $this->addSql('ALTER TABLE blocs_fixes_principal ADD CONSTRAINT FK_9527660B55A72651 FOREIGN KEY (blocs_fixes_id) REFERENCES blocs_fixes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blocs_fixes_principal ADD CONSTRAINT FK_9527660B474870EE FOREIGN KEY (principal_id) REFERENCES principal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blocs_fixes_section ADD CONSTRAINT FK_60A7E29B55A72651 FOREIGN KEY (blocs_fixes_id) REFERENCES blocs_fixes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE blocs_fixes_section ADD CONSTRAINT FK_60A7E29BD823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE celebracion ADD CONSTRAINT FK_6F486E00F3B77933 FOREIGN KEY (crea_evento_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E70214D45BBE FOREIGN KEY (autor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E702A688222A FOREIGN KEY (entrada_id) REFERENCES entrada (id)');
        $this->addSql('ALTER TABLE comentario ADD CONSTRAINT FK_4B91E702474870EE FOREIGN KEY (principal_id) REFERENCES principal (id)');
        $this->addSql('ALTER TABLE contacto ADD CONSTRAINT FK_2741493CA9276E6C FOREIGN KEY (tipo_id) REFERENCES tipo_contacto (id)');
        $this->addSql('ALTER TABLE contacto_ministerio ADD CONSTRAINT FK_46893C7C6B505CA9 FOREIGN KEY (contacto_id) REFERENCES contacto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE contacto_ministerio ADD CONSTRAINT FK_46893C7CCC377906 FOREIGN KEY (ministerio_id) REFERENCES ministerio (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE enlace_corto ADD CONSTRAINT FK_4F8BF9A5DB38439E FOREIGN KEY (usuario_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE entrada ADD CONSTRAINT FK_C949A27414D45BBE FOREIGN KEY (autor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE entrada ADD CONSTRAINT FK_C949A2746BD83654 FOREIGN KEY (model_template_id) REFERENCES model_template (id)');
        $this->addSql('ALTER TABLE entrada_contacto ADD CONSTRAINT FK_ABD201A2A688222A FOREIGN KEY (entrada_id) REFERENCES entrada (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entrada_contacto ADD CONSTRAINT FK_ABD201A26B505CA9 FOREIGN KEY (contacto_id) REFERENCES contacto (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entrada_button_link ADD CONSTRAINT FK_B28A032EA688222A FOREIGN KEY (entrada_id) REFERENCES entrada (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE entrada_button_link ADD CONSTRAINT FK_B28A032E7AE75F80 FOREIGN KEY (button_link_id) REFERENCES button_link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE section_entrada ADD CONSTRAINT FK_1B0E6F7BA688222A FOREIGN KEY (entrada_id) REFERENCES entrada (id)');
        $this->addSql('ALTER TABLE section_entrada ADD CONSTRAINT FK_1B0E6F7BD823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE entrada_reference ADD CONSTRAINT FK_B9986418A688222A FOREIGN KEY (entrada_id) REFERENCES entrada (id)');
        $this->addSql('ALTER TABLE group_celebration_celebracion ADD CONSTRAINT FK_85760659DFCC21E6 FOREIGN KEY (group_celebration_id) REFERENCES group_celebration (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE group_celebration_celebracion ADD CONSTRAINT FK_85760659E5384AD4 FOREIGN KEY (celebracion_id) REFERENCES celebracion (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE index_alameda ADD CONSTRAINT FK_1D1E8CFE5DA0FB8 FOREIGN KEY (template_id) REFERENCES model_template (id)');
        $this->addSql('ALTER TABLE index_alameda_section ADD CONSTRAINT FK_5DC02DB4B42271D3 FOREIGN KEY (index_alameda_id) REFERENCES index_alameda (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE index_alameda_section ADD CONSTRAINT FK_5DC02DB4D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE invitado ADD CONSTRAINT FK_4982EC17F1488E2C FOREIGN KEY (enlace_id) REFERENCES reservante (id)');
        $this->addSql('ALTER TABLE invitado ADD CONSTRAINT FK_4982EC17E5384AD4 FOREIGN KEY (celebracion_id) REFERENCES celebracion (id)');
        $this->addSql('ALTER TABLE item_feed ADD CONSTRAINT FK_EB700050E6E68302 FOREIGN KEY (channel_feed_id) REFERENCES channel_feed (id)');
        $this->addSql('ALTER TABLE item_menu ADD CONSTRAINT FK_B5357E68727ACA70 FOREIGN KEY (parent_id) REFERENCES item_menu (id)');
        $this->addSql('ALTER TABLE item_menu ADD CONSTRAINT FK_B5357E68AD628527 FOREIGN KEY (path_interno_id) REFERENCES principal (id)');
        $this->addSql('ALTER TABLE item_menu_roles ADD CONSTRAINT FK_9A2325AAC78ACF46 FOREIGN KEY (item_menu_id) REFERENCES item_menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_menu_roles ADD CONSTRAINT FK_9A2325AA38C751C4 FOREIGN KEY (roles_id) REFERENCES roles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_menu_menu ADD CONSTRAINT FK_B990DC2DC78ACF46 FOREIGN KEY (item_menu_id) REFERENCES item_menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE item_menu_menu ADD CONSTRAINT FK_B990DC2DCCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE model_template ADD CONSTRAINT FK_5DBA4E60E9ED820C FOREIGN KEY (block_id) REFERENCES type_block (id)');
        $this->addSql('ALTER TABLE page_index ADD CONSTRAINT FK_E6F298D714D45BBE FOREIGN KEY (autor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE principal ADD CONSTRAINT FK_20A08C5B14D45BBE FOREIGN KEY (autor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE principal ADD CONSTRAINT FK_20A08C5B474870EE FOREIGN KEY (principal_id) REFERENCES principal (id)');
        $this->addSql('ALTER TABLE principal ADD CONSTRAINT FK_20A08C5B6BD83654 FOREIGN KEY (model_template_id) REFERENCES model_template (id)');
        $this->addSql('ALTER TABLE principal ADD CONSTRAINT FK_20A08C5BCC377906 FOREIGN KEY (ministerio_id) REFERENCES ministerio (id)');
        $this->addSql('ALTER TABLE principal_entrada ADD CONSTRAINT FK_222612F5474870EE FOREIGN KEY (principal_id) REFERENCES principal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE principal_entrada ADD CONSTRAINT FK_222612F5A688222A FOREIGN KEY (entrada_id) REFERENCES entrada (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE principal_section ADD CONSTRAINT FK_C61CCA6E474870EE FOREIGN KEY (principal_id) REFERENCES principal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE principal_section ADD CONSTRAINT FK_C61CCA6ED823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE principal_button_link ADD CONSTRAINT FK_51A7F27D474870EE FOREIGN KEY (principal_id) REFERENCES principal (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE principal_button_link ADD CONSTRAINT FK_51A7F27D7AE75F80 FOREIGN KEY (button_link_id) REFERENCES button_link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE relacion_section_entrada ADD CONSTRAINT FK_862276D5D823E37A FOREIGN KEY (section_id) REFERENCES section (id)');
        $this->addSql('ALTER TABLE relacion_section_entrada ADD CONSTRAINT FK_862276D5A688222A FOREIGN KEY (entrada_id) REFERENCES entrada (id)');
        $this->addSql('ALTER TABLE reservante ADD CONSTRAINT FK_7BB3EAC5E5384AD4 FOREIGN KEY (celebracion_id) REFERENCES celebracion (id)');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF14D45BBE FOREIGN KEY (autor_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF474870EE FOREIGN KEY (principal_id) REFERENCES principal (id)');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT FK_2D737AEF6BD83654 FOREIGN KEY (model_template_id) REFERENCES model_template (id)');
        $this->addSql('ALTER TABLE section_button_link ADD CONSTRAINT FK_250EED4D823E37A FOREIGN KEY (section_id) REFERENCES section (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE section_button_link ADD CONSTRAINT FK_250EED47AE75F80 FOREIGN KEY (button_link_id) REFERENCES button_link (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE waiting_list ADD CONSTRAINT FK_E4F3965BE5384AD4 FOREIGN KEY (celebracion_id) REFERENCES celebracion (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE blocs_fixes_principal DROP FOREIGN KEY FK_9527660B55A72651');
        $this->addSql('ALTER TABLE blocs_fixes_section DROP FOREIGN KEY FK_60A7E29B55A72651');
        $this->addSql('ALTER TABLE entrada_button_link DROP FOREIGN KEY FK_B28A032E7AE75F80');
        $this->addSql('ALTER TABLE principal_button_link DROP FOREIGN KEY FK_51A7F27D7AE75F80');
        $this->addSql('ALTER TABLE section_button_link DROP FOREIGN KEY FK_250EED47AE75F80');
        $this->addSql('ALTER TABLE group_celebration_celebracion DROP FOREIGN KEY FK_85760659E5384AD4');
        $this->addSql('ALTER TABLE invitado DROP FOREIGN KEY FK_4982EC17E5384AD4');
        $this->addSql('ALTER TABLE reservante DROP FOREIGN KEY FK_7BB3EAC5E5384AD4');
        $this->addSql('ALTER TABLE waiting_list DROP FOREIGN KEY FK_E4F3965BE5384AD4');
        $this->addSql('ALTER TABLE item_feed DROP FOREIGN KEY FK_EB700050E6E68302');
        $this->addSql('ALTER TABLE contacto_ministerio DROP FOREIGN KEY FK_46893C7C6B505CA9');
        $this->addSql('ALTER TABLE entrada_contacto DROP FOREIGN KEY FK_ABD201A26B505CA9');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E702A688222A');
        $this->addSql('ALTER TABLE entrada_contacto DROP FOREIGN KEY FK_ABD201A2A688222A');
        $this->addSql('ALTER TABLE entrada_button_link DROP FOREIGN KEY FK_B28A032EA688222A');
        $this->addSql('ALTER TABLE section_entrada DROP FOREIGN KEY FK_1B0E6F7BA688222A');
        $this->addSql('ALTER TABLE entrada_reference DROP FOREIGN KEY FK_B9986418A688222A');
        $this->addSql('ALTER TABLE principal_entrada DROP FOREIGN KEY FK_222612F5A688222A');
        $this->addSql('ALTER TABLE relacion_section_entrada DROP FOREIGN KEY FK_862276D5A688222A');
        $this->addSql('ALTER TABLE group_celebration_celebracion DROP FOREIGN KEY FK_85760659DFCC21E6');
        $this->addSql('ALTER TABLE blocs_fixes DROP FOREIGN KEY FK_8E3A5FBAB42271D3');
        $this->addSql('ALTER TABLE index_alameda_section DROP FOREIGN KEY FK_5DC02DB4B42271D3');
        $this->addSql('ALTER TABLE item_menu DROP FOREIGN KEY FK_B5357E68727ACA70');
        $this->addSql('ALTER TABLE item_menu_roles DROP FOREIGN KEY FK_9A2325AAC78ACF46');
        $this->addSql('ALTER TABLE item_menu_menu DROP FOREIGN KEY FK_B990DC2DC78ACF46');
        $this->addSql('ALTER TABLE item_menu_menu DROP FOREIGN KEY FK_B990DC2DCCD7E912');
        $this->addSql('ALTER TABLE contacto_ministerio DROP FOREIGN KEY FK_46893C7CCC377906');
        $this->addSql('ALTER TABLE principal DROP FOREIGN KEY FK_20A08C5BCC377906');
        $this->addSql('ALTER TABLE entrada DROP FOREIGN KEY FK_C949A2746BD83654');
        $this->addSql('ALTER TABLE index_alameda DROP FOREIGN KEY FK_1D1E8CFE5DA0FB8');
        $this->addSql('ALTER TABLE principal DROP FOREIGN KEY FK_20A08C5B6BD83654');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEF6BD83654');
        $this->addSql('ALTER TABLE blocs_fixes_principal DROP FOREIGN KEY FK_9527660B474870EE');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E702474870EE');
        $this->addSql('ALTER TABLE item_menu DROP FOREIGN KEY FK_B5357E68AD628527');
        $this->addSql('ALTER TABLE principal DROP FOREIGN KEY FK_20A08C5B474870EE');
        $this->addSql('ALTER TABLE principal_entrada DROP FOREIGN KEY FK_222612F5474870EE');
        $this->addSql('ALTER TABLE principal_section DROP FOREIGN KEY FK_C61CCA6E474870EE');
        $this->addSql('ALTER TABLE principal_button_link DROP FOREIGN KEY FK_51A7F27D474870EE');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEF474870EE');
        $this->addSql('ALTER TABLE invitado DROP FOREIGN KEY FK_4982EC17F1488E2C');
        $this->addSql('ALTER TABLE item_menu_roles DROP FOREIGN KEY FK_9A2325AA38C751C4');
        $this->addSql('ALTER TABLE blocs_fixes_section DROP FOREIGN KEY FK_60A7E29BD823E37A');
        $this->addSql('ALTER TABLE section_entrada DROP FOREIGN KEY FK_1B0E6F7BD823E37A');
        $this->addSql('ALTER TABLE index_alameda_section DROP FOREIGN KEY FK_5DC02DB4D823E37A');
        $this->addSql('ALTER TABLE principal_section DROP FOREIGN KEY FK_C61CCA6ED823E37A');
        $this->addSql('ALTER TABLE relacion_section_entrada DROP FOREIGN KEY FK_862276D5D823E37A');
        $this->addSql('ALTER TABLE section_button_link DROP FOREIGN KEY FK_250EED4D823E37A');
        $this->addSql('ALTER TABLE contacto DROP FOREIGN KEY FK_2741493CA9276E6C');
        $this->addSql('ALTER TABLE model_template DROP FOREIGN KEY FK_5DBA4E60E9ED820C');
        $this->addSql('ALTER TABLE blocs_fixes DROP FOREIGN KEY FK_8E3A5FBA7ABE248D');
        $this->addSql('ALTER TABLE api_token DROP FOREIGN KEY FK_7BA2F5EBA76ED395');
        $this->addSql('ALTER TABLE celebracion DROP FOREIGN KEY FK_6F486E00F3B77933');
        $this->addSql('ALTER TABLE comentario DROP FOREIGN KEY FK_4B91E70214D45BBE');
        $this->addSql('ALTER TABLE enlace_corto DROP FOREIGN KEY FK_4F8BF9A5DB38439E');
        $this->addSql('ALTER TABLE entrada DROP FOREIGN KEY FK_C949A27414D45BBE');
        $this->addSql('ALTER TABLE page_index DROP FOREIGN KEY FK_E6F298D714D45BBE');
        $this->addSql('ALTER TABLE principal DROP FOREIGN KEY FK_20A08C5B14D45BBE');
        $this->addSql('ALTER TABLE section DROP FOREIGN KEY FK_2D737AEF14D45BBE');
        $this->addSql('DROP TABLE api_token');
        $this->addSql('DROP TABLE blocs_fixes');
        $this->addSql('DROP TABLE blocs_fixes_principal');
        $this->addSql('DROP TABLE blocs_fixes_section');
        $this->addSql('DROP TABLE button_link');
        $this->addSql('DROP TABLE celebracion');
        $this->addSql('DROP TABLE channel_feed');
        $this->addSql('DROP TABLE comentario');
        $this->addSql('DROP TABLE contacto');
        $this->addSql('DROP TABLE contacto_ministerio');
        $this->addSql('DROP TABLE enlace_corto');
        $this->addSql('DROP TABLE entrada');
        $this->addSql('DROP TABLE entrada_contacto');
        $this->addSql('DROP TABLE entrada_button_link');
        $this->addSql('DROP TABLE section_entrada');
        $this->addSql('DROP TABLE entrada_reference');
        $this->addSql('DROP TABLE group_celebration');
        $this->addSql('DROP TABLE group_celebration_celebracion');
        $this->addSql('DROP TABLE index_alameda');
        $this->addSql('DROP TABLE index_alameda_section');
        $this->addSql('DROP TABLE invitado');
        $this->addSql('DROP TABLE item_feed');
        $this->addSql('DROP TABLE item_menu');
        $this->addSql('DROP TABLE item_menu_roles');
        $this->addSql('DROP TABLE item_menu_menu');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE meta_base');
        $this->addSql('DROP TABLE ministerio');
        $this->addSql('DROP TABLE model_template');
        $this->addSql('DROP TABLE news_site');
        $this->addSql('DROP TABLE page_index');
        $this->addSql('DROP TABLE principal');
        $this->addSql('DROP TABLE principal_entrada');
        $this->addSql('DROP TABLE principal_section');
        $this->addSql('DROP TABLE principal_button_link');
        $this->addSql('DROP TABLE relacion_section_entrada');
        $this->addSql('DROP TABLE reservante');
        $this->addSql('DROP TABLE roles');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE section_button_link');
        $this->addSql('DROP TABLE tipo_contacto');
        $this->addSql('DROP TABLE type_block');
        $this->addSql('DROP TABLE type_fixe');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE waiting_list');
    }
}
