<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190405144303 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lectors_teached_courses DROP FOREIGN KEY FK_1C76E9B7CB944F1A');
        $this->addSql('DROP INDEX IDX_1C76E9B7CB944F1A ON lectors_teached_courses');
        $this->addSql('ALTER TABLE lectors_teached_courses DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE lectors_teached_courses CHANGE student_id lector_id INT NOT NULL');
        $this->addSql('ALTER TABLE lectors_teached_courses ADD CONSTRAINT FK_1C76E9B7ADEC45C7 FOREIGN KEY (lector_id) REFERENCES lector (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_1C76E9B7ADEC45C7 ON lectors_teached_courses (lector_id)');
        $this->addSql('ALTER TABLE lectors_teached_courses ADD PRIMARY KEY (lector_id, course_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE lectors_teached_courses DROP FOREIGN KEY FK_1C76E9B7ADEC45C7');
        $this->addSql('DROP INDEX IDX_1C76E9B7ADEC45C7 ON lectors_teached_courses');
        $this->addSql('ALTER TABLE lectors_teached_courses DROP PRIMARY KEY');
        $this->addSql('ALTER TABLE lectors_teached_courses CHANGE lector_id student_id INT NOT NULL');
        $this->addSql('ALTER TABLE lectors_teached_courses ADD CONSTRAINT FK_1C76E9B7CB944F1A FOREIGN KEY (student_id) REFERENCES lector (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_1C76E9B7CB944F1A ON lectors_teached_courses (student_id)');
        $this->addSql('ALTER TABLE lectors_teached_courses ADD PRIMARY KEY (student_id, course_id)');
    }
}
