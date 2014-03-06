<?php

namespace Claroline\CoreBundle\Migrations\ibm_db2;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2013/10/20 08:07:28
 */
class Version20131020200726 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE claro_workspace_favourite (
                id INTEGER GENERATED BY DEFAULT AS IDENTITY NOT NULL, 
                workspace_id INTEGER NOT NULL, 
                user_id INTEGER NOT NULL, 
                PRIMARY KEY(id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_711A30B82D40A1F ON claro_workspace_favourite (workspace_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_711A30BA76ED395 ON claro_workspace_favourite (user_id)
        ");
        $this->addSql("
            CREATE UNIQUE INDEX workspace_favourite_unique_combination ON claro_workspace_favourite (workspace_id, user_id)
        ");
        $this->addSql("
            ALTER TABLE claro_workspace_favourite 
            ADD CONSTRAINT FK_711A30B82D40A1F FOREIGN KEY (workspace_id) 
            REFERENCES claro_workspace (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_workspace_favourite 
            ADD CONSTRAINT FK_711A30BA76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE claro_badge_rule 
            ADD COLUMN \"result\" VARCHAR(255) DEFAULT NULL 
            ADD COLUMN resultComparison SMALLINT DEFAULT NULL
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            DROP TABLE claro_workspace_favourite
        ");
        $this->addSql("
            ALTER TABLE claro_badge_rule 
            DROP COLUMN \"result\" 
            DROP COLUMN resultComparison
        ");
    }
}