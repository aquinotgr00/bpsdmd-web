<?php

namespace Database\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema as Schema;

class Version20191031151753 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE TABLE kompetensi_diklat (id BIGSERIAL NOT NULL, diklat_id BIGINT NOT NULL, kompetensi_id BIGINT NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_647D29EA7AADDBC ON kompetensi_diklat (diklat_id)');
        $this->addSql('CREATE INDEX IDX_647D29EA6543E6FC ON kompetensi_diklat (kompetensi_id)');
        $this->addSql('ALTER TABLE kompetensi_diklat ADD CONSTRAINT FK_647D29EA7AADDBC FOREIGN KEY (diklat_id) REFERENCES diklat (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE kompetensi_diklat ADD CONSTRAINT FK_647D29EA6543E6FC FOREIGN KEY (kompetensi_id) REFERENCES kompetensi (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP TABLE kompetensi_diklat');
    }
}
