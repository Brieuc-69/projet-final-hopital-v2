<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240710093524 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE medecin_experience DROP FOREIGN KEY FK_DD1C0CD946E90E27');
        $this->addSql('ALTER TABLE medecin_experience DROP FOREIGN KEY FK_DD1C0CD94F31A84');
        $this->addSql('DROP TABLE medecin_experience');
        $this->addSql('ALTER TABLE medecin ADD experience_id INT DEFAULT NULL, DROP experience');
        $this->addSql('ALTER TABLE medecin ADD CONSTRAINT FK_1BDA53C646E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id)');
        $this->addSql('CREATE INDEX IDX_1BDA53C646E90E27 ON medecin (experience_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE medecin_experience (medecin_id INT NOT NULL, experience_id INT NOT NULL, INDEX IDX_DD1C0CD946E90E27 (experience_id), INDEX IDX_DD1C0CD94F31A84 (medecin_id), PRIMARY KEY(medecin_id, experience_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE medecin_experience ADD CONSTRAINT FK_DD1C0CD946E90E27 FOREIGN KEY (experience_id) REFERENCES experience (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medecin_experience ADD CONSTRAINT FK_DD1C0CD94F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE medecin DROP FOREIGN KEY FK_1BDA53C646E90E27');
        $this->addSql('DROP INDEX IDX_1BDA53C646E90E27 ON medecin');
        $this->addSql('ALTER TABLE medecin ADD experience VARCHAR(255) NOT NULL, DROP experience_id');
    }
}
