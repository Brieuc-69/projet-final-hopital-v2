<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240507094423 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointement ADD medecin_id INT NOT NULL, ADD patient_id INT NOT NULL');
        $this->addSql('ALTER TABLE appointement ADD CONSTRAINT FK_BD9991CD4F31A84 FOREIGN KEY (medecin_id) REFERENCES medecin (id)');
        $this->addSql('ALTER TABLE appointement ADD CONSTRAINT FK_BD9991CD6B899279 FOREIGN KEY (patient_id) REFERENCES patient (id)');
        $this->addSql('CREATE INDEX IDX_BD9991CD4F31A84 ON appointement (medecin_id)');
        $this->addSql('CREATE INDEX IDX_BD9991CD6B899279 ON appointement (patient_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE appointement DROP FOREIGN KEY FK_BD9991CD4F31A84');
        $this->addSql('ALTER TABLE appointement DROP FOREIGN KEY FK_BD9991CD6B899279');
        $this->addSql('DROP INDEX IDX_BD9991CD4F31A84 ON appointement');
        $this->addSql('DROP INDEX IDX_BD9991CD6B899279 ON appointement');
        $this->addSql('ALTER TABLE appointement DROP medecin_id, DROP patient_id');
    }
}
