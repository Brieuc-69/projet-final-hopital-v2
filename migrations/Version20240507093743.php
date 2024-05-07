<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507093743 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointement_patient DROP FOREIGN KEY FK_14B092D61EBF5025');
        $this->addSql('ALTER TABLE appointement_patient DROP FOREIGN KEY FK_14B092D66B899279');
        $this->addSql('ALTER TABLE appointement_medecin DROP FOREIGN KEY FK_15B016FB1EBF5025');
        $this->addSql('ALTER TABLE appointement_medecin DROP FOREIGN KEY FK_15B016FB4F31A84');
        $this->addSql('DROP TABLE appointement_patient');
        $this->addSql('DROP TABLE appointement_medecin');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE appointement_patient (appointement_id INT NOT NULL, patient_id INT NOT NULL, INDEX IDX_14B092D61EBF5025 (appointement_id), INDEX IDX_14B092D66B899279 (patient_id), PRIMARY KEY(appointement_id, patient_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE appointement_medecin (appointement_id INT NOT NULL, medecin_id INT NOT NULL, INDEX IDX_15B016FB1EBF5025 (appointement_id), INDEX IDX_15B016FB4F31A84 (medecin_id), PRIMARY KEY(appointement_id, medecin_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE appointement_patient ADD CONSTRAINT FK_14B092D61EBF5025 FOREIGN KEY (appointement_id) REFERENCES appointement (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointement_patient ADD CONSTRAINT FK_14B092D66B899279 FOREIGN KEY (patient_id) REFERENCES patient (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointement_medecin ADD CONSTRAINT FK_15B016FB1EBF5025 FOREIGN KEY (appointement_id) REFERENCES appointement (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE appointement_medecin ADD CONSTRAINT FK_15B016FB4F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
