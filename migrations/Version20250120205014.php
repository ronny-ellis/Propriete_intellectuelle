<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250120205014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE deadlines (id INT AUTO_INCREMENT NOT NULL, id_ip_right_id INT NOT NULL, date DATE NOT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_480A1B4F321B68C5 (id_ip_right_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ip_right (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, date_depot DATE NOT NULL, date_expiration DATE NOT NULL, territoire VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE licenses (id INT AUTO_INCREMENT NOT NULL, id_user_id INT NOT NULL, territoire VARCHAR(255) NOT NULL, royalties NUMERIC(10, 0) NOT NULL, INDEX IDX_7F320F3F79F37AE5 (id_user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE litiges (id INT AUTO_INCREMENT NOT NULL, id_ip_right_id INT NOT NULL, description VARCHAR(255) NOT NULL, resultat VARCHAR(255) NOT NULL, INDEX IDX_28E33B3A321B68C5 (id_ip_right_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(255) NOT NULL, mdp VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE deadlines ADD CONSTRAINT FK_480A1B4F321B68C5 FOREIGN KEY (id_ip_right_id) REFERENCES ip_right (id)');
        $this->addSql('ALTER TABLE licenses ADD CONSTRAINT FK_7F320F3F79F37AE5 FOREIGN KEY (id_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE litiges ADD CONSTRAINT FK_28E33B3A321B68C5 FOREIGN KEY (id_ip_right_id) REFERENCES ip_right (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE deadlines DROP FOREIGN KEY FK_480A1B4F321B68C5');
        $this->addSql('ALTER TABLE licenses DROP FOREIGN KEY FK_7F320F3F79F37AE5');
        $this->addSql('ALTER TABLE litiges DROP FOREIGN KEY FK_28E33B3A321B68C5');
        $this->addSql('DROP TABLE deadlines');
        $this->addSql('DROP TABLE ip_right');
        $this->addSql('DROP TABLE licenses');
        $this->addSql('DROP TABLE litiges');
        $this->addSql('DROP TABLE user');
    }
}
