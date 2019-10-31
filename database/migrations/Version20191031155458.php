<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20191031155458 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE kompetensi_program_studi (id BIGSERIAL NOT NULL, program_studi_id BIGINT NOT NULL, kompetensi_id BIGINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_65519DF4369CA843 ON kompetensi_program_studi (program_studi_id)');
        $this->addSql('CREATE INDEX IDX_65519DF46543E6FC ON kompetensi_program_studi (kompetensi_id)');
        $this->addSql('ALTER TABLE kompetensi_program_studi ADD CONSTRAINT FK_65519DF4369CA843 FOREIGN KEY (program_studi_id) REFERENCES program_studi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi_program_studi ADD CONSTRAINT FK_65519DF46543E6FC FOREIGN KEY (kompetensi_id) REFERENCES kompetensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE kompetensi_program_studi');
    }
}
