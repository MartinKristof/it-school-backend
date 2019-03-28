<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190327191213 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, street VARCHAR(255) NOT NULL, city VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tag (id INT AUTO_INCREMENT NOT NULL, label VARCHAR(32) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, password_hash VARCHAR(255) NOT NULL, discr VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE student (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE students_favorite_courses (student_id INT NOT NULL, course_id INT NOT NULL, INDEX IDX_3C32943ECB944F1A (student_id), INDEX IDX_3C32943E591CC992 (course_id), PRIMARY KEY(student_id, course_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE course (id INT AUTO_INCREMENT NOT NULL, summary_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, description LONGTEXT NOT NULL, price DOUBLE PRECISION NOT NULL, duration DOUBLE PRECISION NOT NULL, content LONGTEXT NOT NULL, UNIQUE INDEX UNIQ_169E6FB92AC2D45C (summary_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courses_addresses (course_id INT NOT NULL, address_id INT NOT NULL, INDEX IDX_71328798591CC992 (course_id), INDEX IDX_71328798F5B7AF75 (address_id), PRIMARY KEY(course_id, address_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courses_images (course_id INT NOT NULL, image_id INT NOT NULL, INDEX IDX_BF362B1C591CC992 (course_id), INDEX IDX_BF362B1C3DA5256D (image_id), PRIMARY KEY(course_id, image_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courses_ratings (course_id INT NOT NULL, rating_id INT NOT NULL, INDEX IDX_778FFA55591CC992 (course_id), INDEX IDX_778FFA55A32EFC6 (rating_id), PRIMARY KEY(course_id, rating_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE courses_tags (course_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_AB5C2698591CC992 (course_id), INDEX IDX_AB5C2698BAD26311 (tag_id), PRIMARY KEY(course_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lector (id INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE lectors_specializations (lector_id INT NOT NULL, tag_id INT NOT NULL, INDEX IDX_113C9BFEADEC45C7 (lector_id), INDEX IDX_113C9BFEBAD26311 (tag_id), PRIMARY KEY(lector_id, tag_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE summary (id INT AUTO_INCREMENT NOT NULL, title VARCHAR(255) NOT NULL, note LONGTEXT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rating (id INT AUTO_INCREMENT NOT NULL, text LONGTEXT NOT NULL, value SMALLINT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, url_path VARCHAR(255) NOT NULL, title VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT FK_B723AF33BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE students_favorite_courses ADD CONSTRAINT FK_3C32943ECB944F1A FOREIGN KEY (student_id) REFERENCES student (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE students_favorite_courses ADD CONSTRAINT FK_3C32943E591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT FK_169E6FB92AC2D45C FOREIGN KEY (summary_id) REFERENCES summary (id)');
        $this->addSql('ALTER TABLE courses_addresses ADD CONSTRAINT FK_71328798591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courses_addresses ADD CONSTRAINT FK_71328798F5B7AF75 FOREIGN KEY (address_id) REFERENCES address (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courses_images ADD CONSTRAINT FK_BF362B1C591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courses_images ADD CONSTRAINT FK_BF362B1C3DA5256D FOREIGN KEY (image_id) REFERENCES image (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courses_ratings ADD CONSTRAINT FK_778FFA55591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courses_ratings ADD CONSTRAINT FK_778FFA55A32EFC6 FOREIGN KEY (rating_id) REFERENCES rating (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courses_tags ADD CONSTRAINT FK_AB5C2698591CC992 FOREIGN KEY (course_id) REFERENCES course (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE courses_tags ADD CONSTRAINT FK_AB5C2698BAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lector ADD CONSTRAINT FK_B92369A6BF396750 FOREIGN KEY (id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lectors_specializations ADD CONSTRAINT FK_113C9BFEADEC45C7 FOREIGN KEY (lector_id) REFERENCES lector (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE lectors_specializations ADD CONSTRAINT FK_113C9BFEBAD26311 FOREIGN KEY (tag_id) REFERENCES tag (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE courses_addresses DROP FOREIGN KEY FK_71328798F5B7AF75');
        $this->addSql('ALTER TABLE courses_tags DROP FOREIGN KEY FK_AB5C2698BAD26311');
        $this->addSql('ALTER TABLE lectors_specializations DROP FOREIGN KEY FK_113C9BFEBAD26311');
        $this->addSql('ALTER TABLE student DROP FOREIGN KEY FK_B723AF33BF396750');
        $this->addSql('ALTER TABLE lector DROP FOREIGN KEY FK_B92369A6BF396750');
        $this->addSql('ALTER TABLE students_favorite_courses DROP FOREIGN KEY FK_3C32943ECB944F1A');
        $this->addSql('ALTER TABLE students_favorite_courses DROP FOREIGN KEY FK_3C32943E591CC992');
        $this->addSql('ALTER TABLE courses_addresses DROP FOREIGN KEY FK_71328798591CC992');
        $this->addSql('ALTER TABLE courses_images DROP FOREIGN KEY FK_BF362B1C591CC992');
        $this->addSql('ALTER TABLE courses_ratings DROP FOREIGN KEY FK_778FFA55591CC992');
        $this->addSql('ALTER TABLE courses_tags DROP FOREIGN KEY FK_AB5C2698591CC992');
        $this->addSql('ALTER TABLE lectors_specializations DROP FOREIGN KEY FK_113C9BFEADEC45C7');
        $this->addSql('ALTER TABLE course DROP FOREIGN KEY FK_169E6FB92AC2D45C');
        $this->addSql('ALTER TABLE courses_ratings DROP FOREIGN KEY FK_778FFA55A32EFC6');
        $this->addSql('ALTER TABLE courses_images DROP FOREIGN KEY FK_BF362B1C3DA5256D');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE tag');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE students_favorite_courses');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE courses_addresses');
        $this->addSql('DROP TABLE courses_images');
        $this->addSql('DROP TABLE courses_ratings');
        $this->addSql('DROP TABLE courses_tags');
        $this->addSql('DROP TABLE lector');
        $this->addSql('DROP TABLE lectors_specializations');
        $this->addSql('DROP TABLE summary');
        $this->addSql('DROP TABLE rating');
        $this->addSql('DROP TABLE image');
    }
}
