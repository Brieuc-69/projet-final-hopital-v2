<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240710082120 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gender DROP FOREIGN KEY FK_C7470A426B899279');
        $this->addSql('DROP INDEX IDX_C7470A426B899279 ON gender');
        $this->addSql('ALTER TABLE gender DROP patient_id');
        $this->addSql('ALTER TABLE patient ADD gender_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE patient ADD CONSTRAINT FK_1ADAD7EB708A0E0 FOREIGN KEY (gender_id) REFERENCES gender (id)');
        $this->addSql('CREATE INDEX IDX_1ADAD7EB708A0E0 ON patient (gender_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE gender ADD patient_id INT NOT NULL');
        $this->addSql('ALTER TABLE gender ADD CONSTRAINT FK_C7470A426B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_C7470A426B899279 ON gender (patient_id)');
        $this->addSql('ALTER TABLE patient DROP FOREIGN KEY FK_1ADAD7EB708A0E0');
        $this->addSql('DROP INDEX IDX_1ADAD7EB708A0E0 ON patient');
        $this->addSql('ALTER TABLE patient DROP gender_id');
    }
}
