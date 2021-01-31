<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210130234939 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE retrait ADD montant DOUBLE PRECISION NOT NULL, ADD nom_expediteur VARCHAR(255) NOT NULL, ADD prenom_expediteur VARCHAR(255) NOT NULL, ADD phone_expediteur VARCHAR(255) NOT NULL, ADD numero_piece_id_expediteur VARCHAR(255) DEFAULT NULL, ADD nom_beneficiaire VARCHAR(255) NOT NULL, ADD prenom_beneficiaire VARCHAR(255) NOT NULL, ADD phone_beneficiaire VARCHAR(255) NOT NULL, ADD tarif INT NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE retrait DROP montant, DROP nom_expediteur, DROP prenom_expediteur, DROP phone_expediteur, DROP numero_piece_id_expediteur, DROP nom_beneficiaire, DROP prenom_beneficiaire, DROP phone_beneficiaire, DROP tarif');
    }
}
