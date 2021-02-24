<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210224000503 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE agence (id INT AUTO_INCREMENT NOT NULL, ville_id INT DEFAULT NULL, nom_agence VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, numero_agence VARCHAR(255) NOT NULL, INDEX IDX_64C19AA9A73F0036 (ville_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE compte (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, solde DOUBLE PRECISION DEFAULT NULL, date DATETIME NOT NULL, numero_compte VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_CFF65260A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE etat_retrait (id INT AUTO_INCREMENT NOT NULL, retrait_id INT DEFAULT NULL, etat TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_DE5B55D47EF8457A (retrait_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE retrait (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, code_retrait VARCHAR(255) NOT NULL, etat_retrait TINYINT(1) NOT NULL, date_retrait DATE NOT NULL, montant DOUBLE PRECISION NOT NULL, nom_expediteur VARCHAR(255) NOT NULL, prenom_expediteur VARCHAR(255) NOT NULL, phone_expediteur VARCHAR(255) NOT NULL, numero_piece_id_expediteur VARCHAR(255) DEFAULT NULL, nom_beneficiaire VARCHAR(255) NOT NULL, prenom_beneficiaire VARCHAR(255) NOT NULL, phone_beneficiaire VARCHAR(255) NOT NULL, tarif INT NOT NULL, INDEX IDX_D9846A51A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE seuil_transfert (id INT AUTO_INCREMENT NOT NULL, min DOUBLE PRECISION NOT NULL, max DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE tarif (id INT AUTO_INCREMENT NOT NULL, min INT NOT NULL, max INT NOT NULL, tarif_client INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE transfert (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, seuil_transfert_id INT DEFAULT NULL, tarif_id INT NOT NULL, ville_envoi VARCHAR(255) NOT NULL, montant DOUBLE PRECISION NOT NULL, nom_expediteur VARCHAR(255) NOT NULL, prenom_expediteur VARCHAR(255) NOT NULL, phone_expediteur VARCHAR(255) NOT NULL, numero_piece_id VARCHAR(255) DEFAULT NULL, nom_beneficiaire VARCHAR(255) NOT NULL, prenom_beneficiaire VARCHAR(255) NOT NULL, code_transfert VARCHAR(255) NOT NULL, etat_transfert TINYINT(1) NOT NULL, phone_beneficiaire VARCHAR(255) NOT NULL, date_transfert DATE NOT NULL, INDEX IDX_1E4EACBBA76ED395 (user_id), INDEX IDX_1E4EACBB9D5670E4 (seuil_transfert_id), INDEX IDX_1E4EACBB357C0A59 (tarif_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, agence_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, sex VARCHAR(255) NOT NULL, date_naiss DATE NOT NULL, lieu_naiss VARCHAR(255) NOT NULL, tel VARCHAR(255) NOT NULL, date_creation DATE NOT NULL, image VARCHAR(255) DEFAULT NULL, updated_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), INDEX IDX_8D93D649D725330D (agence_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ville (id INT AUTO_INCREMENT NOT NULL, libelle VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE agence ADD CONSTRAINT FK_64C19AA9A73F0036 FOREIGN KEY (ville_id) REFERENCES ville (id)');
        $this->addSql('ALTER TABLE compte ADD CONSTRAINT FK_CFF65260A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE etat_retrait ADD CONSTRAINT FK_DE5B55D47EF8457A FOREIGN KEY (retrait_id) REFERENCES retrait (id)');
        $this->addSql('ALTER TABLE retrait ADD CONSTRAINT FK_D9846A51A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transfert ADD CONSTRAINT FK_1E4EACBBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE transfert ADD CONSTRAINT FK_1E4EACBB9D5670E4 FOREIGN KEY (seuil_transfert_id) REFERENCES seuil_transfert (id)');
        $this->addSql('ALTER TABLE transfert ADD CONSTRAINT FK_1E4EACBB357C0A59 FOREIGN KEY (tarif_id) REFERENCES tarif (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649D725330D FOREIGN KEY (agence_id) REFERENCES agence (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649D725330D');
        $this->addSql('ALTER TABLE etat_retrait DROP FOREIGN KEY FK_DE5B55D47EF8457A');
        $this->addSql('ALTER TABLE transfert DROP FOREIGN KEY FK_1E4EACBB9D5670E4');
        $this->addSql('ALTER TABLE transfert DROP FOREIGN KEY FK_1E4EACBB357C0A59');
        $this->addSql('ALTER TABLE compte DROP FOREIGN KEY FK_CFF65260A76ED395');
        $this->addSql('ALTER TABLE retrait DROP FOREIGN KEY FK_D9846A51A76ED395');
        $this->addSql('ALTER TABLE transfert DROP FOREIGN KEY FK_1E4EACBBA76ED395');
        $this->addSql('ALTER TABLE agence DROP FOREIGN KEY FK_64C19AA9A73F0036');
        $this->addSql('DROP TABLE agence');
        $this->addSql('DROP TABLE compte');
        $this->addSql('DROP TABLE etat_retrait');
        $this->addSql('DROP TABLE retrait');
        $this->addSql('DROP TABLE seuil_transfert');
        $this->addSql('DROP TABLE tarif');
        $this->addSql('DROP TABLE transfert');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE ville');
    }
}
