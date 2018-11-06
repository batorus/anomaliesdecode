<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181106181117 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE ar_controles (id INT AUTO_INCREMENT NOT NULL, controle VARCHAR(255) NOT NULL COLLATE utf8_general_ci, echantillon VARCHAR(255) NOT NULL COLLATE utf8_general_ci, periodetravaux VARCHAR(255) NOT NULL COLLATE utf8_general_ci, enabled INT NOT NULL, UNIQUE INDEX UNIQ_71707E3CE39396E (controle), UNIQUE INDEX UNIQ_71707E3C2C649BE7 (echantillon), UNIQUE INDEX UNIQ_71707E3C83C01976 (periodetravaux), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE controles_typecontroles (controles_id INT NOT NULL, typecontrole_id INT NOT NULL, INDEX IDX_2F3C8091D8B132DE (controles_id), INDEX IDX_2F3C8091BC100FB (typecontrole_id), PRIMARY KEY(controles_id, typecontrole_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE controles_typesocietes (controles_id INT NOT NULL, typesociete_id INT NOT NULL, INDEX IDX_FC683A00D8B132DE (controles_id), INDEX IDX_FC683A005AD950E (typesociete_id), PRIMARY KEY(controles_id, typesociete_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE controles_typetaches (controles_id INT NOT NULL, typetaches_id INT NOT NULL, INDEX IDX_516BCAE3D8B132DE (controles_id), INDEX IDX_516BCAE35B9974EC (typetaches_id), PRIMARY KEY(controles_id, typetaches_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ar_documents (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, extension VARCHAR(255) NOT NULL, enabled INT NOT NULL, INDEX IDX_62CAB6D9A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE risklevel (id INT AUTO_INCREMENT NOT NULL, risklevel VARCHAR(255) NOT NULL COLLATE utf8_general_ci, enabled INT NOT NULL, UNIQUE INDEX UNIQ_14834A4C14834A4C (risklevel), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ar_typecontrole (id INT AUTO_INCREMENT NOT NULL, typecontrole VARCHAR(255) NOT NULL COLLATE utf8_general_ci, enabled INT NOT NULL, UNIQUE INDEX UNIQ_206879C95250B7E6 (typecontrole), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ar_typesociete (id INT AUTO_INCREMENT NOT NULL, typesociete VARCHAR(100) NOT NULL COLLATE utf8_general_ci, enabled INT NOT NULL, UNIQUE INDEX UNIQ_FC281BC0C381B106 (typesociete), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ar_typetaches (id INT AUTO_INCREMENT NOT NULL, typetache VARCHAR(100) NOT NULL COLLATE utf8_general_ci, enabled INT NOT NULL, UNIQUE INDEX UNIQ_A36ABD5519AD9566 (typetache), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ar_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(180) NOT NULL, username_canonical VARCHAR(180) NOT NULL, email VARCHAR(180) NOT NULL, email_canonical VARCHAR(180) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) DEFAULT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, confirmation_token VARCHAR(180) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', matricule VARCHAR(6) DEFAULT NULL COLLATE utf8_general_ci, photo VARCHAR(255) DEFAULT NULL COLLATE utf8_general_ci, UNIQUE INDEX UNIQ_E0D365AAC05FB297 (confirmation_token), UNIQUE INDEX UNIQ_8D93D64992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_8D93D649A0D96FBF (email_canonical), UNIQUE INDEX UNIQ_username (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE controles_typecontroles ADD CONSTRAINT FK_2F3C8091D8B132DE FOREIGN KEY (controles_id) REFERENCES ar_controles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controles_typecontroles ADD CONSTRAINT FK_2F3C8091BC100FB FOREIGN KEY (typecontrole_id) REFERENCES ar_typecontrole (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controles_typesocietes ADD CONSTRAINT FK_FC683A00D8B132DE FOREIGN KEY (controles_id) REFERENCES ar_controles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controles_typesocietes ADD CONSTRAINT FK_FC683A005AD950E FOREIGN KEY (typesociete_id) REFERENCES ar_typesociete (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controles_typetaches ADD CONSTRAINT FK_516BCAE3D8B132DE FOREIGN KEY (controles_id) REFERENCES ar_controles (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE controles_typetaches ADD CONSTRAINT FK_516BCAE35B9974EC FOREIGN KEY (typetaches_id) REFERENCES ar_typetaches (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE ar_documents ADD CONSTRAINT FK_62CAB6D9A76ED395 FOREIGN KEY (user_id) REFERENCES ar_user (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE controles_typecontroles DROP FOREIGN KEY FK_2F3C8091D8B132DE');
        $this->addSql('ALTER TABLE controles_typesocietes DROP FOREIGN KEY FK_FC683A00D8B132DE');
        $this->addSql('ALTER TABLE controles_typetaches DROP FOREIGN KEY FK_516BCAE3D8B132DE');
        $this->addSql('ALTER TABLE controles_typecontroles DROP FOREIGN KEY FK_2F3C8091BC100FB');
        $this->addSql('ALTER TABLE controles_typesocietes DROP FOREIGN KEY FK_FC683A005AD950E');
        $this->addSql('ALTER TABLE controles_typetaches DROP FOREIGN KEY FK_516BCAE35B9974EC');
        $this->addSql('ALTER TABLE ar_documents DROP FOREIGN KEY FK_62CAB6D9A76ED395');
        $this->addSql('DROP TABLE ar_controles');
        $this->addSql('DROP TABLE controles_typecontroles');
        $this->addSql('DROP TABLE controles_typesocietes');
        $this->addSql('DROP TABLE controles_typetaches');
        $this->addSql('DROP TABLE ar_documents');
        $this->addSql('DROP TABLE risklevel');
        $this->addSql('DROP TABLE ar_typecontrole');
        $this->addSql('DROP TABLE ar_typesociete');
        $this->addSql('DROP TABLE ar_typetaches');
        $this->addSql('DROP TABLE ar_user');
    }
}
