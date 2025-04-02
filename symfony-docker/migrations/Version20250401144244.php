<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250401144244 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE badge (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE checklist (id SERIAL NOT NULL, user_id_id INT DEFAULT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_5C696D2F9D86650F ON checklist (user_id_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE dance (id SERIAL NOT NULL, name VARCHAR(255) NOT NULL, tact VARCHAR(255) NOT NULL, difficulty INT NOT NULL, default_bpm INT NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE step (id SERIAL NOT NULL, stepsequence_id INT NOT NULL, howquick INT NOT NULL, m1_x DOUBLE PRECISION NOT NULL, m1_y DOUBLE PRECISION NOT NULL, m1_rotate DOUBLE PRECISION NOT NULL, m1_heel BOOLEAN NOT NULL, m1_toe BOOLEAN NOT NULL, m2_x DOUBLE PRECISION NOT NULL, m2_y DOUBLE PRECISION NOT NULL, m2_rotate DOUBLE PRECISION NOT NULL, m2_heel BOOLEAN NOT NULL, m2_toe BOOLEAN NOT NULL, w1_x DOUBLE PRECISION NOT NULL, w1_y DOUBLE PRECISION NOT NULL, w1_rotate DOUBLE PRECISION NOT NULL, w1_heel BOOLEAN NOT NULL, w1_toe BOOLEAN NOT NULL, w2_x DOUBLE PRECISION NOT NULL, w2_y DOUBLE PRECISION NOT NULL, w2_rotate DOUBLE PRECISION NOT NULL, w2_heel BOOLEAN NOT NULL, w2_toe BOOLEAN NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_43B9FE3CF7DBCF97 ON step (stepsequence_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE stepsequence (id SERIAL NOT NULL, badge_id INT DEFAULT NULL, dance_id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_9633B0B9F7A2C2FC ON stepsequence (badge_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_9633B0B965D64EDD ON stepsequence (dance_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE stepsequence_checklist (stepsequence_id INT NOT NULL, checklist_id INT NOT NULL, PRIMARY KEY(stepsequence_id, checklist_id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_AC28BBC4F7DBCF97 ON stepsequence_checklist (stepsequence_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_AC28BBC4B16D08A7 ON stepsequence_checklist (checklist_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE "user" (id SERIAL NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))
        SQL);
        $this->addSql(<<<'SQL'
            CREATE UNIQUE INDEX UNIQ_IDENTIFIER_EMAIL ON "user" (email)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE checklist ADD CONSTRAINT FK_5C696D2F9D86650F FOREIGN KEY (user_id_id) REFERENCES "user" (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE step ADD CONSTRAINT FK_43B9FE3CF7DBCF97 FOREIGN KEY (stepsequence_id) REFERENCES stepsequence (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stepsequence ADD CONSTRAINT FK_9633B0B9F7A2C2FC FOREIGN KEY (badge_id) REFERENCES badge (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stepsequence ADD CONSTRAINT FK_9633B0B965D64EDD FOREIGN KEY (dance_id) REFERENCES dance (id) NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stepsequence_checklist ADD CONSTRAINT FK_AC28BBC4F7DBCF97 FOREIGN KEY (stepsequence_id) REFERENCES stepsequence (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stepsequence_checklist ADD CONSTRAINT FK_AC28BBC4B16D08A7 FOREIGN KEY (checklist_id) REFERENCES checklist (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE checklist DROP CONSTRAINT FK_5C696D2F9D86650F
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE step DROP CONSTRAINT FK_43B9FE3CF7DBCF97
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stepsequence DROP CONSTRAINT FK_9633B0B9F7A2C2FC
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stepsequence DROP CONSTRAINT FK_9633B0B965D64EDD
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stepsequence_checklist DROP CONSTRAINT FK_AC28BBC4F7DBCF97
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE stepsequence_checklist DROP CONSTRAINT FK_AC28BBC4B16D08A7
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE badge
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE checklist
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE dance
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE step
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE stepsequence
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE stepsequence_checklist
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE "user"
        SQL);
    }
}
