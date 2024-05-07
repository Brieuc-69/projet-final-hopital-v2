<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240418144444 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE account (id INT AUTO_INCREMENT NOT NULL, patient_id INT DEFAULT NULL, medecin_id INT DEFAULT NULL, price INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_7D3656A46B899279 (patient_id), INDEX IDX_7D3656A44F31A84 (medecin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appointement (id INT AUTO_INCREMENT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', uptdate_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', content LONGTEXT NOT NULL, date_appointment DATETIME NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appointement_medecin (appointement_id INT NOT NULL, medecin_id INT NOT NULL, INDEX IDX_15B016FB1EBF5025 (appointement_id), INDEX IDX_15B016FB4F31A84 (medecin_id), PRIMARY KEY(appointement_id, medecin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE appointement_patient (appointement_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_14B092D61EBF5025 (appointement_id), INDEX IDX_14B092D66B899279 (patient_id), PRIMARY KEY(appointement_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE experience (id INT AUTO_INCREMENT NOT NULL, experience VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, url VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE gender (id INT AUTO_INCREMENT NOT NULL, patient_id INT NOT NULL, name VARCHAR(255) NOT NULL, INDEX IDX_C7470A426B899279 (patient_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medecin (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, url_id INT DEFAULT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, experience VARCHAR(255) NOT NULL, disponible DATETIME NOT NULL, tarif INT NOT NULL, tel VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1BDA53C6A76ED395 (user_id), UNIQUE INDEX UNIQ_1BDA53C681CFDAE7 (url_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE medecin_experience (medecin_id INT NOT NULL, experience_id INT NOT NULL, INDEX IDX_DD1C0CD94F31A84 (medecin_id), INDEX IDX_DD1C0CD946E90E27 (experience_id), PRIMARY KEY(medecin_id, experience_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE patient (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, last_name VARCHAR(255) NOT NULL, first_name VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, adress VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_1ADAD7EBA76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, password VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, role VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE messenger_messages (id BIGINT AUTO_INCREMENT NOT NULL, body LONGTEXT NOT NULL, headers LONGTEXT NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', available_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivered_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_75EA56E0FB7336F0 (queue_name), INDEX IDX_75EA56E0E3BD61CE (available_at), INDEX IDX_75EA56E016BA31DB (delivered_at), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A46B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE account ADD CONSTRAINT FK_7D3656A44F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE appointement_medecin ADD CONSTRAINT FK_15B016FB1EBF5025 FOREIGN KEY (appointement_id) REFERENCES appointement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointement_medecin ADD CONSTRAINT FK_15B016FB4F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointement_patient ADD CONSTRAINT FK_14B092D61EBF5025 FOREIGN KEY (appointement_id) REFERENCES appointement (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointement_patient ADD CONSTRAINT FK_14B092D66B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE gender ADD CONSTRAINT FK_C7470A426B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C6A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C681CFDAE7 FOREIGN KEY (url_id) REFERENCES file (id)');
        $this->addSql('ALTER TABLE medecin_experience ADD CONSTRAINT FK_DD1C0CD94F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medecin_experience ADD CONSTRAINT FK_DD1C0CD946E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A46B899279');
        $this->addSql('ALTER TABLE account DROP FOREIGN KEY FK_7D3656A44F31A84');
        $this->addSql('ALTER TABLE appointement_medecin DROP FOREIGN KEY FK_15B016FB1EBF5025');
        $this->addSql('ALTER TABLE appointement_medecin DROP FOREIGN KEY FK_15B016FB4F31A84');
        $this->addSql('ALTER TABLE appointement_patient DROP FOREIGN KEY FK_14B092D61EBF5025');
        $this->addSql('ALTER TABLE appointement_patient DROP FOREIGN KEY FK_14B092D66B899279');
        $this->addSql('ALTER TABLE gender DROP FOREIGN KEY FK_C7470A426B899279');
        $this->addSql('ALTER TABLE medecin DROP FOREIGN KEY FK_1BDA53C6A76ED395');
        $this->addSql('ALTER TABLE medecin DROP FOREIGN KEY FK_1BDA53C681CFDAE7');
        $this->addSql('ALTER TABLE medecin_experience DROP FOREIGN KEY FK_DD1C0CD94F31A84');
        $this->addSql('ALTER TABLE medecin_experience DROP FOREIGN KEY FK_DD1C0CD946E90E27');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EBA76ED395');
        $this->addSql('DROP TABLE account');
        $this->addSql('DROP TABLE appointement');
        $this->addSql('DROP TABLE appointement_medecin');
        $this->addSql('DROP TABLE appointement_patient');
        $this->addSql('DROP TABLE experience');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE gender');
        $this->addSql('DROP TABLE medecin');
        $this->addSql('DROP TABLE medecin_experience');
        $this->addSql('DROP TABLE patient');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
