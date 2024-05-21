<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20240520162542 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SEQUENCE entry_point_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE joined_table_parent_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE entry_point (id INT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE joined_child1 (id INT NOT NULL, custom_class_two_field VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE joined_child2 (id INT NOT NULL, custom_class_one_field VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE joined_table_parent (id INT NOT NULL, entry_point_id INT NOT NULL, name VARCHAR(255) NOT NULL, class_type VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_40E361DAE6F2EEA ON joined_table_parent (entry_point_id)');
        $this->addSql('ALTER TABLE joined_child1 ADD CONSTRAINT FK_62EF0325BF396750 FOREIGN KEY (id) REFERENCES joined_table_parent (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE joined_child2 ADD CONSTRAINT FK_FBE6529FBF396750 FOREIGN KEY (id) REFERENCES joined_table_parent (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE joined_table_parent ADD CONSTRAINT FK_40E361DAE6F2EEA FOREIGN KEY (entry_point_id) REFERENCES entry_point (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE entry_point_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE joined_table_parent_id_seq CASCADE');
        $this->addSql('ALTER TABLE joined_child1 DROP CONSTRAINT FK_62EF0325BF396750');
        $this->addSql('ALTER TABLE joined_child2 DROP CONSTRAINT FK_FBE6529FBF396750');
        $this->addSql('ALTER TABLE joined_table_parent DROP CONSTRAINT FK_40E361DAE6F2EEA');
        $this->addSql('DROP TABLE entry_point');
        $this->addSql('DROP TABLE joined_child1');
        $this->addSql('DROP TABLE joined_child2');
        $this->addSql('DROP TABLE joined_table_parent');
    }
}
