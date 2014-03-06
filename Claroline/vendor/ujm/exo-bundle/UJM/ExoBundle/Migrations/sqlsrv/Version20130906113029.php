<?php

namespace UJM\ExoBundle\Migrations\sqlsrv;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated migration based on mapping information: modify it with caution
 *
 * Generation date: 2013/09/06 11:30:31
 */
class Version20130906113029 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql("
            CREATE TABLE ujm_exercise_question (
                exercise_id INT NOT NULL, 
                question_id INT NOT NULL, 
                ordre INT NOT NULL, 
                PRIMARY KEY (exercise_id, question_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_DB79F240E934951A ON ujm_exercise_question (exercise_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_DB79F2401E27F6BF ON ujm_exercise_question (question_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_link_hint_paper (
                hint_id INT NOT NULL, 
                paper_id INT NOT NULL, 
                [view] BIT NOT NULL, 
                PRIMARY KEY (hint_id, paper_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_B76F00F9519161AB ON ujm_link_hint_paper (hint_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_B76F00F9E6758861 ON ujm_link_hint_paper (paper_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_choice (
                id INT IDENTITY NOT NULL, 
                interaction_qcm_id INT, 
                label VARCHAR(MAX) NOT NULL, 
                ordre INT NOT NULL, 
                weight DOUBLE PRECISION, 
                feedback VARCHAR(MAX), 
                right_response BIT, 
                position_force BIT, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_D4BDFA959DBF539 ON ujm_choice (interaction_qcm_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_subscription (
                id INT IDENTITY NOT NULL, 
                user_id INT, 
                exercise_id INT, 
                creator BIT NOT NULL, 
                admin BIT NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_A17BA225A76ED395 ON ujm_subscription (user_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_A17BA225E934951A ON ujm_subscription (exercise_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_planning (
                id INT IDENTITY NOT NULL, 
                group_id INT, 
                start_time DATETIME2(6) NOT NULL, 
                end_time DATETIME2(6) NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_4D0E9FCFFE54D947 ON ujm_planning (group_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_category (
                id INT IDENTITY NOT NULL, 
                user_id INT, 
                value NVARCHAR(255) NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_9FDB39F8A76ED395 ON ujm_category (user_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_type_qcm (
                id INT IDENTITY NOT NULL, 
                value NVARCHAR(255) NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE TABLE ujm_hole (
                id INT IDENTITY NOT NULL, 
                interaction_hole_id INT, 
                size INT NOT NULL, 
                score DOUBLE PRECISION NOT NULL, 
                position INT NOT NULL, 
                orthography BIT NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_E9F4F52575EBD64D ON ujm_hole (interaction_hole_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_document (
                id INT IDENTITY NOT NULL, 
                user_id INT, 
                label NVARCHAR(255) NOT NULL, 
                url NVARCHAR(255) NOT NULL, 
                type NVARCHAR(255) NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_41FEAA4FA76ED395 ON ujm_document (user_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_interaction_hole (
                id INT IDENTITY NOT NULL, 
                interaction_id INT, 
                html VARCHAR(MAX) NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_7343FAC1886DEE8F ON ujm_interaction_hole (interaction_id) 
            WHERE interaction_id IS NOT NULL
        ");
        $this->addSql("
            CREATE TABLE ujm_interaction_open (
                id INT IDENTITY NOT NULL, 
                interaction_id INT, 
                typeopenquestion_id INT, 
                orthography_correct BIT NOT NULL, 
                scoreMaxLongResp DOUBLE PRECISION, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_BFFE44F4886DEE8F ON ujm_interaction_open (interaction_id) 
            WHERE interaction_id IS NOT NULL
        ");
        $this->addSql("
            CREATE INDEX IDX_BFFE44F46AFD3CF ON ujm_interaction_open (typeopenquestion_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_word_response (
                id INT IDENTITY NOT NULL, 
                interaction_open_id INT, 
                hole_id INT, 
                response NVARCHAR(255) NOT NULL, 
                score DOUBLE PRECISION NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_4E1930C598DDBDFD ON ujm_word_response (interaction_open_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_4E1930C515ADE12C ON ujm_word_response (hole_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_response (
                id INT IDENTITY NOT NULL, 
                paper_id INT, 
                interaction_id INT, 
                ip NVARCHAR(255) NOT NULL, 
                mark DOUBLE PRECISION NOT NULL, 
                nb_tries INT NOT NULL, 
                response VARCHAR(MAX), 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_A7EC2BC2E6758861 ON ujm_response (paper_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_A7EC2BC2886DEE8F ON ujm_response (interaction_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_unit (
                id INT IDENTITY NOT NULL, 
                value NVARCHAR(255) NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE TABLE ujm_group (
                id INT IDENTITY NOT NULL, 
                name NVARCHAR(255) NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE TABLE ujm_exercise (
                id INT IDENTITY NOT NULL, 
                title NVARCHAR(255) NOT NULL, 
                description VARCHAR(MAX), 
                shuffle BIT, 
                nb_question INT NOT NULL, 
                date_create DATETIME2(6) NOT NULL, 
                duration INT NOT NULL, 
                nb_question_page INT NOT NULL, 
                doprint BIT, 
                max_attempts INT NOT NULL, 
                correction_mode NVARCHAR(255) NOT NULL, 
                date_correction DATETIME2(6), 
                mark_mode NVARCHAR(255) NOT NULL, 
                start_date DATETIME2(6) NOT NULL, 
                use_date_end BIT, 
                end_date DATETIME2(6), 
                disp_button_interrupt BIT, 
                lock_attempt BIT, 
                resourceNode_id INT, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_374DF525B87FAB32 ON ujm_exercise (resourceNode_id) 
            WHERE resourceNode_id IS NOT NULL
        ");
        $this->addSql("
            CREATE TABLE ujm_exercise_group (
                exercise_id INT NOT NULL, 
                group_id INT NOT NULL, 
                PRIMARY KEY (exercise_id, group_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_78179004E934951A ON ujm_exercise_group (exercise_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_78179004FE54D947 ON ujm_exercise_group (group_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_lock_attempt (
                id INT IDENTITY NOT NULL, 
                paper_id INT, 
                key_lock NVARCHAR(255) NOT NULL, 
                date DATE NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_7A7CDF96E6758861 ON ujm_lock_attempt (paper_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_interaction_graphic (
                id INT IDENTITY NOT NULL, 
                interaction_id INT, 
                document_id INT, 
                width INT NOT NULL, 
                height INT NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_9EBD442F886DEE8F ON ujm_interaction_graphic (interaction_id) 
            WHERE interaction_id IS NOT NULL
        ");
        $this->addSql("
            CREATE INDEX IDX_9EBD442FC33F7837 ON ujm_interaction_graphic (document_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_coords (
                id INT IDENTITY NOT NULL, 
                interaction_graphic_id INT, 
                value NVARCHAR(255) NOT NULL, 
                shape NVARCHAR(255) NOT NULL, 
                color NVARCHAR(255) NOT NULL, 
                score_coords DOUBLE PRECISION NOT NULL, 
                size DOUBLE PRECISION NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_CD7B49827876D500 ON ujm_coords (interaction_graphic_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_interaction_qcm (
                id INT IDENTITY NOT NULL, 
                interaction_id INT, 
                type_qcm_id INT, 
                shuffle BIT, 
                score_right_response DOUBLE PRECISION, 
                score_false_response DOUBLE PRECISION, 
                weight_response BIT, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE UNIQUE INDEX UNIQ_58C3D5A1886DEE8F ON ujm_interaction_qcm (interaction_id) 
            WHERE interaction_id IS NOT NULL
        ");
        $this->addSql("
            CREATE INDEX IDX_58C3D5A1DCB52A9E ON ujm_interaction_qcm (type_qcm_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_question (
                id INT IDENTITY NOT NULL, 
                expertise_id INT, 
                user_id INT, 
                category_id INT, 
                title NVARCHAR(255) NOT NULL, 
                description VARCHAR(MAX), 
                date_create DATETIME2(6) NOT NULL, 
                date_modify DATETIME2(6), 
                locked BIT, 
                model BIT, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_2F6069779D5B92F9 ON ujm_question (expertise_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_2F606977A76ED395 ON ujm_question (user_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_2F60697712469DE2 ON ujm_question (category_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_document_question (
                question_id INT NOT NULL, 
                document_id INT NOT NULL, 
                PRIMARY KEY (question_id, document_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_52D4A3F11E27F6BF ON ujm_document_question (question_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_52D4A3F1C33F7837 ON ujm_document_question (document_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_interaction (
                id INT IDENTITY NOT NULL, 
                question_id INT, 
                type NVARCHAR(255) NOT NULL, 
                invite VARCHAR(MAX) NOT NULL, 
                ordre INT, 
                feedback VARCHAR(MAX), 
                locked_expertise BIT, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_E7D801641E27F6BF ON ujm_interaction (question_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_document_interaction (
                interaction_id INT NOT NULL, 
                document_id INT NOT NULL, 
                PRIMARY KEY (interaction_id, document_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_FF792E7A886DEE8F ON ujm_document_interaction (interaction_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_FF792E7AC33F7837 ON ujm_document_interaction (document_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_expertise (
                id INT IDENTITY NOT NULL, 
                title NVARCHAR(255) NOT NULL, 
                description VARCHAR(MAX), 
                status NVARCHAR(255) NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE TABLE ujm_expertise_user (
                expertise_id INT NOT NULL, 
                user_id INT NOT NULL, 
                PRIMARY KEY (expertise_id, user_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_F60D61B9D5B92F9 ON ujm_expertise_user (expertise_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_F60D61BA76ED395 ON ujm_expertise_user (user_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_hint (
                id INT IDENTITY NOT NULL, 
                interaction_id INT, 
                value NVARCHAR(255) NOT NULL, 
                penalty DOUBLE PRECISION NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_B5FFCBE7886DEE8F ON ujm_hint (interaction_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_paper (
                id INT IDENTITY NOT NULL, 
                user_id INT, 
                exercise_id INT, 
                num_paper INT NOT NULL, 
                start DATETIME2(6) NOT NULL, 
                [end] DATETIME2(6), 
                ordre_question VARCHAR(MAX), 
                archive BIT, 
                date_archive DATE, 
                interupt BIT, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_82972E4BA76ED395 ON ujm_paper (user_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_82972E4BE934951A ON ujm_paper (exercise_id)
        ");
        $this->addSql("
            CREATE TABLE ujm_type_open_question (
                id INT IDENTITY NOT NULL, 
                value NVARCHAR(255) NOT NULL, 
                PRIMARY KEY (id)
            )
        ");
        $this->addSql("
            CREATE TABLE ujm_share (
                user_id INT NOT NULL, 
                question_id INT NOT NULL, 
                allowToModify BIT NOT NULL, 
                PRIMARY KEY (user_id, question_id)
            )
        ");
        $this->addSql("
            CREATE INDEX IDX_238BD307A76ED395 ON ujm_share (user_id)
        ");
        $this->addSql("
            CREATE INDEX IDX_238BD3071E27F6BF ON ujm_share (question_id)
        ");
        $this->addSql("
            ALTER TABLE ujm_exercise_question 
            ADD CONSTRAINT FK_DB79F240E934951A FOREIGN KEY (exercise_id) 
            REFERENCES ujm_exercise (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_exercise_question 
            ADD CONSTRAINT FK_DB79F2401E27F6BF FOREIGN KEY (question_id) 
            REFERENCES ujm_question (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_link_hint_paper 
            ADD CONSTRAINT FK_B76F00F9519161AB FOREIGN KEY (hint_id) 
            REFERENCES ujm_hint (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_link_hint_paper 
            ADD CONSTRAINT FK_B76F00F9E6758861 FOREIGN KEY (paper_id) 
            REFERENCES ujm_paper (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_choice 
            ADD CONSTRAINT FK_D4BDFA959DBF539 FOREIGN KEY (interaction_qcm_id) 
            REFERENCES ujm_interaction_qcm (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_subscription 
            ADD CONSTRAINT FK_A17BA225A76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_subscription 
            ADD CONSTRAINT FK_A17BA225E934951A FOREIGN KEY (exercise_id) 
            REFERENCES ujm_exercise (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_planning 
            ADD CONSTRAINT FK_4D0E9FCFFE54D947 FOREIGN KEY (group_id) 
            REFERENCES ujm_group (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_category 
            ADD CONSTRAINT FK_9FDB39F8A76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_hole 
            ADD CONSTRAINT FK_E9F4F52575EBD64D FOREIGN KEY (interaction_hole_id) 
            REFERENCES ujm_interaction_hole (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_document 
            ADD CONSTRAINT FK_41FEAA4FA76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_interaction_hole 
            ADD CONSTRAINT FK_7343FAC1886DEE8F FOREIGN KEY (interaction_id) 
            REFERENCES ujm_interaction (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_interaction_open 
            ADD CONSTRAINT FK_BFFE44F4886DEE8F FOREIGN KEY (interaction_id) 
            REFERENCES ujm_interaction (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_interaction_open 
            ADD CONSTRAINT FK_BFFE44F46AFD3CF FOREIGN KEY (typeopenquestion_id) 
            REFERENCES ujm_type_open_question (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_word_response 
            ADD CONSTRAINT FK_4E1930C598DDBDFD FOREIGN KEY (interaction_open_id) 
            REFERENCES ujm_interaction_open (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_word_response 
            ADD CONSTRAINT FK_4E1930C515ADE12C FOREIGN KEY (hole_id) 
            REFERENCES ujm_hole (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_response 
            ADD CONSTRAINT FK_A7EC2BC2E6758861 FOREIGN KEY (paper_id) 
            REFERENCES ujm_paper (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_response 
            ADD CONSTRAINT FK_A7EC2BC2886DEE8F FOREIGN KEY (interaction_id) 
            REFERENCES ujm_interaction (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_exercise 
            ADD CONSTRAINT FK_374DF525B87FAB32 FOREIGN KEY (resourceNode_id) 
            REFERENCES claro_resource_node (id) 
            ON DELETE CASCADE
        ");
        $this->addSql("
            ALTER TABLE ujm_exercise_group 
            ADD CONSTRAINT FK_78179004E934951A FOREIGN KEY (exercise_id) 
            REFERENCES ujm_exercise (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_exercise_group 
            ADD CONSTRAINT FK_78179004FE54D947 FOREIGN KEY (group_id) 
            REFERENCES ujm_group (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_lock_attempt 
            ADD CONSTRAINT FK_7A7CDF96E6758861 FOREIGN KEY (paper_id) 
            REFERENCES ujm_paper (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_interaction_graphic 
            ADD CONSTRAINT FK_9EBD442F886DEE8F FOREIGN KEY (interaction_id) 
            REFERENCES ujm_interaction (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_interaction_graphic 
            ADD CONSTRAINT FK_9EBD442FC33F7837 FOREIGN KEY (document_id) 
            REFERENCES ujm_document (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_coords 
            ADD CONSTRAINT FK_CD7B49827876D500 FOREIGN KEY (interaction_graphic_id) 
            REFERENCES ujm_interaction_graphic (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_interaction_qcm 
            ADD CONSTRAINT FK_58C3D5A1886DEE8F FOREIGN KEY (interaction_id) 
            REFERENCES ujm_interaction (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_interaction_qcm 
            ADD CONSTRAINT FK_58C3D5A1DCB52A9E FOREIGN KEY (type_qcm_id) 
            REFERENCES ujm_type_qcm (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_question 
            ADD CONSTRAINT FK_2F6069779D5B92F9 FOREIGN KEY (expertise_id) 
            REFERENCES ujm_expertise (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_question 
            ADD CONSTRAINT FK_2F606977A76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_question 
            ADD CONSTRAINT FK_2F60697712469DE2 FOREIGN KEY (category_id) 
            REFERENCES ujm_category (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_document_question 
            ADD CONSTRAINT FK_52D4A3F11E27F6BF FOREIGN KEY (question_id) 
            REFERENCES ujm_question (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_document_question 
            ADD CONSTRAINT FK_52D4A3F1C33F7837 FOREIGN KEY (document_id) 
            REFERENCES ujm_document (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_interaction 
            ADD CONSTRAINT FK_E7D801641E27F6BF FOREIGN KEY (question_id) 
            REFERENCES ujm_question (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_document_interaction 
            ADD CONSTRAINT FK_FF792E7A886DEE8F FOREIGN KEY (interaction_id) 
            REFERENCES ujm_interaction (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_document_interaction 
            ADD CONSTRAINT FK_FF792E7AC33F7837 FOREIGN KEY (document_id) 
            REFERENCES ujm_document (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_expertise_user 
            ADD CONSTRAINT FK_F60D61B9D5B92F9 FOREIGN KEY (expertise_id) 
            REFERENCES ujm_expertise (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_expertise_user 
            ADD CONSTRAINT FK_F60D61BA76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_hint 
            ADD CONSTRAINT FK_B5FFCBE7886DEE8F FOREIGN KEY (interaction_id) 
            REFERENCES ujm_interaction (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_paper 
            ADD CONSTRAINT FK_82972E4BA76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_paper 
            ADD CONSTRAINT FK_82972E4BE934951A FOREIGN KEY (exercise_id) 
            REFERENCES ujm_exercise (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_share 
            ADD CONSTRAINT FK_238BD307A76ED395 FOREIGN KEY (user_id) 
            REFERENCES claro_user (id)
        ");
        $this->addSql("
            ALTER TABLE ujm_share 
            ADD CONSTRAINT FK_238BD3071E27F6BF FOREIGN KEY (question_id) 
            REFERENCES ujm_question (id)
        ");
    }

    public function down(Schema $schema)
    {
        $this->addSql("
            ALTER TABLE ujm_question 
            DROP CONSTRAINT FK_2F60697712469DE2
        ");
        $this->addSql("
            ALTER TABLE ujm_interaction_qcm 
            DROP CONSTRAINT FK_58C3D5A1DCB52A9E
        ");
        $this->addSql("
            ALTER TABLE ujm_word_response 
            DROP CONSTRAINT FK_4E1930C515ADE12C
        ");
        $this->addSql("
            ALTER TABLE ujm_interaction_graphic 
            DROP CONSTRAINT FK_9EBD442FC33F7837
        ");
        $this->addSql("
            ALTER TABLE ujm_document_question 
            DROP CONSTRAINT FK_52D4A3F1C33F7837
        ");
        $this->addSql("
            ALTER TABLE ujm_document_interaction 
            DROP CONSTRAINT FK_FF792E7AC33F7837
        ");
        $this->addSql("
            ALTER TABLE ujm_hole 
            DROP CONSTRAINT FK_E9F4F52575EBD64D
        ");
        $this->addSql("
            ALTER TABLE ujm_word_response 
            DROP CONSTRAINT FK_4E1930C598DDBDFD
        ");
        $this->addSql("
            ALTER TABLE ujm_planning 
            DROP CONSTRAINT FK_4D0E9FCFFE54D947
        ");
        $this->addSql("
            ALTER TABLE ujm_exercise_group 
            DROP CONSTRAINT FK_78179004FE54D947
        ");
        $this->addSql("
            ALTER TABLE ujm_exercise_question 
            DROP CONSTRAINT FK_DB79F240E934951A
        ");
        $this->addSql("
            ALTER TABLE ujm_subscription 
            DROP CONSTRAINT FK_A17BA225E934951A
        ");
        $this->addSql("
            ALTER TABLE ujm_exercise_group 
            DROP CONSTRAINT FK_78179004E934951A
        ");
        $this->addSql("
            ALTER TABLE ujm_paper 
            DROP CONSTRAINT FK_82972E4BE934951A
        ");
        $this->addSql("
            ALTER TABLE ujm_coords 
            DROP CONSTRAINT FK_CD7B49827876D500
        ");
        $this->addSql("
            ALTER TABLE ujm_choice 
            DROP CONSTRAINT FK_D4BDFA959DBF539
        ");
        $this->addSql("
            ALTER TABLE ujm_exercise_question 
            DROP CONSTRAINT FK_DB79F2401E27F6BF
        ");
        $this->addSql("
            ALTER TABLE ujm_document_question 
            DROP CONSTRAINT FK_52D4A3F11E27F6BF
        ");
        $this->addSql("
            ALTER TABLE ujm_interaction 
            DROP CONSTRAINT FK_E7D801641E27F6BF
        ");
        $this->addSql("
            ALTER TABLE ujm_share 
            DROP CONSTRAINT FK_238BD3071E27F6BF
        ");
        $this->addSql("
            ALTER TABLE ujm_interaction_hole 
            DROP CONSTRAINT FK_7343FAC1886DEE8F
        ");
        $this->addSql("
            ALTER TABLE ujm_interaction_open 
            DROP CONSTRAINT FK_BFFE44F4886DEE8F
        ");
        $this->addSql("
            ALTER TABLE ujm_response 
            DROP CONSTRAINT FK_A7EC2BC2886DEE8F
        ");
        $this->addSql("
            ALTER TABLE ujm_interaction_graphic 
            DROP CONSTRAINT FK_9EBD442F886DEE8F
        ");
        $this->addSql("
            ALTER TABLE ujm_interaction_qcm 
            DROP CONSTRAINT FK_58C3D5A1886DEE8F
        ");
        $this->addSql("
            ALTER TABLE ujm_document_interaction 
            DROP CONSTRAINT FK_FF792E7A886DEE8F
        ");
        $this->addSql("
            ALTER TABLE ujm_hint 
            DROP CONSTRAINT FK_B5FFCBE7886DEE8F
        ");
        $this->addSql("
            ALTER TABLE ujm_question 
            DROP CONSTRAINT FK_2F6069779D5B92F9
        ");
        $this->addSql("
            ALTER TABLE ujm_expertise_user 
            DROP CONSTRAINT FK_F60D61B9D5B92F9
        ");
        $this->addSql("
            ALTER TABLE ujm_link_hint_paper 
            DROP CONSTRAINT FK_B76F00F9519161AB
        ");
        $this->addSql("
            ALTER TABLE ujm_link_hint_paper 
            DROP CONSTRAINT FK_B76F00F9E6758861
        ");
        $this->addSql("
            ALTER TABLE ujm_response 
            DROP CONSTRAINT FK_A7EC2BC2E6758861
        ");
        $this->addSql("
            ALTER TABLE ujm_lock_attempt 
            DROP CONSTRAINT FK_7A7CDF96E6758861
        ");
        $this->addSql("
            ALTER TABLE ujm_interaction_open 
            DROP CONSTRAINT FK_BFFE44F46AFD3CF
        ");
        $this->addSql("
            DROP TABLE ujm_exercise_question
        ");
        $this->addSql("
            DROP TABLE ujm_link_hint_paper
        ");
        $this->addSql("
            DROP TABLE ujm_choice
        ");
        $this->addSql("
            DROP TABLE ujm_subscription
        ");
        $this->addSql("
            DROP TABLE ujm_planning
        ");
        $this->addSql("
            DROP TABLE ujm_category
        ");
        $this->addSql("
            DROP TABLE ujm_type_qcm
        ");
        $this->addSql("
            DROP TABLE ujm_hole
        ");
        $this->addSql("
            DROP TABLE ujm_document
        ");
        $this->addSql("
            DROP TABLE ujm_interaction_hole
        ");
        $this->addSql("
            DROP TABLE ujm_interaction_open
        ");
        $this->addSql("
            DROP TABLE ujm_word_response
        ");
        $this->addSql("
            DROP TABLE ujm_response
        ");
        $this->addSql("
            DROP TABLE ujm_unit
        ");
        $this->addSql("
            DROP TABLE ujm_group
        ");
        $this->addSql("
            DROP TABLE ujm_exercise
        ");
        $this->addSql("
            DROP TABLE ujm_exercise_group
        ");
        $this->addSql("
            DROP TABLE ujm_lock_attempt
        ");
        $this->addSql("
            DROP TABLE ujm_interaction_graphic
        ");
        $this->addSql("
            DROP TABLE ujm_coords
        ");
        $this->addSql("
            DROP TABLE ujm_interaction_qcm
        ");
        $this->addSql("
            DROP TABLE ujm_question
        ");
        $this->addSql("
            DROP TABLE ujm_document_question
        ");
        $this->addSql("
            DROP TABLE ujm_interaction
        ");
        $this->addSql("
            DROP TABLE ujm_document_interaction
        ");
        $this->addSql("
            DROP TABLE ujm_expertise
        ");
        $this->addSql("
            DROP TABLE ujm_expertise_user
        ");
        $this->addSql("
            DROP TABLE ujm_hint
        ");
        $this->addSql("
            DROP TABLE ujm_paper
        ");
        $this->addSql("
            DROP TABLE ujm_type_open_question
        ");
        $this->addSql("
            DROP TABLE ujm_share
        ");
    }
}