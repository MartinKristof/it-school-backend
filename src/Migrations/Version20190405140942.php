<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190405140942 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE students_attended_courses (student_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_708EFCEBCB944F1A (student_id), INDEX IDX_708EFCEB591CC992 (course_id), PRIMARY KEY(student_id, course_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lectors_teached_courses (student_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_1C76E9B7CB944F1A (student_id), INDEX IDX_1C76E9B7591CC992 (course_id), PRIMARY KEY(student_id, course_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE students_attended_courses ADD CONSTRAINT FK_708EFCEBCB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE students_attended_courses ADD CONSTRAINT FK_708EFCEB591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lectors_teached_courses ADD CONSTRAINT FK_1C76E9B7CB944F1A FOREIGN KEY (student_id) REFERENCES lector (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lectors_teached_courses ADD CONSTRAINT FK_1C76E9B7591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE students_attended_courses');
        $this->addSql('DROP TABLE lectors_teached_courses');
    }
}
